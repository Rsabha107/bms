<?php

namespace App\Http\Controllers\Bbs\Setting;

use App\Http\Controllers\Controller;
use App\Models\Bbs\BroadcastBooking;
use App\Models\Bbs\BroadcastService;
use App\Models\Bbs\Event;
use App\Models\Bbs\MenuItem;
use App\Models\Mds\DriverStatus;
use App\Models\Mds\MdsDriver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Laravel\Facades\Image;


// use Illuminate\Support\Facades\Redirect;

class ServiceController extends Controller
{
    //
    public function index()
    {
        Log::info('ServiceController@index');
        $broadcast_services = BroadcastService::all();
        $menus = MenuItem::whereNotNull('parent_id')->with('children')->orderBy('order_number')->get();
        return view('bbs.setting.service.list', compact('broadcast_services', 'menus'));
    }


    public function showServices()
    {
        Log::info('ServiceController@showServices');
        $broadcast_services = BroadcastService::all();
        return view('bbs.setting.service.list', compact('broadcast_services'));
    }

    public function adminList()
    {
        $services = BroadcastService::all();
        return view('bbs.admin.booking.list', compact('services'));
    }

    public function customerList()
    {
        $services = BroadcastService::all();
        return view('bbs.customer.booking.list', compact('services'));
    }

    // public function cart()
    // {
    //     $eventId = session()->get('EVENT_ID');

    //     if (Auth::user()->hasRole('SuperAdmin') || Auth::user()->hasRole('Manager')) {
    //         // SuperAdmin & Manager should see ALL bookings for the event
    //         $bookings = BroadcastBooking::with('service')
    //             ->where('event_id', $eventId)
    //             ->get();

    //         return view('bbs.admin.booking.cart', compact('bookings'));
    //     } elseif (Auth::user()->hasRole('Customer')) {
    //         // Customer should only see their own bookings for the event
    //         $bookings = BroadcastBooking::with('service')
    //             ->where('event_id', $eventId)
    //             ->where('created_by', Auth::user()->id)
    //             ->get();

    //         return view('bbs.customer.booking.cart', compact('bookings'));
    //     } else {
    //         abort(403, 'Unauthorized');
    //     }
    // }


    public function switch($id = null)
    {
        if ($id) {
            $event = Event::find($id);

            if ($event) {
                Log::info('Event ID: ' . $id);

                session()->put('EVENT_ID', $id);
                Log::info('Event ID: ' . session()->get('EVENT_ID'));

                return redirect()->route('bbs.customer.booking')->with('message', 'Event switched.');
            } else {
                return back()->with('error', 'Event not found.');
            }
        } else {
            session()->forget('EVENT_ID');
            return back()->withInput();
        }
    }


    public function detail($id = null)
    {
        $service = BroadcastService::findOrFail($id);
        $service->load('service_images');

        if (Auth::user()->hasRole('SuperAdmin')) {
            // Show admin detail view
            return view('bbs.admin.booking.detail', compact('service'));
        } elseif (Auth::user()->hasRole('Customer')) {
            // Show customer detail view
            return view('bbs.customer.booking.detail', compact('service'));
        } else {
            // Optional: restrict access
            abort(403, 'Unauthorized');
        }
    }


    public function get($id)
    {
        $op = BroadcastService::findOrFail($id);
        return response()->json(['op' => $op]);
    }

    public function editStatus($id)
    {
        //  dd('editTaskProgress');
        $data = MdsDriver::find($id);
        //dd($data);
        $data_arr = [];

        $data_arr[] = [
            "id"        => $data->id,
            "status_id"  => $data->status_id,
        ];

        $response = ["retData"  => $data_arr];
        return response()->json($response);
    } // editStatus

    public function updateStatus(Request $request)
    {

        $driver = MdsDriver::findOrFail($request->id);
        $status_title = DriverStatus::findOrFail($request->status_id);

        Log::info($status_title->title);
        $driver->update([
            'status_id' => $request->status_id,
        ]);

        $notification = array(
            'message'       => 'Driver status updated successfully',
            'alert-type'    => 'success'
        );

        return response()->json(['error' => false, 'message' => 'Driver Status updated successfully.', 'id' => $driver->id]);

        // Toastr::success('Has been add successfully :)','Success');
        // return redirect()->back()->with($notification);
        // deleteEvent
    } //updateStatus


