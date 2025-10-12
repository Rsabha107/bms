<?php

namespace App\Http\Controllers\Bbs\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\SendAdminCancelBookingEmailJob;
use App\Jobs\SendNewBookingEmailJob;
use App\Models\Bbs\BroadcastBooking;
use App\Models\Bbs\Event;
use App\Models\Mds\BookingSlot;
use App\Models\Mds\FunctionalArea;
use App\Models\Mds\DeliveryBooking;
use App\Models\Mds\DeliveryCargoType;
use App\Models\Mds\DeliveryRsp;

use App\Models\Mds\DeliveryType;
use App\Models\Mds\DeliveryVehicle;
use App\Models\Mds\DeliveryVehicleType;
use App\Models\Mds\DeliveryVenue;
use App\Models\Mds\DeliveryZone;
use App\Models\Mds\MdsDriver;
use App\Models\Mds\MdsEvent;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $eventId = session()->get('EVENT_ID');
        $bookings = BroadcastBooking::with('service')
            ->where('event_id', $eventId)
            ->get();

        return view('bbs.admin.booking.list', compact('bookings'));
    }

    public function list()
    {
        Log::info('BookingController::list request: ' . json_encode(request()->all()));
        $search = request('search');
        $sort = (request('sort')) ? request('sort') : "id";
        $order = (request('order')) ? request('order') : "DESC";
        $ops = BroadcastBooking::orderBy($sort, $order);

        if ($search) {
            $ops = $ops->where(function ($q) use ($search) {
                $q->whereHas('created_by_user', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                })
                    ->orWhereHas('event', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('venue', function ($query) use ($search) {
                        $query->where('title', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('service', function ($query) use ($search) {
                        $query->where('title', 'like', '%' . $search . '%');
                    });
            });
        }

        $total = $ops->count();
        $limit = request("limit");
        $limit = max(1, min($limit, 100)); // min=1, max=100
        $ops = $ops->paginate($limit)->through(function ($op) {

            // $location = Location::find($op->location_id);
            // auth()->user()->hasRole('SuperAdmin') ? $status = '<span class="badge badge-phoenix fs--2 ms-3 badge-phoenix-' . $op->status->color . ' " style="cursor: pointer;" id="editDriverStatus" data-id="' . $op->id . '" data-table="drivers_table"><span class="badge-label">' . $op->status->title . '</span><span class="ms-1 uil-edit-alt" style="height:12.8px;width:12.8px;cursor: pointer;"></span></span>' : 
            //                                      $status = '<span class="badge badge-phoenix fs--2 ms-3 badge-phoenix-' . $op->status->color . ' "><span class="badge-label">' . $op->status->title . '</span></span>';

            $image = '<img src="' . asset('storage/upload/service/images/' . $op->image) . '" width="53" height="53" alt="...">';
            // Log::info('image: ' . $image);
            $update_action =
                '<a href="javascript:void(0)" class="btn btn-sm" id="editEvents" data-id=' . $op->id .
                ' data-table="event_table" data-bs-toggle="tooltip" data-bs-placement="right" title="Update">' .
                '<i class="fa-solid fa-pen-to-square text-primary"></i></a>';
            $delete_action =
                '<a href="javascript:void(0)" class="btn btn-sm" data-table="bookings_table" data-id="' .
                $op->id .
                '" id="deleteBooking" data-bs-toggle="tooltip" data-bs-placement="right" title="Delete">' .
                '<i class="fa-solid fa-trash text-danger"></i></a></div></div>';

            $actions = $delete_action;
            return  [
                'id' => $op->id,
                // 'id' => '<div class="align-middle white-space-wrap fw-bold fs-9 ps-2">' .$op->id. '</div>',
                'created_by' => '<div class="align-middle text-wrap fs-9 ps-3 ps-1">' . $op->created_by_user?->name . '</div>',
                'event_id' => '<div class="align-middle text-wrap fs-9 ps-1">' . $op->event?->name . '</div>',
                'venue_id' => '<div class="align-middle text-wrap fs-9 ps-1">' . $op->venue?->title . '</div>',
                'match_id' => '<div class="align-middle text-wrap fs-9 ps-1">' . $op->match?->match_code . '</div>',
                'service_id' => '<div class="align-middle text-wrap fs-9 ps-1">' . $op->service?->title . '</div>',
                'quantity' => '<div class="align-middle text-wrap fs-9 ps-1">' . $op->quantity . '</div>',
                // 'image' => '<div class="align-middle  fs-9 ps-3">' . $op->image . '</div>',
                // 'status' => '<span class="badge badge-phoenix fs--2 ms-3 badge-phoenix-' . $venue->status->color . ' " style="cursor: pointer;" id="editDriverStatus" data-id="' . $venue->id . '" data-table="drivers_table"><span class="badge-label">' . $venue->status->title . '</span><span class="ms-1 uil-edit-alt" style="height:12.8px;width:12.8px;cursor: pointer;"></span></span>',
                'actions' => $actions,
                'created_at' => format_date($op->created_at,  'H:i:s'),
                'updated_at' => format_date($op->updated_at, 'H:i:s'),
            ];
        });

        return response()->json([
            "rows" => $ops->items(),
            "total" => $total,
        ]);
    }

    // public function index()
    // {

    //     $bookings = DeliveryBooking::all();
    //     $events = MdsEvent::all();
    //     $venues = DeliveryVenue::all();
    //     $rsps = DeliveryRsp::all();
    //     $drivers = MdsDriver::all();
    //     $vehicles = DeliveryVehicle::all();
    //     $vehicle_types = DeliveryVehicle::all();
    //     $delivery_types = DeliveryType::all();
    //     $cargos = DeliveryType::all();
    //     $loading_zones = DeliveryZone::all();
    //     $clients = FunctionalArea::all();

    //     return view('mds.admin.booking.list', compact(
    //         'bookings',
    //         'events',
    //         'venues',
    //         'rsps',
    //         'drivers',
    //         'vehicles',
    //         'vehicle_types',
    //         'delivery_types',
    //         'cargos',
    //         'loading_zones',
    //         'clients'
    //     ));
    // }

    public function dashboard()
    {
        return view('mds.admin.dashboard.index');
    }

    // list all events for calendar dates
    public function listEvent(Request $request)
    {
        Log::info('BookingController::listEvent request: ' . json_encode($request->all()));
        // $start = date('Y-m-d', strtotime($request->start));
        // $end = date('Y-m-d', strtotime($request->end));

        $cut_off_time = 24 - config('settings.booking_cutoff_time'); //config('mds.cut_off_time');

        Log::info('BookingController::listEvent cut_off_time: ' . $cut_off_time);
        $events = BookingSlot::where('venue_id', $request->venue_id)
            ->where('event_id', session()->get('EVENT_ID'))
            // ->where('bookings_slots_all', '>', 0)
            ->where('available_slots', '>', 0)
            ->where('slot_visibility', '<=', Carbon::now())
            ->where(function ($query) use ($cut_off_time) {
                $query->whereRaw("DATE_ADD(booking_date, INTERVAL '-0 $cut_off_time' DAY_HOUR) > NOW()");
            });

        if (auth()->user()->hasRole('Catering')) {
            $events = $events->where(function ($query) {
                $query->where('bookings_slots_all', '>', '0')
                    ->orWhere('bookings_slots_cat', '>', '0');
            });
            // if not catering then include the booking slots all slots only
        } else {
            $events = $events->where('bookings_slots_all', '>', '0');
        }

        $events = $events->distinct()->get('booking_date')
            // dd($events);
            ->map(fn($item) => [
                // 'id' => $item->id,
                // 'title' => $item->period.' - ('.$item->available_slots.' slots)',
                'start' => $item->booking_date,
                'end' => date('Y-m-d', strtotime($item->period_date . '+1 days')),
                'display' => 'background',
                'color' => 'green',
                'className' => ['bg-success'],
            ]);
        // dd($events);
        Log::info('BookingController::listEvent events: ' . json_encode($events));
        return response()->json($events);
    }

    // when clicking on an event or calendar date, get the available time slots
    public function get_times_cal(Request $request)
    {
        $date = $request->date;
        $venue_id = $request->venue_id;
        // LOG::info('inside get_times');
        // $formated_date = Carbon::createFromFormat('dmY', $date)->toDateString();
        // LOG::info('formated_date: '.$formated_date);
        // LOG::info('venue_id: '.$venue_id);
        // $venue = DeliverySchedulePeriod::where('period_date', '=', $date)
        //     ->where('venue_id', '=', $venue_id)
        //     // ->where('available_slots', '>', '0')
        //     ->get();
        // $cut_off_time = 24 - config('mds.cut_off_time');
        $cut_off_time = 24 - config('settings.booking_cutoff_time');


        Log::info('BookingController::get_times_cal date: ' . $date);
        Log::info('BookingController::get_times_cal venue_id: ' . $venue_id);
        Log::info('BookingController::get_times_cal EVENT_ID: ' . session()->get('EVENT_ID'));
        Log::info('BookingController::get_times_cal cut_off_time: ' . $cut_off_time);

        $venue = BookingSlot::where('booking_date', '=', $date)
            ->where('venue_id', '=', $venue_id)
            ->where('event_id', session()->get('EVENT_ID'))
            ->where('available_slots', '>', 0)
            ->where('slot_visibility', '<=', Carbon::now())
            ->where(function ($query) use ($cut_off_time) {
                $query->whereRaw("DATE_ADD(booking_date, INTERVAL '-0 $cut_off_time' DAY_HOUR) > NOW()");
            });

        // if catering then include the booking slots catering slots
        if (Auth::user()->hasRole('Catering')) {
            $venue = $venue->where(function ($query) {
                $query->where('bookings_slots_all', '>', '0')
                    ->orWhere('bookings_slots_cat', '>', '0');
            });
            // if not catering then include the booking slots all slots only
        } else {
            $venue = $venue->where('bookings_slots_all', '>', '0');
        }

        $venue = $venue->get();

        Log::info('BookingController::get_times_cal venue: ' . $venue);
        // $venue = DeliverySchedulePeriod::all();

        return response()->json(['venue' => $venue]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $schedules = DeliverySchedule::all();
        // $intervals = DeliverySchedulePeriod::all();
        // $venues = DeliveryVenue::all();
        $venues = BookingSlot::select('venue_id', 'venue_name')
            ->where('event_id', session()->get('EVENT_ID'))
            ->distinct()
            ->get();
        $events = MdsEvent::all();
        $rsps = DeliveryRsp::all();
        $drivers = MdsDriver::all();
        $vehicles = DeliveryVehicle::all();
        $vehicle_types = DeliveryVehicleType::all();
        $delivery_types = DeliveryType::all();
        $cargos = DeliveryCargoType::all();
        $loading_zones = DeliveryZone::all();
        $clients = FunctionalArea::all();

        return view('mds.admin.booking.create', compact(
            // 'schedules',
            // 'intervals',
            'venues',
            'events',
            'rsps',
            'drivers',
            'vehicles',
            'vehicle_types',
            'delivery_types',
            'cargos',
            'loading_zones',
            'clients'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());
        $user_id = Auth::user()->id;
        $booking = new DeliveryBooking();

        $rules = [
            'booking_date' => 'required',
            'schedule_period_id' => 'required',
            'venue_id' => 'required',
            'driver_id' => 'required',
            'vehicle_id' => 'required',
            'vehicle_type_id' => 'required',
            'receiver_name' => 'required',
            'receiver_contact_number' => 'required',
            'dispatch_id' => 'required',
            'cargo_id' => 'required',
            'loading_zone_id' => 'required',
        ];

        // $timeslots = DeliverySchedulePeriod::findOrFail($request->schedule_period_id);


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            Log::info($validator->errors());
            $error = true;
            $type = 'success';
            $message = $validator->messages();
            return redirect()->back()->withErrors($message)->withInput();
        } else {

            // check number of slots available.  if available slots = 0 then exit with a warning message.
            // this is incase a user grabed the last slot with this user is waiting ..
            $timeslots = BookingSlot::findOrFail($request->schedule_period_id);

            if ($timeslots->available_slots > 0) {

                $error = false;
                $type = 'success';
                $message = 'Booking created succesfully.' . $booking->id;

                $booking->booking_ref_number = 'MDS' . $booking->id;
                // $booking->schedule_id =  $timeslots->delivery_schedule_id;
                $booking->user_id =  $user_id;
                $booking->schedule_period_id = $request->schedule_period_id;
                $booking->booking_date = $request->booking_date;
                $booking->event_id = session()->get('EVENT_ID');
                // $booking->booking_date = Carbon::createFromFormat('d/m/Y', $request->booking_date)->toDateString();
                $booking->venue_id = $request->venue_id;
                $booking->client_id = $request->client_id;
                $booking->rsp_id = $timeslots->rsp_id;
                $booking->booking_party_company_name = $request->booking_party_company_name;
                $booking->booking_party_contact_name = $request->booking_party_contact_name;
                $booking->booking_party_contact_email = $request->booking_party_contact_email;
                $booking->booking_party_contact_number = $request->booking_party_contact_number;
                // $booking->delivering_party_company_name = $request->delivering_party_company_name;
                // $booking->delivering_party_contact_number = $request->delivering_party_contact_number;
                // $booking->delivering_party_contact_email = $request->delivering_party_contact_email;
                $booking->driver_id = $request->driver_id;
                $booking->vehicle_id = $request->vehicle_id;
                $booking->vehicle_type_id = $request->vehicle_type_id;
                $booking->receiver_name = $request->receiver_name;
                $booking->receiver_contact_number = $request->receiver_contact_number;
                $booking->dispatch_id = $request->dispatch_id;
                $booking->loading_zone_id = $request->loading_zone_id;
                $booking->cargo_id = $request->cargo_id;
                $booking->active_flag = $request->active_flag;
                $booking->created_by = $user_id;
                $booking->updated_by = $user_id;
                $booking->active_flag = 1;

                $timeslots->available_slots = $timeslots->available_slots - 1;
                $timeslots->used_slots = $timeslots->used_slots + 1;
                $timeslots->save();

                $booking->save();
            } else {
                $error = true;
                $type = 'error';
                $message = 'Time slot choosing has been used please choose a different time slot.' . $booking->id;
            }


            $notification = array(
                'message'       => $message,
                'alert-type'    => $type
            );

            $save_pass_pdf = $this->save_pass_pdf($booking);

            if ($save_pass_pdf) {
                $details = [
                    'email' => 'rsabha@gmail.com',
                    'email2' => auth()->user()->email,
                    'venue' => $booking->venue->title,
                    'booking_ref_number' => $booking->booking_ref_number,
                    'booking_date' => \Carbon\Carbon::parse($booking->booking_date)->format('l jS \of F Y'),
                    'booking_time_slot' => $booking->schedule->rsp_booking_slot,
                    'filename' => $booking->booking_ref_number . '.pdf',
                ];

                // Log::info('BookingController::store details: ' . json_encode($details));
                // Log::info('BookingController::store settings.send_notifications: ' . config('settings.send_notifications'));

                if (config('settings.send_notifications')) {
                    SendNewBookingEmailJob::dispatch($details);
                }
                // SendNewBookingEmailJob::dispatch($details);
            }
        }
        // return redirect()->route('mds.booking.add')->with($notification);
        return view('mds.admin.booking.confirmation', ['data' => $booking]);


        // return response()->json(['error' => $error, 'message' => $message]);
    }

    public function delete($id)
    {
        // LOG::info('inside delete');
        $op = DeliveryBooking::find($id);

        $details = [
            'email' => 'rsabha@gmail.com',
            'venue' => $op->venue->title,
            'booking_ref_number' => $op->booking_ref_number,
            'booking_date' => \Carbon\Carbon::parse($op->booking_date)->format('l jS \of F Y'),
            'booking_time_slot' => $op->schedule->rsp_booking_slot,
        ];

        // get the timeslot id
        $timeslot_id = $op->schedule_period_id;
        // get the timeslot
        $timeslot = BookingSlot::find($timeslot_id);

        $timeslot->available_slots = $timeslot->available_slots + 1;
        $timeslot->used_slots = $timeslot->used_slots - 1;

        $timeslot->save();
        $op->delete();

        // Log::info('BookingController::delete settings.send_notifications: ' . config('settings.send_notifications'));

        if (config('settings.send_notifications')) {
            SendAdminCancelBookingEmailJob::dispatch($details);
        }
        // SendAdminCancelBookingEmailJob::dispatch($details);

        $error = false;
        $message = 'Booking deleted succesfully.';

        $notification = array(
            'message'       => 'Booking deleted successfully',
            'alert-type'    => 'success'
        );

        return response()->json(['error' => $error, 'message' => $message]);
        // return redirect()->route('tracki.setup.workspace')->with($notification);
    } // delete

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function detail($id)
    {
        $booking = DeliveryBooking::findOrFail($id);

        // dd($project);

        // Log::alert('EmployeeController::getEmpEditView file_name: ' . $emp->emp_files?->file_name);

        $view = view('/mds/admin/booking/mv/detail', [
            'booking' => $booking,
        ])->render();

        return response()->json(['view' => $view]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $booking = DeliveryBooking::find($id);
        // $intervals = DeliverySchedulePeriod::all();
        $venues = DeliveryVenue::all();
        $events = MdsEvent::all();
        $rsps = DeliveryRsp::all();
        $drivers = MdsDriver::all();
        $vehicles = DeliveryVehicle::all();
        $vehicle_types = DeliveryVehicleType::all();
        $delivery_types = DeliveryType::all();
        $cargos = DeliveryType::all();
        $loading_zones = DeliveryZone::all();
        $clients = FunctionalArea::all();

        return view('mds.admin.booking.edit', compact(
            'booking',
            // 'intervals',
            'venues',
            'events',
            'rsps',
            'drivers',
            'vehicles',
            'vehicle_types',
            'delivery_types',
            'cargos',
            'loading_zones',
            'clients'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
        //  dd($request);
        $user_id = Auth::user()->id;
        $booking = DeliveryBooking::find($request->id);
        $timeslots = BookingSlot::findOrFail($request->schedule_period_id);

        // dd($booking);
        $rules = [
            'booking_date' => 'required',
            'schedule_period_id' => 'required',
            'venue_id' => 'required',
            'driver_id' => 'required',
            'vehicle_id' => 'required',
            'vehicle_type_id' => 'required',
            'receiver_name' => 'required',
            'receiver_contact_number' => 'required',
            'dispatch_id' => 'required',
            'cargo_id' => 'required',
            'loading_zone_id' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            Log::info($validator->errors());
            $error = true;
            $type = 'error';
            $message = 'Booking could not be created';
        } else {

            // check number of slots available.  if available slots = 0 then exit with a warning message.
            // this is incase a user grabed the last slot with this user is waiting ..

            if ($timeslots->available_slots > 0) {

                $error = false;
                $type = 'success';
                $message = 'Booking updated succesfully.' . $booking->id;

                Log::info('booking->schedule_period_id: ' . $booking->schedule_period_id);
                Log::info('request->schedule_period_id: ' . $request->schedule_period_id);

                if ($request->schedule_period_id != $booking->schedule_period_id) {
                    Log::info('booking->schedule_period_id: ' . $booking->schedule_period_id);
                    Log::info('request->schedule_period_id: ' . $request->schedule_period_id);

                    $timeslots->available_slots = $timeslots->available_slots - 1;
                    $timeslots->used_slots = $timeslots->used_slots + 1;

                    $old_timeslot = BookingSlot::findOrFail($booking->schedule_period_id);
                    $old_timeslot->available_slots = $old_timeslot->available_slots + 1;
                    $old_timeslot->used_slots = $old_timeslot->used_slots - 1;
                } else {
                    $timeslots->available_slots = $timeslots->available_slots;
                    $timeslots->used_slots = $timeslots->used_slots;
                }

                // $booking->booking_ref_number = 'MDS' . $booking->id;
                // $booking->schedule_id =  $timeslots->delivery_schedule_id;
                $booking->schedule_period_id = $request->schedule_period_id;
                // $booking->booking_date = Carbon::createFromFormat('Y/m/d', $request->booking_date)->toDateString();
                $booking->booking_date = $request->booking_date;
                $booking->venue_id = $request->venue_id;
                $booking->client_id = $request->client_id;
                $booking->rsp_id = $timeslots->rsp_id;
                $booking->booking_party_company_name = $request->booking_party_company_name;
                $booking->booking_party_contact_name = $request->booking_party_contact_name;
                $booking->booking_party_contact_email = $request->booking_party_contact_email;
                $booking->booking_party_contact_number = $request->booking_party_contact_number;
                // $booking->delivering_party_company_name = $request->delivering_party_company_name;
                // $booking->delivering_party_contact_number = $request->delivering_party_contact_number;
                // $booking->delivering_party_contact_email = $request->delivering_party_contact_email;
                $booking->driver_id = $request->driver_id;
                $booking->vehicle_id = $request->vehicle_id;
                $booking->vehicle_type_id = $request->vehicle_type_id;
                $booking->receiver_name = $request->receiver_name;
                $booking->receiver_contact_number = $request->receiver_contact_number;
                $booking->dispatch_id = $request->dispatch_id;
                $booking->loading_zone_id = $request->loading_zone_id;
                $booking->cargo_id = $request->cargo_id;
                $booking->active_flag = $request->active_flag;
                $booking->created_by = $user_id;
                $booking->updated_by = $user_id;
                $booking->active_flag = 1;

                $timeslots->save();
                if (isset($old_timeslot)) {
                    $old_timeslot->save();
                }
                $booking->save();
            } else {
                $error = true;
                $type = 'error';
                $message = 'Time slot choosing has been used. please choose a different time slot.' . $booking->id;
            }
        }

        $notification = array(
            'message'       => $message,
            'alert-type'    => $type
        );

        return redirect()->route('mds.admin.booking')->with($notification);
        // return view('mds.admin.booking');


        // return response()->json(['error' => $error, 'message' => $message]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function save_pass_pdf($booking)
    {
        // set_time_limit(300);
        // $booking = DeliveryBooking::findOrFail($id);
        $qr_code = getQrCode($booking->id, 100);
        $data = [
            'to' => 'Sam Example',
            'subtotal' => '5.00',
            'tax' => '.35',
            'total' => '5.35',
            'receipeint_company' => 'GWC Logistics',
            'booking' => $booking,
            'qr_code' => $qr_code,

        ];

        $data['css'] = public_path('assets/css/invoice.css');
        $pdf = Pdf::loadView('mds.admin.booking.passx', $data);
        Storage::disk('private')->put('mds/pdf-exports/' . $booking->booking_ref_number . '.pdf', $pdf->output());

        return 1;
    }

    public function passPdf(Request $request, $id)
    {
        // set_time_limit(300);
        $booking = DeliveryBooking::findOrFail($id);
        $qr_code = getQrCode($booking->id, 100);


        $data = [
            'to' => 'Sam Example',
            'subtotal' => '5.00',
            'tax' => '.35',
            'total' => '5.35',
            'receipeint_company' => 'GWC Logistics',
            'booking' => $booking,
            'qr_code' => $qr_code,

        ];

        if ($request->has('preview')) {
            $data['css'] = asset('assets/css/invoice.css');
            return view('mds.booking.passx', $data);
        } else {
            $data['css'] = public_path('assets/css/invoice.css');
        }

        // Pdf::view('mds.booking.passx');
        // Pdf::view('mds.booking.passx')->save('/upload/passx.pdf');
        // return view('mds.booking.passx', $data);
        $pdf = Pdf::loadView('mds.admin.booking.passx', $data);
        // Storage::disk('private')->putFileAs('mds', $pdf->output(), 'booking_pass.pdf');
        Storage::disk('private')->put('mds/pdf-exports/' . $booking->booking_ref_number . '.pdf', $pdf->output());
        // return $pdf->download('itsolutionstuff.pdf');
        return $pdf->stream();
    }  //taskDetailsPDF

    // public function get_times($date, $venue_id)
    // {
    //     // LOG::info('inside get_times');
    //     $formated_date = Carbon::createFromFormat('dmY', $date)->toDateString();
    //     // LOG::info('formated_date: '.$formated_date);
    //     // LOG::info('venue_id: '.$venue_id);
    //     // $venue = DeliverySchedulePeriod::where('period_date', '=', $formated_date)
    //     //     ->where('venue_id', '=', $venue_id)
    //     //     // ->where('available_slots', '>', '0')
    //     //     ->get();

    //     // $venue = DeliverySchedulePeriod::all();

    //     // return response()->json(['venue' => $venue]);
    // }

    public function switch($id)
    {
        if ($id) {
            if (Event::findOrFail($id)) {
                Log::info('Event ID: ' . $id);

                session()->put('EVENT_ID', $id);
                Log::info('Event ID: ' . session()->get('EVENT_ID'));
                // return redirect()->route('tracki.project.show.card')->with('message', 'Workspace switched successfully.');
                return redirect()->route('mds.admin.booking')->with('message', 'Event Switched.');
                // return back()->with('message', 'Event Switched.');
            } else {
                // return back()->with('error', 'Workspace not found.');
                // return redirect()->route('tracki.project.show.card')->with('error', 'Workspace not found.');
                return back()->with('error', 'Event not found.');
            }
        } else {
            session()->forget('EVENT_ID');
            // return redirect()->route('tracki.project.show.card')->with('message', 'Workspace switched successfully. now showing all workspace data');
            return back()->withInput();
        }
    }

    public function pickEvent(Request $request)
    {
        // $events = MdsEvent::all();
        // $this->switch($request->event_id);
        // return view('mds.admin.booking.pick', compact('events'));
        if ($request->event_id) {
            Log::info('Event ID: ' . $request->event_id);
            if (MdsEvent::findOrFail($request->event_id) && !session()->has('EVENT_ID')) {
                Log::info('Inside if statement Event ID: ' . $request->event_id);

                session()->put('EVENT_ID', $request->event_id);
                Log::info('session EVENT_ID: ' . session()->get('EVENT_ID'));
                Log::info('before redirect');
                // return redirect()->route('tracki.project.show.card')->with('message', 'Workspace switched successfully.');
                return redirect()->route('mds.admin.booking')->with('message', 'Event Switched.');
                // return back()->with('message', 'Event Switched.');
            }
        }
        //  else {
        // return back()->with('error', 'Workspace not found.');
        // return redirect()->route('tracki.project.show.card')->with('error', 'Workspace not found.');
        Log::info('event_id is null');
        return redirect()->route('mds.admin.booking')->with('error', 'Event not found.');
        // }
    }
}
