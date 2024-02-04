<?php

namespace Modules\Booking\Trait;

use App\Jobs\BulkNotification;
use Modules\Booking\Models\BookingService;
use Modules\BussinessHour\Models\BussinessHour;

trait BookingTrait
{
    public function updateBookingService($data, $booking_id)
    {
        $serviceData = collect($data);
        $serviceId = $serviceData->pluck('service_id')->toArray();
        $bookingService = BookingService::where('booking_id', $booking_id);
        if (count($serviceId) > 0) {
            $bookingService = $bookingService->whereNotIn('service_id', $serviceId);
        }
        $bookingService->delete();
        foreach ($serviceData as $key => $value) {
            BookingService::updateOrCreate(['booking_id' => $booking_id, 'service_id' => $value['service_id'], 'employee_id' => $value['employee_id']], [
                'sequance' => $key,
                'start_date_time' => $value['start_date_time'],
                'booking_id' => $booking_id,
                'service_id' => $value['service_id'],
                'employee_id' => $value['employee_id'],
                'service_price' => $value['service_price'] ?? 0,
                'duration_min' => $value['duration_min'] ?? 30,
            ]);
        }
    }

    public function getSlots($date, $day, $branch_id, $employee_id = null)
    {
        $slotDay = BussinessHour::where(['day' => strtolower($day), 'branch_id' => $branch_id])->first();

        $slots[] = [
            'value' => '',
            'label' => 'No Slot Available',
            'disabled' => true,
        ];

        if (isset($slotDay)) {
            $start_time = strtotime($slotDay->start_time);
            $end_time = strtotime($slotDay->end_time);
            $slot_duration = setting('slot_duration');

            $slot_parts = explode(':', $slot_duration);
            $slot_hours = intval($slot_parts[0]);
            $slot_minutes = intval($slot_parts[1]);

            $slot_duration_minutes = $slot_hours * 60 + $slot_minutes;

            $current_time = $start_time;
            $slots = [];

            while ($current_time < $end_time) {
                // Skip slots that overlap with break hours
                $is_break_hour = false;
                foreach ($slotDay->breaks as $break) {
                    $start_break = strtotime($break['start_break']);
                    $end_break = strtotime($break['end_break']);
                    if ($current_time >= $start_break && $current_time < $end_break) {
                        $current_time = $end_break;
                        $is_break_hour = true;
                        break;
                    }
                }

                if ($is_break_hour) {
                    continue; // Skip this iteration and proceed to the next slot
                }

                $slot_start = $current_time;
                $current_time += $slot_duration_minutes * 60;

                $startDateTime = date('Y-m-d', strtotime($date)).' '.date('H:i:s', $slot_start);
                $startTimestamp = strtotime($startDateTime);

                $endTimestamp = $startTimestamp + ($slot_duration_minutes * 60);

                // Check if the slot overlaps with any existing appointments
                $is_booked = false;
                if ($employee_id) {
                    $existingAppointments = BookingService::where('employee_id', $employee_id)
                        ->where('start_date_time', '<', date('Y-m-d H:i:s', $endTimestamp))
                        ->get();

                    foreach ($existingAppointments as $appointment) {
                        $appointment_start = strtotime($appointment->start_date_time);
                        $appointment_end = $appointment_start + ($appointment->duration_min * 60);

                        if ($startTimestamp >= $appointment_start && $startTimestamp < $appointment_end) {
                            $is_booked = true;
                            break;
                        }
                    }
                }

                if (! $is_booked) {
                    $slot = [
                        'value' => date('Y-m-d H:i:s', $startTimestamp),
                        'label' => date('h:i A', $slot_start),
                        'disabled' => false,
                    ];
                    $slots[] = $slot;
                }
            }
        }

        return $slots;
    }

    protected function sendNotificationOnBookingUpdate($type, $booking)
    {
        $data = mail_footer($type, $booking);

        $address = [
            'address_line_1' => $booking->branch->address->address_line_1,
            'address_line_2' => $booking->branch->address->address_line_2,
            'city' => $booking->branch->address->city,
            'state' => $booking->branch->address->state,
            'country' => $booking->branch->address->country,
            'postal_code' => $booking->branch->address->postal_code,
        ];

        $data['booking'] = [
            'id' => $booking->id,
            'description' => $booking->note ?? 'Testing Note',
            'user_id' => $booking->user_id,
            'user_name' => optional($booking->user)->full_name ?? default_user_name(),
            'employee_id' => $booking->branch->employee->id,
            'employee_name' => $booking->services->first()->employee->full_name ?? 'Staff',
            'booking_date' => date('d/m/Y', strtotime($booking->start_date_time)),
            'booking_time' => date('h:i A', strtotime($booking->start_date_time)),
            'booking_services_names' => implode(', ', $booking->mainServices->pluck('name')->toArray()),
            'booking_duration' => $booking->services->sum('duration_min') ?? 0,
            'venue_address' => implode(', ', $address),
        ];

        BulkNotification::dispatch($data);
    }
}