    public function list()
    {
        $search = request('search');
        $sort = (request('sort')) ? request('sort') : "id";
        $order = (request('order')) ? request('order') : "DESC";
        $ops = BroadcastService::orderBy($sort, $order);

        if ($search) {
            $ops = $ops->where(function ($query) use ($search) {
                $query->where('first_name', 'like', '%' . $search . '%')
                    ->orWhere('last_name', 'like', '%' . $search . '%')
                    ->orWhere('mobile_number', 'like', '%' . $search . '%')
                    ->orWhere('national_identifier_number', 'like', '%' . $search . '%')
                    ->orWhere('id', 'like', '%' . $search . '%');
            });
        }
        $total = $ops->count();
        $ops = $ops->paginate(request("limit"))->through(function ($op) {

            // $location = Location::find($op->location_id);
            // auth()->user()->hasRole('SuperAdmin') ? $status = '<span class="badge badge-phoenix fs--2 ms-3 badge-phoenix-' . $op->status->color . ' " style="cursor: pointer;" id="editDriverStatus" data-id="' . $op->id . '" data-table="drivers_table"><span class="badge-label">' . $op->status->title . '</span><span class="ms-1 uil-edit-alt" style="height:12.8px;width:12.8px;cursor: pointer;"></span></span>' : 
            //                                      $status = '<span class="badge badge-phoenix fs--2 ms-3 badge-phoenix-' . $op->status->color . ' "><span class="badge-label">' . $op->status->title . '</span></span>';

            $image = '<img src="' . asset('storage/upload/service/images/' . $op->image) . '" width="53" height="53" alt="...">';
            // Log::info('image: ' . $image);
            return  [
                'id' => $op->id,
                // 'id' => '<div class="align-middle white-space-wrap fw-bold fs-9 ps-2">' .$op->id. '</div>',
                'image' => $image,
                'menu_item_id' => '<div class="align-middle text-wrap fs-9 ps-3">' . $op->menu_item?->title . '</div>',
                'title' => '<div class="align-middle text-wrap fs-9 ps-3">' . $op->title . '</div>',
                'short_description' => '<div class="align-middle text-wrap  fs-9 ps-3" >' . $op->short_description . '</div>',
                'long_description' => '<div class="align-middle text-wrap fs-9 ps-3">' . $op->long_description . '</div>',

                'created_at' => format_date($op->created_at,  'H:i:s'),
                'updated_at' => format_date($op->updated_at, 'H:i:s'),
            ];
        });

        return response()->json([
            "rows" => $ops->items(),
            "total" => $total,
        ]);
    }

    public function storeService(Request $request)
    {
        //
        // dd($request->all());
        $user_id = Auth::user()->id;
        $booking = new BroadcastBooking();

        $rules = [
            'service_id' => 'required',
            'quantity' => 'required',
            // 'x' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            Log::info($validator->errors()->all(':message'));
            $type = 'error';
            // $message = implode($validator->errors()->all(':message'));  // use this for json/jquery
            $message = implode($validator->errors()->all('<div>:message</div>'));  // use this for json/jquery
            Log::info($message);
            // $message = $validator->errors()->all(':message');
            $notification = array(
                'message'       => $message,
                'alert-type'    => $type
            );
            return redirect()->back()->with($notification);
        } else {

            // check number of slots available.  if available slots = 0 then exit with a warning message.
            // this is incase a user grabed the last slot with this user is waiting ..


            $error = false;
            $type = 'success';
            $message = 'Booking created succesfully.' . $booking->id;

            // $booking->booking_ref_number = 'MDS' . $booking->id;
            // $booking->schedule_id =  $timeslots->delivery_schedule_id;
            $booking->service_id = $request->service_id;
            $booking->quantity = intval($request->quantity);
            $booking->unit_price = intval($request->unit_price);
            $booking->total_price = intval($request->quantity) * intval($request->unit_price);
            $booking->quantity = intval($request->quantity);
            $booking->created_by = $user_id;
            $booking->updated_by = $user_id;
            $booking->event_id = session()->get('EVENT_ID'); // Tie booking to current event
            $service = BroadcastService::find($request->service_id);

            $service->available_slots = $service->available_slots - $request->quantity;
            $service->used_slots = $service->used_slots + $request->quantity;
            // $booking->event_id = session()->get('EVENT_ID');
            // $booking->booking_date = Carbon::createFromFormat('d/m/Y', $request->booking_date)->toDateString();

            $service->save();
            $booking->save();

            $notification = array(
                'message'       => $message,
                'alert-type'    => $type
            );
        }
        return redirect()->route('bbs.admin.booking.cart')->with($notification);
        // return view('bbs.customer.booking.cart');
        // return response()->json(['error' => $error, 'message' => $message]);
    }

