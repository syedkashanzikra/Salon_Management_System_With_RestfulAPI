<?php

namespace Modules\QuickBooking\Http\Controllers\Backend;

use App\Events\Backend\UserCreated;
use App\Http\Controllers\Controller;
use App\Models\Address;
// Traits
use App\Models\Branch;
// Listing Models
use App\Models\User;
use App\Notifications\UserAccountCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Modules\Booking\Models\Booking;
// Events
use Modules\Booking\Trait\BookingTrait;
use Modules\Service\Transformers\ServiceResource;
use Modules\Tax\Models\Tax;

class QuickBookingsController extends Controller
{
    use BookingTrait;

    public function index()
    {
        if (! setting('is_quick_booking')) {
            return abort(404);
        }

        return view('quickbooking::backend.quickbookings.index');
    }

    // API Methods for listing api
    public function branch_list()
    {
        $list = Branch::active()->with('address')->select('id', 'name', 'branch_for', 'contact_number', 'contact_email')->get();

        return $this->sendResponse($list, __('booking.booking_branch'));
    }

    public function slot_time_list(Request $request)
    {
        $day = date('l', strtotime($request->date));

        $data = $this->requestData($request);

        $slots = $this->getSlots($data['date'], $day, $data['branch_id'], $data['employee_id']);

        return $this->sendResponse($slots, __('booking.booking_timeslot'));
    }

    public function services_list(Request $request)
    {
        $branch_id = $request->branch_id;

        $data = $this->requestData($request);

        $item = Branch::find($data['branch_id']);

        $items = $item->services->where('status', 1);

        $list = ServiceResource::collection($items);

        return $this->sendResponse($list, __('booking.booking_sevice'));
    }

    public function employee_list(Request $request)
    {
        $data = $this->requestData($request);

        $list = User::whereHas('services', function ($query) use ($data) {
            $query->where('service_id', $data['service_id']);
        })
            ->whereHas('branches', function ($query) use ($data) {
                $query->where('branch_id', $data['branch_id']);
            })
            ->get();

        return $this->sendResponse($list, __('booking.booking_employee'));
    }

    // Create Method for Booking API
    public function create_booking(Request $request)
    {

        $userRequest = $request->user;
        $user = User::where('email', $userRequest['email'])->first();

        if (! isset($user)) {
            $userRequest['password'] = Hash::make('12345678');
            $user = User::create($userRequest);
            // Sync Roles
            $roles = ['user'];
            $user->syncRoles($roles);

            \Artisan::call('cache:clear');

            event(new UserCreated($user));

            $data = [
                'password' => '12345678',
            ];

            try {
                $user->notify(new UserAccountCreated($data));
            } catch (\Exception $e) {
                \Log::error($e->getMessage());
            }
        }

        $bookingData = $request->booking;
        $bookingData['user_id'] = $user->id;
        $bookingData['created_by'] = $user->id;
        $bookingData['updated_by'] = $user->id;
        $booking = Booking::create($bookingData);

        $this->updateBookingService($bookingData['services'], $booking->id);

        $booking['user'] = $booking->user;

        $booking['services'] = $booking->services;

        $booking['branch'] = $booking->branch;

        $branchAddress = Address::where('addressable_id', $booking['branch']->id)
            ->where('addressable_type', get_class($booking['branch']))
            ->first();

        $booking['branch_address'] = $branchAddress;

        try {
            $this->sendNotificationOnBookingUpdate('quick_booking', $booking);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
        }

        $booking['tax'] = Tax::active()->get();

        return $this->sendResponse($booking, __('booking.booking_create'));
    }

    public function requestData($request)
    {
        return [
            'branch_id' => $request->branch_id,
            'service_id' => $request->service_id,
            'date' => $request->date,
            'employee_id' => $request->employee_id,
            'start_date_time' => $request->start_date_time,
        ];
    }
}
