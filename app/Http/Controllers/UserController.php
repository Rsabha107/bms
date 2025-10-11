<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Models\Department;
use App\Models\Event;
use App\Models\GeneralSettings\GlobalAttachment;
use App\Models\Status;
use App\Models\Tag;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Finder\Glob;

class UserController extends Controller
{
    //
    protected $UtilController;

    public function __construct(UtilController $UtilController)
    {
        $this->UtilController = $UtilController;
    }

    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('users.index');
    }

    public function profile()
    {
        $user = User::find(Auth::user()->id);
        $file = $user->file_attach;
    
        return view('mds/users/profile', compact('user', 'file'));
    }


    public function details($id){

        $workspace_id = session()->get('workspace_id');

        $user = User::findOrFail($id);
        $tasks = $user->tasks()->when($workspace_id, function ($query, $workspace) {
            return $query->where('tasks.workspace_id', $workspace);
        });
        $users = User::all();
        // $tasks = Task::find(23);
        $projects = Event::all();
        $statuses = Status::all();
        $departments = Department::all();
        $todos = $user->todos;
        // $tags = Tag::all();
        $project_count = Event::with('users')->get();

        // dd($projects);
        // Log::info('projects: '.$users->tasks);

        $projectCount = Task::withCount('users')->when($workspace_id, function ($query, $workspace) {
            return $query->where('tasks.workspace_id', $workspace);
        })->get();


        // $task_count = $users->with('tasks')->projects->count();

        // dd($task_count);

        return view('tracki.users.details', compact('user','projects','statuses','departments', 'tasks', 'projectCount', 'users', 'todos','project_count'));
    }

    public function store(Request $request)
    {

        $rules = [
            'password' => 'required|confirmed|min:8|max:16',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            //return ($request->get('password').' - '.$request->get('password_confirmation'));
            //return ($request->input());
            return redirect()->back()
                ->withInput()
                ->withErrors($validator);
        }

        $activate_value = sha1(time() . config('global.key'));

        // @unlink(public_path('upload/instructor_images/' . $data->photo));
        // $id = Auth::user()->id;
        $data = new User();

        // $data->username = $request->username;
        $data->name = $request->name;
        $data->email = $request->email;
        // $data->address = $request->address;
        $data->phone = $request->phone;
        // $data->department_assignment_id = $request->department_id;
        $data->password = Hash::make($request->password);
        // $data->department_assignment_id = $request->department_id;
        // $data->functional_area_id = $request->functional_area_id;
        $data->status = '0';
        $data->employee_id = 0;
        $data->role = 'user';
        $data->address = 'doha';
        $data->save();

        $this->UtilController->save_files($request, $data->id);

        $notification = array(
            'message'       => 'User created successfully',
            'alert-type'    => 'success'
        );

        // Toastr::success('Has been add successfully :)','Success');
        // return redirect()->back()->with($notification);
        return Redirect::route('mds.auth.signup')->with($notification);
        //mainProfileStore

    }
}
