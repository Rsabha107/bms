<?php

namespace App\Http\Controllers\Mds\Setting;

use App\Http\Controllers\Controller;
use App\Models\Mds\DriverStatus;
use App\Models\Mds\DeliveryVehicle;
use App\Models\Mds\DeliveryVehicleType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

// use Illuminate\Support\Facades\Redirect;

class DeliveryVehicleController extends Controller
{
    //
    public function index()
    {
        $vehicles = DeliveryVehicle::all();
        $vehicle_statuses = DriverStatus::all();
        $vehicle_types = DeliveryVehicleType::all();

        return view('mds.setting.vehicle.list', compact('vehicles','vehicle_statuses','vehicle_types'));
    }

    public function get($id)
    {
        $venue = DeliveryVehicle::findOrFail($id);
        return response()->json(['venue' => $venue]);
    }

    public function update(Request $request)
    {
        $formFields = $request->validate([
            'id' => ['required'],
            'vehicle_type_id' => ['required'],
            'make' => ['required'],
            'license_plate' => ['required'],
            'status_id' => ['required'],
        ]);

        $venue = DeliveryVehicle::findOrFail($request->id);

        // dd($venue);

        if ($venue->update($formFields)) {
            return response()->json(['error' => false, 'message' => 'Vehicle updated successfully.', 'id' => $venue->id]);
        } else {
            return response()->json(['error' => true, 'message' => 'Vehicle couldn\'t updated.']);
        }
    }

    public function editStatus($id)
    {
        //  dd('editTaskProgress');
        $data = DeliveryVehicle::find($id);
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

        $driver = DeliveryVehicle::findOrFail($request->id);
        $status_title = DriverStatus::findOrFail($request->status_id);

        Log::info($status_title->title);
            $driver->update([
                'status_id' => $request->status_id,
            ]);

        $notification = array(
            'message'       => 'Vehicle status updated successfully',
            'alert-type'    => 'success'
        );

        return response()->json(['error' => false, 'message' => 'Vehicle Status updated successfully.', 'id' => $driver->id]);

        // Toastr::success('Has been add successfully :)','Success');
        // return redirect()->back()->with($notification);
        // deleteEvent
    } //updateStatus


    public function list()
    {
        $search = request('search');
        $sort = (request('sort')) ? request('sort') : "id";
        $order = (request('order')) ? request('order') : "DESC";
        $ops = DeliveryVehicle::orderBy($sort, $order);

        if ($search) {
            $venue = $ops->where(function ($query) use ($search) {
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
        auth()->user()->hasRole('SuperAdmin') ? $status = '<span class="badge badge-phoenix fs--2 ms-3 badge-phoenix-' . $op->status->color . ' " style="cursor: pointer;" id="editVehicleStatus" data-id="' . $op->id . '" data-table="vehicles_table"><span class="badge-label">' . $op->status->title . '</span><span class="ms-1 uil-edit-alt" style="height:12.8px;width:12.8px;cursor: pointer;"></span></span>' : 
        $status = '<span class="badge badge-phoenix fs--2 ms-3 badge-phoenix-' . $op->status->color . ' "><span class="badge-label">' . $op->status->title . '</span></span>';


            return  [
                'id' => $op->id,
                'vehicle_type_id' => '<div class="align-middle white-space-wrap fs-9 ps-3">' . $op->vehicle_type->title . '</div>',
                'make' => '<div class="align-middle white-space-wrap fs-9 ps-3">' . $op->make . '</div>',
                'license_plate' => '<div class="align-middle white-space-wrap fs-9 ps-3">' . $op->license_plate . '</div>',
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
        $venue = new DeliveryVehicle();

        $rules = [
            'vehicle_type_id' => ['required'],
            'make' => ['required'],
            'license_plate' => ['required'],
            'status_id' => ['required'],
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            Log::info($validator->errors());
            $error = true;
            $message = implode($validator->errors()->all('<div>:message</div>'));  // use this for json/jquery
        } else {

            $error = false;
            $message = 'Vehicle created succesfully.' . $venue->id;

            $venue->vehicle_type_id = $request->vehicle_type_id;
            $venue->make = $request->make;
            $venue->license_plate = $request->license_plate;
            $venue->status_id = $request->status_id;
            $venue->created_by = $user_id;
            $venue->updated_by = $user_id;
            $venue->active_flag = 1;

            $venue->save();


        }

        $notification = array(
            'message'       => 'Vehicle created successfully',
            'alert-type'    => 'success'
        );

        return response()->json(['error' => $error, 'message' => $message]);

    }

    public function delete($id)
    {
        $ws = DeliveryVehicle::findOrFail($id);
        $ws->delete();

        $error = false;
        $message = 'Vehicle deleted succesfully.';

        $notification = array(
            'message'       => 'Vehicle deleted successfully',
            'alert-type'    => 'success'
        );

        return response()->json(['error' => $error, 'message' => $message]);
        // return redirect()->route('tracki.setup.workspace')->with($notification);
    } // delete

}
