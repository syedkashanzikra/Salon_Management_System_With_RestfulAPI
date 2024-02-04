<?php

namespace Modules\Booking\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class BookingListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        // return [
        //     'id' => $this->id,
        //     'note' => $this->note,
        //     'start_date_time' => $this->start_date_time,
        //     'branch_id' => $this->branch_id,
        //     'branch_name' => $this->branch->name,
        //     'address_line_1' => $this->branch->address->address_line_1,
        //     'address_line_2' => $this->branch->address->address_line_2,
        //     'phone' => $this->branch->contact_number,
        //     'employee_id' => optional($this->services->first())->employee_id,
        //     'employee_name' => optional($this->services->first())->employee->full_name ?? '-',
        //     'employee_image' => optional($this->services->first())->employee->profile_image ?? '-',
        //     'services' => $this->services->filter(function($service) {

        //         unset($service['employee']);

        //         $service['service_image'] = $service['service_image'] ? url('storage/'.$service['media_id'].'/'.$service['service_image']) : '-';

        //         return $service;
        //     }),

        //     'user_id' => $this->user_id,
        //     'user_name' => optional($this->user)->full_name ?? default_user_name(),
        //     'user_profile_image' => optional($this->user)->profile_image ?? default_user_avatar(),
        //     'user_created' => optional($this->user)->created_at,
        //     'status' => $this->status,
        //     'created_by_name' => optional($this->createdUser)->full_name ?? default_user_name(),
        //     'updated_by_name' => optional($this->updatedUser)->full_name ?? default_user_name(),
        //     'created_at' => date('D, M Y', strtotime($this->created_at)),
        //     'updated_at' => date('D, M Y', strtotime($this->updated_at)),
        //     'payment' => $this->payment,
        // ];

        return [
            'id' => $this->id,
            'note' => $this->note,
            'start_date_time' => $this->start_date_time,
            'branch_id' => $this->branch_id,
            'branch_name' => $this->branch->name,
            'address_line_1' => $this->branch->address->address_line_1,
            'address_line_2' => $this->branch->address->address_line_2,
            'phone' => $this->branch->contact_number,
            'employee_id' => optional($this->booking_service->first())->employee_id,
            'employee_name' => optional($this->booking_service->first())->employee->full_name ?? '-',
            'employee_image' => optional($this->booking_service->first())->employee->profile_image ?? '-',
            'services' => $this->booking_service->map(function ($booking_service) {
                unset($booking_service['employee']);

                $booking_service['service_name'] = $booking_service['service']->name;
                $booking_service['service_image'] = $booking_service['service']->feature_image ?? '-';
                unset($booking_service['service']);

                return $booking_service;
            }),
            'user_id' => $this->user_id,
            'user_name' => optional($this->user)->full_name ?? default_user_name(),
            'user_profile_image' => optional($this->user)->profile_image ?? default_user_avatar(),
            'user_created' => optional($this->user)->created_at,
            'status' => $this->status,
            'created_by_name' => optional($this->createdUser)->full_name ?? default_user_name(),
            'updated_by_name' => optional($this->updatedUser)->full_name ?? default_user_name(),
            'created_at' => date('D, M Y', strtotime($this->created_at)),
            'updated_at' => date('D, M Y', strtotime($this->updated_at)),
            'payment' => $this->payment,
        ];
    }
}
