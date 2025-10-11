<?php

namespace App\Http\Controllers;

use App\Models\AddressType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class AddressTypeController extends Controller
{
    //
    public function index()
    {
        return view('tracki.setup.address_type.list');
    }

    public function get($id)
    {
        $address_type = AddressType::findOrFail($id);
        return response()->json(['address_type' => $address_type]);
    }

    public function update(Request $request)
    {
        $formFields = $request->validate([
            'id' => ['required'],
            'name' => ['required'],
            'active_flag' => ['required']
        ]);

        $address_type = AddressType::findOrFail($request->id);

        // dd($address_type);

        if ($address_type->update($formFields)) {
            return response()->json(['error' => false, 'message' => 'Address Type updated.']);
        } else {
            return response()->json(['error' => true, 'message' => 'Address Type could not be updated.']);
        }
    }

    public function store(Request $request)
    {
        // dd('mainEvent');
        $user_id = Auth::user()->id;
        $op = new AddressType();

        $rules = [
            'name' => 'required',
            'active_flag' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        // dd($validator);

        if ($validator->fails()) {
            // Log::info($validator->errors());
            $error = true;
            $message = 'Address Type could not be created';
        } else {

            $error = false;
            $message = 'Address Type created.';

            $op->name = $request->name;
            $op->active_flag = "1";
            $op->creator_id = $user_id;
            $op->save();
        }

        return response()->json(['error' => $error, 'message' => $message]);
    } // store


    public function list()
    {
        $search = request('search');
        $sort = (request('sort')) ? request('sort') : "id";
        $order = (request('order')) ? request('order') : "DESC";
        $address_type = AddressType::orderBy($sort, $order);

        if ($search) {
            $address_type = $address_type->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
        }
        $total = $address_type->count();

        $address_type = $address_type->paginate(request("limit"))->through(function ($address_type) {

            $badge_color = 'success';
            $active_flag = 'Active';

            if ($address_type->active_flag === 1) {
                $badge_color = 'success';
                $active_flag = 'Active';
            } else {
                $badge_color = 'warning';
                $active_flag = 'InActive';
            }
            return [
                'id' => $address_type->id,
                'id1' => '<div class="ms-3">' . $address_type->id . '</div>',
                'name' => '<div class="align-middle white-space-wrap fw-bold fs-8 ms-3">' . $address_type->name . '</div>',
                'active_flag' => '<span class="badge badge-phoenix badge-phoenix-' . $badge_color . '">' . $active_flag . '</span>',
                'created_at' => format_date($address_type->created_at,  'H:i:s'),
                'updated_at' => format_date($address_type->updated_at, 'H:i:s'),
            ];
        });

        return response()->json([
            "rows" => $address_type->items(),
            "total" => $total,
        ]);
    }

    public function delete($id)
    {
        AddressType::where('id', '=', $id)->delete();

        $notification = array(
            'message'       => 'File deleted successfully',
            'alert-type'    => 'success'
        );

        // dd($taskId);

        return response()->json([
            'error' => false,
            'message' => 'Status deleted successfully',
        ]);

        // Toastr::success('Has been add successfully :)','Success');
        // return Redirect::route('tracki.task.list', $task->event_id)->with($notification);
        // return redirect()->back()->with($notification);
    } // taskFileDelete
}
