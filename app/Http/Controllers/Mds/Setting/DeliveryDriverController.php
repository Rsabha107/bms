<?php

namespace App\Http\Controllers\Mds\Setting;

use App\Http\Controllers\Controller;
use App\Models\Mds\DriverStatus;
use App\Models\Mds\MdsDriver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

// use Illuminate\Support\Facades\Redirect;

class DeliveryDriverController extends Controller
{
    //
    public function index()
    {
        Log::info('DeliveryDriverController@index');
        $drivers = MdsDriver::all();
        $driver_statuses = DriverStatus::all();
        return view('mds.setting.driver.list', compact('drivers','driver_statuses'));
    }

    public function get($id)
    {
        $venue = MdsDriver::findOrFail($id);
        return response()->json(['venue' => $venue]);
    }

    public function update(Request $request)
    {
        $formFields = $request->validate([
            'id' => ['required'],
            'first_name' => ['required'],
            'last_name' => ['required'],
            'mobile_number' => ['required'],
            'national_identifier_number' => ['required'],
        ]);

        $venue = MdsDriver::findOrFail($request->id);

        // dd($venue);

        if ($venue->update($formFields)) {
            return response()->json(['error' => false, 'message' => 'Driver updated successfully.', 'id' => $venue->id]);
        } else {
            return response()->json(['error' => true, 'message' => 'Driver couldn\'t updated.']);
        }
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
        $ops = MdsDriver::orderBy($sort, $order);

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
        auth()->user()->hasRole('SuperAdmin') ? $status = '<span class="badge badge-phoenix fs--2 ms-3 badge-phoenix-' . $op->status->color . ' " style="cursor: pointer;" id="editDriverStatus" data-id="' . $op->id . '" data-table="drivers_table"><span class="badge-label">' . $op->status->title . '</span><span class="ms-1 uil-edit-alt" style="height:12.8px;width:12.8px;cursor: pointer;"></span></span>' : 
                                             $status = '<span class="badge badge-phoenix fs--2 ms-3 badge-phoenix-' . $op->status->color . ' "><span class="badge-label">' . $op->status->title . '</span></span>';


            return  [
                'id' => $op->id,
                // 'id' => '<div class="align-middle white-space-wrap fw-bold fs-9 ps-2">' .$op->id. '</div>',
                'first_name' => '<div class="align-middle white-space-wrap  fs-9 ps-3">' . $op->first_name . '</div>',
                'last_name' => '<div class="align-middle white-space-wrap  fs-9 ps-3">' . $op->last_name . '</div>',
                'mobile_number' => '<div class="align-middle white-space-wrap  fs-9 ps-3">' . $op->mobile_number . '</div>',
                'national_identifier_number' => '<div class="align-middle white-space-wrap  fs-9 ps-3">' . $op->national_identifier_number . '</div>',
                // 'status' => '<span class="badge badge-phoenix fs--2 ms-3 badge-phoenix-' . $venue->status->color . ' " style="cursor: pointer;" id="editDriverStatus" data-id="' . $venue->id . '" data-table="drivers_table"><span class="badge-label">' . $venue->status->title . '</span><span class="ms-1 uil-edit-alt" style="height:12.8px;width:12.8px;cursor: pointer;"></span></span>',
                'status' => $status,
                'created_at' => format_date($op->created_at,  'H:i:s'),
                'updated_at' => format_date($op->updated_at, 'H:i:s'),
            ];
        });

        return response()->json([
            "rows" => $ops->items(),
            "total" => $total,
        ]);
    }

    public function store(Request $request)
    {
        //
        // dd($request);
        $user_id = Auth::user()->id;
        $venue = new MdsDriver();

        $rules = [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'mobile_number' => ['required'],
            'national_identifier_number' => ['required'],
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            Log::info($validator->errors());
            $error = true;
            $message = implode($validator->errors()->all('<div>:message</div>'));  // use this for json/jquery
        } else {

            $error = false;
            $message = 'Driver created succesfully.' . $venue->id;

            $venue->first_name = $request->first_name;
            $venue->last_name = $request->last_name;
            $venue->mobile_number = $request->mobile_number;
            $venue->national_identifier_number = $request->national_identifier_number;
            $venue->created_by = $user_id;
            $venue->updated_by = $user_id;
            $venue->active_flag = 1;

            $venue->save();


        }

        $notification = array(
            'message'       => 'Driver created successfully',
            'alert-type'    => 'success'
        );

        return response()->json(['error' => $error, 'message' => $message]);

    }

    public function delete($id)
    {
        $ws = MdsDriver::findOrFail($id);
        $ws->delete();

        $error = false;
        $message = 'Driver deleted succesfully.';

        $notification = array(
            'message'       => 'Driver deleted successfully',
            'alert-type'    => 'success'
        );

        return response()->json(['error' => $error, 'message' => $message]);
        // return redirect()->route('tracki.setup.workspace')->with($notification);
    } // delete

}
