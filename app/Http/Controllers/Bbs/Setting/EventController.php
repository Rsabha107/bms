<?php

namespace App\Http\Controllers\Bbs\Setting;

use App\Http\Controllers\Controller;
use App\Models\GlobalStatus;
use App\Models\Bbs\GlobalYN;
use App\Models\Bbs\Event;
use App\Models\Bbs\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    //
    public function index()
    {
        $events = Event::all();
        $venues = Venue::all();
        return view('bbs.setting.event.list', compact('events', 'venues'));
    }

    public function get($id)
    {
        $op = Event::findOrFail($id);
        $image_path = Storage::path('private/bbs/event/logo/' . $op->event_logo);
        return response()->json(['op' => $op, 'venues' => $op->venues, 'image_path' => $image_path]);
    }

    // public function update(Request $request)
    // {
    //     $rules = [
    //         'id' => ['required'],
    //         'name' => 'required',
    //         'active_flag' => 'required',
    //     ];

    //     $validator = Validator::make($request->all(), $rules);

    //     if ($validator->fails()) {
    //         // Log::info($validator->errors());
    //         $error = true;
    //         // $message = 'Employee not create.' . $op->id;
    //         $message = implode($validator->errors()->all('<div>:message</div>'));
    //     } else {
    //         $op = Event::findOrFail($request->id);

    //         $error = false;
    //         $message = 'Event ' . $op->name . ' successfully updated';

    //         if ($request->hasFile('file_name')) {

    //             $file = $request->file('file_name');
    //             $fileNameWithExt = $request->file('file_name')->getClientOriginalName();
    //             // get file name
    //             $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
    //             // get extension
    //             $extension = $request->file('file_name')->getClientOriginalExtension();

    //             $fileNameToStore = $filename . '_' . time() . '.' . $extension;
    //             $fileNameToStore = rand() . date('ymdHis') . $file->getClientOriginalName();  // use this

    //             Log::info($fileNameWithExt);
    //             Log::info($filename);
    //             Log::info($extension);
    //             Log::info($fileNameToStore);

    //             // upload
    //             if ($op->event_logo != 'default.png') {
    //                 Storage::delete('bbs/event/logo/' . $op->event_logo);
    //             }

    //             // $path = $request->file('file_name')->storeAs('private/mds/event/logo', $fileNameToStore);
    //             Storage::disk('private')->putFileAs('bbs/event/logo', $file, $fileNameToStore);

    //             // $path = $file->move('upload/profile_images/', $fileNameToStore);
    //             // Log::info($path);


    //         } else {
    //             $fileNameToStore = 'noimage.jpg';
    //         }

    //         $op->event_logo = $fileNameToStore;


    //         $op->name = $request->name;
    //         $op->active_flag = $request->active_flag;
    //         $op->updated_by = auth()->user()->id;

    //         $op->save();
    //     }

    //     return response()->json([
    //         'error' => $error,
    //         'message' => $message,
    //     ]);
    // }

    public function list()
    {
        $search = request('search');
        $sort = (request('sort')) ? request('sort') : "id";
        $order = (request('order')) ? request('order') : "DESC";
        $ops = Event::orderBy($sort, $order);

        if ($search) {
            $ops = $ops->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('id', 'like', '%' . $search . '%');
            });
        }
        $total = $ops->count();
        $ops = $ops->paginate(request("limit"))->through(function ($op) {

            if ($op->event_logo) {
                $route_image = route('bbs.setting.event.file', $op->event_logo);
                $image = ' <div class="avatar avatar-m">
                                <a  href="#" role="button" id="editEvents" data-id=' . $op->id . ' data-table="event_table">
                                    <img class="rounded-circle pull-up" src="' . $route_image . '" alt="" />
                                </a>
                            </div>';
            } else {
                $image = '  <div class="avatar avatar-m  me-1" >
                                <a class="dropdown-toggle dropdown-caret-none d-inline-block" href="#" role="button" id="editEvents" data-id=' . $op->id . ' data-table="event_table">
                                    <div class="avatar avatar-m  rounded-circle pull-up">
                                        <div class="avatar-name rounded-circle me-2"><span>' . generateInitials($op->name) . '</span></div>
                                    </div>
                                </a>
                            </div>';
            }

            $div_action = '<div class="font-sans-serif btn-reveal-trigger position-static">';
            // $update_action =
            //     '<a href="javascript:void(0)" class="btn btn-sm" id="editEvents" data-id=' . $op->id .
            //     ' data-table="event_table" data-bs-toggle="tooltip" data-bs-placement="right" title="Update">' .
            //     '<i class="fa-solid fa-pen-to-square text-primary"></i></a>';
            $delete_action =
                '<a href="javascript:void(0)" class="btn btn-sm" data-table="event_table" data-id="' .
                $op->id .
                '" id="deleteEvent" data-bs-toggle="tooltip" data-bs-placement="right" title="Delete">' .
                '<i class="fa-solid fa-trash text-danger"></i></a></div></div>';
            $update_action =
                '<a href="javascript:void(0)" class="btn btn-sm" id="editEvents" data-id=' . $op->id .
                ' data-table="event_table" data-bs-toggle="tooltip" data-bs-placement="right" title="Update">' .
                '<i class="fa-solid fa-pen-to-square text-primary"></i></a>';

            $venues_display = '';
            appLog($op);
            appLog($op->venues);
            foreach ($op->venues as $venue) {
                $venues_display .= '<span class="badge badge-pill bg-body-tertiary">' . $venue->short_name . '</span> ';
            }
            // $actions = $div_action . $profile_action;


            return  [
                'id' => $op->id,
                'image' => $image,
                // 'id' => '<div class="align-middle white-space-wrap fw-bold fs-10 ps-2">' .$op->id. '</div>',
                'title' => '<div class="align-middle white-space-wrap fs-9 ps-3">' . $op->name . '</div>',
                'venues' => $venues_display,
                'status' => '<span class="badge badge-phoenix fs--2 align-middle white-space-wrap ms-3 badge-phoenix-' . $op->active_status->color . ' " style="cursor: pointer;" id="editDriverStatus" data-id="' . $op->id . '" data-table="drivers_table"><span class="badge-label">' . $op->active_status->name . '</span><span class="ms-1 uil-edit-alt" style="height:12.8px;width:12.8px;cursor: pointer;"></span></span>',
                'actions' => $update_action . $delete_action,
                'created_at' => format_date($op->created_at,  'H:i:s'),
                'updated_at' => format_date($op->updated_at, 'H:i:s'),
            ];
        });

        return response()->json([
            "rows" => $ops->items(),
            "total" => $total,
        ]);
    }

    // public function store(Request $request)
    // {
    //     //
    //     // dd($request);
    //     $user_id = Auth::user()->id;
    //     $op = new Event();

    //     $rules = [
    //         'name' => 'required',
    //     ];

    //     $validator = Validator::make($request->all(), $rules);

    //     if ($validator->fails()) {
    //         Log::info($validator->errors());
    //         $error = true;
    //         $message = implode($validator->errors()->all('<div>:message</div>'));
    //     } else {

    //         Log::info($request->all());
    //         if ($request->hasFile('file_name')) {

    //             $file = $request->file('file_name');
    //             $fileNameWithExt = $request->file('file_name')->getClientOriginalName();
    //             // get file name
    //             $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
    //             // get extension
    //             $extension = $request->file('file_name')->getClientOriginalExtension();

    //             $fileNameToStore = $filename . '_' . time() . '.' . $extension;
    //             $fileNameToStore = rand() . date('ymdHis') . $file->getClientOriginalName();  // use this

    //             Log::info($fileNameWithExt);
    //             Log::info($filename);
    //             Log::info($extension);
    //             Log::info($fileNameToStore);

    //             // $path = $request->file('file_name')->storeAs('private/mds/event/logo', $fileNameToStore);
    //             Storage::disk('private')->putFileAs('bbs/event/logo', $file, $fileNameToStore);

    //             // $path = $file->move('upload/profile_images/', $fileNameToStore);
    //             // Log::info($path);


    //         } else {
    //             $fileNameToStore = 'noimage.jpg';
    //         }

    //         $op->event_logo = $fileNameToStore;

    //         $error = false;
    //         $message = 'Event created succesfully.' . $op->id;

    //         $op->name = $request->name;
    //         $op->active_flag = 1;
    //         $op->created_at = $user_id;
    //         $op->updated_at = $user_id;
    //         $op->created_by = $user_id;
    //         $op->updated_by = $user_id;
    //         $op->active_flag = 1;

    //         $op->save();
    //     }

    //     $notification = array(
    //         'message'       => 'Event created successfully',
    //         'alert-type'    => 'success'
    //     );

    //     return response()->json(['error' => $error, 'message' => $message]);
    // }

    public function store(Request $request)
    {
        //
        // dd($request);
        $user_id = Auth::user()->id;
        $op = new Event();

        $rules = [
            'name' => 'required',
            'file_name' => 'sometimes|file|mimes:jpeg,png,jpg|max:2048',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            appLog('validator: ' . $validator->errors());;
            $error = true;
            $message = implode($validator->errors()->all('<div>:message</div>'));
        } else {

            if ($request->hasFile('file_name')) {

                $file = $request->file('file_name');
                $fileNameWithExt = $request->file('file_name')->getClientOriginalName();
                // get file name
                $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                // get extension
                $extension = $request->file('file_name')->getClientOriginalExtension();

                $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                $fileNameToStore = rand() . date('ymdHis') . $file->getClientOriginalName();  // use this

                appLog($fileNameWithExt);
                appLog($filename);
                appLog($extension);
                appLog($fileNameToStore);

                // $path = $request->file('file_name')->storeAs('private/mds/event/logo', $fileNameToStore);
                Storage::disk('private')->putFileAs('bbs/event/logo', $file, $fileNameToStore);
            } else {
                $fileNameToStore = 'noimage.jpg';
            }

            $op->event_logo = $fileNameToStore;
            $error = false;
            $message = 'Event created succesfully.' . $op->id;

            $op->name = $request->name;
            $op->active_flag = 1;
            $op->created_by = $user_id;
            $op->updated_by = $user_id;

            $op->save();

            if ($request->venue_id) {
                foreach ($request->venue_id as $key => $data) {
                    $op->venues()->attach($request->venue_id[$key]);
                }
            }
        }

        $notification = array(
            'message'       => 'Event created successfully',
            'alert-type'    => 'success'
        );

        return response()->json(['error' => $error, 'message' => $message]);
    }

        public function update(Request $request)
    {
        //
        // dd($request);
        $user_id = Auth::user()->id;
        $op = Event::findOrFail($request->id);
        if (!$op) {
            return response()->json(['error' => true, 'message' => 'Event not found.']);
        }

        $rules = [
            'name' => 'required',
            'active_flag' => 'required',
            'id' => 'required|exists:events,id',
            'venue_id' => 'array',
            'venue_id.*' => 'exists:venues,id',
            'file_name' => 'sometimes|file|mimes:jpeg,png,jpg|max:2048',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            appLog('validator: ' . $validator->errors());;
            $error = true;
            $message = implode($validator->errors()->all('<div>:message</div>'));
        } else {

            if ($request->hasFile('file_name')) {

                $file = $request->file('file_name');
                $fileNameWithExt = $request->file('file_name')->getClientOriginalName();
                // get file name
                $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                // get extension
                $extension = $request->file('file_name')->getClientOriginalExtension();

                $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                $fileNameToStore = rand() . date('ymdHis') . $file->getClientOriginalName();  // use this

                appLog($fileNameWithExt);
                appLog($filename);
                appLog($extension);
                appLog($fileNameToStore);

                // upload
                if ($op->event_logo != 'default.png') {
                    Storage::delete('bbs/event/logo/' . $op->event_logo);
                }

                // $path = $request->file('file_name')->storeAs('private/mds/event/logo', $fileNameToStore);
                Storage::disk('private')->putFileAs('bbs/event/logo', $file, $fileNameToStore);

                // $path = $file->move('upload/profile_images/', $fileNameToStore);

            } else {
                // Storage::disk('private')->delete('vapp/event/logo/' . $op->event_logo);
                $fileNameToStore = 'noimage.jpg';
            }

            $op->event_logo = $fileNameToStore;

            $error = false;
            $message = 'Event updated succesfully.';

            $op->name = $request->name;
            $op->active_flag = $request->active_flag;
            $op->updated_by = $user_id;

            $op->save();

            if ($op->venues) {
                $op->venues()->detach();
            }
            if ($request->venue_id) {
                foreach ($request->venue_id as $key => $data) {
                    $op->venues()->attach($request->venue_id[$key]);
                }
            }
        }

        $notification = array(
            'message'       => 'Event updated successfully',
            'alert-type'    => 'success'
        );

        return response()->json(['error' => $error, 'message' => $message]);
    }

    public function delete($id)
    {
        $op = Event::findOrFail($id);
        $op->delete();

        $error = false;
        $message = 'Event deleted succesfully.';

        $notification = array(
            'message'       => 'Event deleted successfully',
            'alert-type'    => 'success'
        );

        return response()->json(['error' => $error, 'message' => $message]);
        // return redirect()->route('tracki.setup.workspace')->with($notification);
    } // delete

    public function getPrivateFile($file)
    {
        $file_path = 'app/private/bbs/event/logo/' . $file;
        $path = storage_path($file_path);

        Log::info('path: ' . $path);

        return response()->file($path);
    }

    public function getEventView($id)
    {
        $event = Event::find($id);
        $global_yn = GlobalYN::all();
        $global_status = GlobalStatus::all();

        $file_path = 'app/private/bbs/event/logo/';

        $file_path = $file_path . $event->event_logo;
        $path = storage_path($file_path);

        // $url = Storage::disk('private')->temporaryUrl($path, now()->addMinutes(10));

        // $file_path = 'mds/event/logo/' . $event->event_logo;

        if (Storage::disk('private')->exists($file_path)) {
            $event_logo = Storage::url($file_path);
        } else {
            $event_logo = Storage::url('/app/private/bbs/event/logo/noimage.jpg');
        }

        // Log::info($url);
        Log::info('path: ' . $event_logo);
        Log::info('path: ' . $path);

        // return response()->file($path);
        // Log::info(response()->file('/app/private/bbs/event/logo/'.$event->event_logo));

        $view = view('/bbs/setting/event/mv/edit', [
            'event' => $event,
            'globalYn' => $global_yn,
            'globalStatus' => $global_status,
            'event_logo' => $path,
        ])->render();

        return response()->json(['view' => $view]);
    }  // End function getProjectView

}