    public function store(Request $request)
    {
        //
        // dd($request);
        $user_id = Auth::user()->id;
        $op = new BroadcastService();

        $rules = [
            'title' => ['required'],
            'short_description' => ['required'],
            'menu_item_id' => ['required'],
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            Log::info($validator->errors());
            $error = true;
            $message = implode($validator->errors()->all('<div>:message</div>'));  // use this for json/jquery
            return response()->json(['error' => $error, 'message' => $message]);
        } else {

            // if ($request->hasFile('file_name')) {

            //     $file = $request->file('file_name');
            //     $fileNameWithExt = $request->file('file_name')->getClientOriginalName();
            //     // get file name
            //     $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //     // get extension
            //     $extension = $request->file('file_name')->getClientOriginalExtension();

            //     // $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            //     $fileNameToStore = rand() . date('ymdHis') . $file->getClientOriginalName();  // use this

            //     Log::info($fileNameWithExt);
            //     Log::info($filename);
            //     Log::info($extension);
            //     Log::info($fileNameToStore);

            //     $image = Image::read($file);
            //     $image->resize(530, 530)->save('storage/upload/service/images/' . $fileNameToStore);

            //     // $path = $request->file('file_name')->storeAs('private/mds/event/logo', $fileNameToStore);
            //     // Storage::disk('private')->putFileAs('bbs/service/images', $file, $fileNameToStore);
            //     // $path = $request->file('file_name')->storeAs('public/upload/service/images', $fileNameToStore);


            //     // $path = $file->move('upload/profile_images/', $fileNameToStore);
            //     // Log::info($path);


            // } else {
            //     $fileNameToStore = 'noimage.jpg';
            //     $fileNameWithExt = 'noimage.jpg';
            // }

            // $op->image = $fileNameToStore;
            // $op->original_image_name = $fileNameWithExt;

            $error = false;
            $message = 'Service created succesfully.' . $op->id;

            $op->title = $request->title;
            $op->menu_item_id = $request->menu_item_id;
            $op->short_description = $request->short_description;
            $op->long_description = $request->long_description;
            $op->max_slots = $request->max_slots;
            $op->available_slots = $request->available_slots;
            $op->used_slots = $request->used_slots;
            $op->created_by = $user_id;
            $op->updated_by = $user_id;

            $op->save();
        }

        $notification = array(
            'message'       => 'Service created successfully',
            'alert-type'    => 'success'
        );

        return response()->json(['error' => $error, 'message' => $message]);
    }

