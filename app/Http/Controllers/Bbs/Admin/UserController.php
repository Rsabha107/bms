<?php

namespace App\Http\Controllers\Bbs\Admin;

use App\Http\Controllers\Controller;
use App\DataTables\UsersDataTable;
use App\Models\Department;
use App\Models\Event;
use App\Models\Status;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\UtilController;
use App\Mail\AccessGrantedMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    //

    public function profile()
    {
        $user = User::find(Auth::user()->id);
        $file = $user->file_attach;

        return view('mds/admin/users/profile', compact('user', 'file'));
    }
    
    public function update(Request $request)
    {

        $id = Auth::user()->id;
        $user = User::find($id);

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;

        Log::info($request->all());
        if ($request->hasFile('file_name')) {

            $file = $request->file('file_name');
            $fileNameWithExt = $request->file('file_name')->getClientOriginalName();
            // get file name
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // get extension
            $extension = $request->file('file_name')->getClientOriginalExtension();

            $fileNameToStore = $filename . '_' . time() . '.' . $extension;

            Log::info($fileNameWithExt);
            Log::info($filename);
            Log::info($extension);
            Log::info($fileNameToStore);

            // upload
            if ($user->photo != 'default.png') {
                Storage::delete('public/upload/profile_images/' . $user->photo);
            }

            $path = $request->file('file_name')->storeAs('public/upload/profile_images', $fileNameToStore);
            // $path = $file->move('upload/profile_images/', $fileNameToStore);
            Log::info($path);


        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        $user->photo = $fileNameToStore;

        $user->save();

        $notification = array(
            'message' => 'Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function updatePassword(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);

        $rules = [
            'password' => 'required|confirmed|min:8|max:16',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $notification = array(
                'message' => $validator->errors()->first(),
                'alert-type' => 'error'
            );

            return redirect()->back()
                ->withInput()
                ->with($notification);
        }

        if(!Hash::check($request->current_password, $user->password)){
            $notification = array(
                'message' => 'Old Password is incorrect',
                'alert-type' => 'error'
            );

            // Toastr::error('Old Password is incorrect','Error');
            return redirect()->back()->with($notification);
        }

        // $user->password = Hash::make($request->password);
        // $user->save();

        // $notification = array(
        //     'message' => 'Password Updated Successfully',
        //     'alert-type' => 'success'
        // );

        // return redirect()->back()->with($notification);
    }

        public function msStore(Request $request)
    {

        appLog('UserController@msStore - Request: ' . json_encode($request->all()));
        DB::beginTransaction();
        try {
            $rules = [
                'name' => 'required|max:255',
                'email' => 'required|email|unique:users,email',
                'phone' => 'required|max:15',
                'event_id' => 'required',
                'roles' => 'required|array|min:1',
            ];

            $message = '
            [
                "name.required" => "Name is required",
                "email.required" => "Email is required",
                "email.email" => "Provide a valid email",
                "email.unique" => "Email already exists",
                "phone.required" => "Phone is required",
                "client_id.required" => "Client selection is required",
            ]';

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors($validator);
            }

            // @unlink(public_path('upload/instructor_images/' . $data->photo));
            // $id = Auth::user()->id;
            $user = new User();

            $generated_password = generateSecurePassword();
            $hashed_password = Hash::make($generated_password);
            $user->password = $hashed_password;
            $user->employee_id = 0;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            // $user->password = Hash::make($request->password);
            $user->status = 1;
            $user->usertype = 'user';
            $user->is_admin = 0;
            $user->role = 'user';
            // $user->address = 'doha';
            $user->save();

            $roles = $request->roles;

            $intRoles = collect($roles)->map(function ($role) {
                return (int)$role;
            });
            if ($request->roles) {
                $user->assignRole($intRoles);
            }

            if ($request->event_id) {
                foreach ($request->event_id as $key => $data) {
                    appLog('Event ID: ' . $data);
                    $user->events()->attach($request->event_id[$key]);
                }
            }

            appLog('Assigning roles: ' . json_encode($intRoles));

            $notification = array(
                'message'       => 'User created successfully',
                'alert-type'    => 'success'
            );

            if (config('settings.send_notifications')) {
                $eventNames = $user->events()->exists()
                    ? $user->events->pluck('name')->implode(', ')
                    : 'N/A';
                $details = [
                    'name' => $user->name,
                    'email' => $user->email,
                    'event' => $eventNames,
                    'role' => 'Customer'
                ];
                // Send email notification
                Mail::to($user->email)->send(new AccessGrantedMail($details));
            }

            DB::commit();
            return Redirect::route('login')->with($notification);
        } catch (\Exception $e) {
            appLog('Validation error in UserController@store: ' . $e->getMessage());
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }

        // Toastr::success('Has been add successfully :)','Success');
        // return redirect()->back()->with($notification);
        //mainProfileStore

    }

}
