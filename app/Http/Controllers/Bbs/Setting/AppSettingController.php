<?php

namespace App\Http\Controllers\Bbs\Setting;

use App\Http\Controllers\Controller;
use App\Models\GeneralSettings\Setting;
use App\Models\Mds\DeliveryRsp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AppSettingController extends Controller
{
    //
    public function index()
    {
        $settings = Setting::all();
        return view('bbs.setting.application.list', compact('settings'));
    }

    public function get($id)
    {
        $op = DeliveryRsp::findOrFail($id);
        return response()->json(['op' => $op]);
    }

    public function update(Request $request)
    {
        $rules = [
            'title' => 'required',
            'active_flag' => 'required',
        ];

        $user_id = Auth::user()->id;
        $op = DeliveryRsp::findOrFail($request->id);

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            // Log::info($validator->errors());
            $error = true;
            // $message = 'Employee not create.' . $op->id;
            $message = implode($validator->errors()->all('<div>:message</div>'));
        } else {
            $error = false;
            $message = 'RSP ' . $op->name . ' successfully updated';
            $op->title = $request->title;
            $op->active_flag = $request->active_flag;
            $op->updated_by = $user_id;

            $op->save();
        }

        return response()->json([
            'error' => $error,
            'message' => $message,
        ]);
    }

    public function list()
    {
        $search = request('search');
        $sort = (request('sort')) ? request('sort') : "id";
        $order = (request('order')) ? request('order') : "DESC";
        $ops = Setting::orderBy($sort, $order);

        if ($search) {
            $ops = $ops->where(function ($query) use ($search) {
                $query->where('key', 'like', '%' . $search . '%')
                    ->orWhere('value', 'like', '%' . $search . '%');
            });
        }
        $total = $ops->count();
        $ops = $ops->paginate(request("limit"))->through(function ($op) {


            $div_action = '<div class="font-sans-serif btn-reveal-trigger position-static">';
            $update_action =
                '<a href="javascript:void(0)" class="btn btn-sm" id="editRsp" data-id=' . $op->id .
                ' data-table="application_table" data-bs-toggle="tooltip" data-bs-placement="right" title="Update">' .
                '<i class="fa-solid fa-pen-to-square text-primary"></i></a>';
            $delete_action =
                '<a href="javascript:void(0)" class="btn btn-sm" data-table="application_table" data-id="' .
                $op->id .
                '" id="deleteRsp" data-bs-toggle="tooltip" data-bs-placement="right" title="Delete">' .
                '<i class="fa-solid fa-trash text-danger"></i></a></div></div>';


            $actions = $div_action . $update_action . $delete_action;


            return  [
                'id' => $op->id,
                // 'id' => '<div class="align-middle white-space-wrap fw-bold fs-10 ps-2">' .$op->id. '</div>',
                'key' => '<div class="align-middle white-space-wrap fs-9 ps-3">' . $op->key . '</div>',
                'value' => '<div class="align-middle white-space-wrap fs-9 ps-3">' . $op->value . '</div>',
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

    public function store(Request $request)
    {
        //
        // dd($request);
        $user_id = Auth::user()->id;
        $op = new DeliveryRsp();

        $rules = [
            'title' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            Log::info($validator->errors());
            $error = true;
            $message = implode($validator->errors()->all('<div>:message</div>'));
        } else {

            $error = false;
            $message = 'RSP created succesfully.' . $op->id;

            $op->title = $request->title;
            $op->active_flag = 1;
            $op->created_at = $user_id;
            $op->updated_at = $user_id;
            $op->created_by = $user_id;
            $op->updated_by = $user_id;
            $op->active_flag = 1;

            $op->save();
        }

        $notification = array(
            'message'       => 'RSP created successfully',
            'alert-type'    => 'success'
        );

        return response()->json(['error' => $error, 'message' => $message]);
    }

    public function delete($id)
    {
        $op = DeliveryRsp::findOrFail($id);
        $op->delete();

        $error = false;
        $message = 'RSP deleted succesfully.';

        $notification = array(
            'message'       => 'RSP deleted successfully',
            'alert-type'    => 'success'
        );

        return response()->json(['error' => $error, 'message' => $message]);
        // return redirect()->route('tracki.setup.workspace')->with($notification);
    } // delete

}
