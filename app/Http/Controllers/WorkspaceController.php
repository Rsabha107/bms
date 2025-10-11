<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Employee;
use App\Models\Person;
use App\Models\User;
use App\Models\Workspace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

// use Illuminate\Support\Facades\Redirect;

class WorkspaceController extends Controller
{
    //
    public function index()
    {
        $workspaces = Workspace::all();
        $employees = Employee::all();
        $clients = Client::all();
        return view('tracki.setup.workspace.list', compact('workspaces', 'employees', 'clients'));
    }

    public function get($id)
    {
        $workspace = Workspace::findOrFail($id);
        // $imploded = (implode($workspace->persons));
        // $asg = Workspace::with('persons')->firstOrFail();
        // dd($asg);
        return response()->json(['workspace' => $workspace, 'asg' => $workspace->employees, 'client' => $workspace->clients]);
    }

    public function update(Request $request)
    {
        $formFields = $request->validate([
            'id' => ['required'],
            'title' => ['required'],
        ]);

        $workspace = Workspace::findOrFail($request->id);

        // dd($workspace);

        if ($workspace->update($formFields)) {
            $workspace->employees()->detach();
            $workspace->clients()->detach();

            foreach ($request->assigned_to_id as $key => $data) {
                $workspace->employees()->attach($request->assigned_to_id[$key]);
            }

            foreach ($request->client_id as $key => $data) {
                $workspace->clients()->attach($request->client_id[$key]);
            }

            return response()->json(['error' => false, 'message' => 'Workspace updated successfully.', 'id' => $workspace->id]);
        } else {
            return response()->json(['error' => true, 'message' => 'Workspace couldn\'t updated.']);
        }
    }

    public function list()
    {
        $search = request('search');
        $sort = (request('sort')) ? request('sort') : "id";
        $order = (request('order')) ? request('order') : "DESC";
        $workspace = Workspace::orderBy($sort, $order);

        if ($search) {
            $workspace = $workspace->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('id', 'like', '%' . $search . '%');
            });
        }
        $total = $workspace->count();
        $workspace = $workspace
            ->paginate(request("limit"))
            ->through(
                fn ($workspace) => [
                    'id' => $workspace->id,
                    'title' => '<div class="align-middle white-space-wrap fw-bold fs-8">' . $workspace->title . '</div>',
                    'assigned_to' => $workspace->employees,
                    'client_id' => $workspace->clients,
                    'created_at' => format_date($workspace->created_at,  'H:i:s'),
                    'updated_at' => format_date($workspace->updated_at, 'H:i:s'),
                ]
            );

        foreach ($workspace->items() as $task => $collection) {
            foreach ($collection['assigned_to'] as $i => $emp) {
                $words = explode(" ", $emp->full_name);
                $acronym = "";

                foreach ($words as $w) {
                    $acronym .= mb_substr($w, 0, 1);
                }
                $collection['assigned_to'][$i] = '<a href="/users/profile/' . $emp->id . '" target="_blank" role="button" title="' . $emp->full_name . '">
                        <div class="avatar avatar-s me-2 pull-up">
                          <div class="avatar-name rounded-circle me-2"><span>' . $acronym . '</span></div>
                        </div>
                      </a>';
            };
        }

        foreach ($workspace->items() as $task => $collection) {
            foreach ($collection['client_id'] as $i => $client) {
                $words = explode(" ", $client->first_name.' '.$client->last_name);
                $acronym = "";

                foreach ($words as $w) {
                    $acronym .= mb_substr($w, 0, 1);
                }
                $collection['client_id'][$i] = '<a href="/clients/profile/' . $client->id . '" target="_blank" role="button" title="' . $client->first_name .' '.$client->last_name. '">
                        <div class="avatar avatar-s me-2 pull-up">
                          <div class="avatar-name rounded-circle me-2"><span>' . $acronym . '</span></div>
                        </div>
                      </a>';
            };
        }

        return response()->json([
            "rows" => $workspace->items(),
            "total" => $total,
        ]);
    }

    public function store(Request $request)
    {
        //
        // dd($request);
        $user_id = Auth::user()->id;
        $ws = new Workspace();

        $rules = [
            'title' => 'required',
            'assigned_to_id' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            Log::info($validator->errors());
            $error = true;
            $message = 'Workspace couldn\'t be created';
        } else {

            $error = false;
            $message = 'Workspace created succesfully.' . $ws->id;

            $ws->title = $request->title;
            $ws->creator_id = $user_id;

            $ws->save();

            foreach ($request->assigned_to_id as $key => $data) {
                $ws->users()->attach($request->assigned_to_id[$key]);
            }
        }

        $notification = array(
            'message'       => 'Workspace created successfully',
            'alert-type'    => 'success'
        );

        return response()->json(['error' => $error, 'message' => $message]);

        // return redirect()->route('tracki.workspace.manage')->with($notification);
        // return Redirect::route('tracki.workspace.manage')->with($notification);
    }

    public function delete($id)
    {
        $ws = Workspace::findOrFail($id);

        $ws->users()->detach();
        $ws->delete();

        $notification = array(
            'message'       => 'Workspace deleted successfully',
            'alert-type'    => 'success'
        );

        return redirect()->route('tracki.setup.workspace')->with($notification);
    } // delete

    public function switch($id)
    {
        if ($id) {
            if (Workspace::findOrFail($id)) {
                session()->put('workspace_id', $id);
                // return redirect()->route('tracki.project.show.card')->with('message', 'Workspace switched successfully.');
                return back()->with('message', 'Workspace switched successfully.');

            } else {
                // return back()->with('error', 'Workspace not found.');
                // return redirect()->route('tracki.project.show.card')->with('error', 'Workspace not found.');
                return back()->with('error', 'Workspace not found.');
            }
        } else {
            session()->forget('workspace_id');
                // return redirect()->route('tracki.project.show.card')->with('message', 'Workspace switched successfully. now showing all workspace data');
                return back()->withInput();
        }
    }
}
