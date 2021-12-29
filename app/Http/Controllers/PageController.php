<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Sector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    public function home(){

        $tasks = Task::where('user_id', Auth::user()->id)->get();
        if(Auth::user()->id == 1){
            $tasks = Task::all();
            $users = User::all();
            $latest_tasks = Task::where('creator_id', Auth::user()->id)->paginate(4);
            return view('admin.index', [
                'tasks' => $tasks,
                'users_count' => $users->count(),
                'latest_tasks' => $latest_tasks
            ]);
        }
        else
            return view('user.index', ['tasks' => $tasks]);
    }

    public function employees(){
        $employees = User::where('id', '!=', 1)->get();

        return view('admin.employee.all', [
            'employees' => $employees,
        ]);
    }

    public function taskboard(){
        $tasks = Task::where('creator_id', 1)->where('status', 'Completed')->paginate(20);
        return view('admin.tasks.taskboard', ['tasks' => $tasks]);
    }

    public function departments(){
        $sectors = Sector::all();

        return view('admin.employee.departments', [
            'sectors' => $sectors
        ]);
    }

    public function userActivities(){
        return view('user.activities');
    }

    public function read($id, Request $request){
        Auth::user()->unreadNotifications->where('id', $id)->markAsRead();
        return redirect()->back();
    }

    public function getTaskInfo($id){
        $task = Task::find($id);
        return response()->json($task);
    }
}