    public function update(Request $request)
    {
        //
        // dd($request);
        Log::info('update');
        Log::info($request->all());

        $rules = [
            'title' => ['required'],
            'short_description' => ['required'],
            'menu_item_id' => ['required'],
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $error = true;
            $message = implode($validator->errors()->all('<div>:message</div>'));  // use this for json/jquery
            return response()->json(['error' => $error, 'message' => $message]);
        } else {

            $user_id = Auth::user()->id;
            $op = BroadcastService::find($request->id);

            // if ($request->hasFile('file_name')) {

            //     $file = $request->file('file_name');
            //     $fileNameWithExt = $request->file('file_name')->getClientOriginalName();
            //     // get file name
            //     $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //     // get extension
            //     $extension = $request->file('file_name')->getClientOriginalExtension();

            //     $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            //     $fileNameToStore = rand() . date('ymdHis') . $file->getClientOriginalName();  // use this

            //     Log::info($fileNameWithExt);
            //     Log::info($filename);
            //     Log::info($extension);
            //     Log::info($fileNameToStore);

            //     // upload
            //     if ($op->event_logo != 'default.png') {
            //         // Storage::delete('bbs/service/images/' . $op->image);
            //         Storage::delete('public/upload/service/images/' . $op->image);
            //     }

            //     $image = Image::read($file);
            //     $image->resize(530, 530)->save('storage/upload/service/images/' . $fileNameToStore);

            //     // $path = $request->file('file_name')->storeAs('private/mds/event/logo', $fileNameToStore);
            //     // Storage::disk('private')->putFileAs('bbs/service/images', $file, $fileNameToStore);
            //     // $path = $request->file('file_name')->storeAs('public/upload/service/images', $fileNameToStore);


            //     // $path = $file->move('upload/profile_images/', $fileNameToStore);
            //     // Log::info($path);

            //     $op->image = $fileNameToStore;
            //     $op->original_image_name = $fileNameWithExt;
            // } else {
            //     $fileNameToStore = 'noimage.jpg';
            // }

            $error = false;
            $message = 'Service updated succesfully.' . $op->id;

            $op->title = $request->title;
            $op->menu_item_id = $request->menu_item_id;
            $op->short_description = $request->short_description;
            $op->long_description = $request->long_description;
            $op->max_slots = $request->max_slots;
            $op->available_slots = $request->available_slots;
            $op->used_slots = $request->used_slots;
            $op->updated_by = $user_id;

            $op->save();
        }

        $notification = array(
            'message'       => 'Service updated successfully',
            'alert-type'    => 'success'
        );

        return response()->json(['error' => $error, 'message' => $message]);
    }

    public function deleteBooking($id)
    {
        $op = BroadcastBooking::findOrFail($id);
        $service = BroadcastService::find($op->service_id);
        $service->available_slots = $service->available_slots + $op->quantity;
        $service->used_slots = $service->used_slots - $op->quantity;
        $service->save();
        $op->delete();

        $error = false;
        $message = 'Service deleted succesfully.';

        $notification = array(
            'message'       => 'Service deleted successfully',
            'alert-type'    => 'success'
        );

        return redirect()->route('bbs.admin.booking.cart')->with($notification);
        // return response()->json(['error' => $error, 'message' => $message]);
    } // deleteBooking

    public function delete($id)
    {
        $op = BroadcastService::findOrFail($id);
        Storage::delete('public/upload/service/images/' . $op->image);
        $op->delete();

        $error = false;
        $message = 'Service deleted succesfully.';

        $notification = array(
            'message'       => 'Service deleted successfully',
            'alert-type'    => 'success'
        );

        return response()->json(['error' => $error, 'message' => $message]);
        // return redirect()->route('tracki.setup.workspace')->with($notification);
    } // delete

    public function getPrivateFile($file)
    {
        $file_path = 'app/private/bbs/service/images/' . $file;
        $path = storage_path($file_path);

        Log::info('path: ' . $path);

        return response()->file($path);
    }

    public function getView($id)
    {
        $service = BroadcastService::find($id);

        $file_path = 'app/private/bbs/service/images/';

        $file_path = $file_path . $service->image;
        $path = storage_path($file_path);

        // $url = Storage::disk('private')->temporaryUrl($path, now()->addMinutes(10));

        // $file_path = 'mds/event/logo/' . $event->event_logo;

        if (Storage::disk('private')->exists($file_path)) {
            $event_logo = Storage::url($file_path);
        } else {
            $event_logo = Storage::url('/app/private/bbs/service/images/noimage.jpg');
        }

        // Log::info($url);
        Log::info('path: ' . $event_logo);
        Log::info('path: ' . $path);

        // return response()->file($path);
        // Log::info(response()->file('/app/private/mds/event/logo/'.$event->event_logo));

        $view = view('/bbs/setting/service/mv/edit', [
            'service' => $service,
            'event_logo' => $path,
        ])->render();

        return response()->json(['view' => $view]);
    }  // End function getProjectView

}
