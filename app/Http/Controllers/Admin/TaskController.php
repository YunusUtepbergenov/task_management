<?php

namespace App\Http\Controllers\Admin;

use App\Events\ExtendDeadlineAcceptedEvent;
use App\Events\ExtendDeadlineEvent;
use App\Events\ExtendDeadlineRejectedEvent;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Events\TaskCreatedEvent;
use App\Events\TaskUpdatedEvent;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.tasks.tasks');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:5|max:255',
            'user_id' => 'required',
            'description' => 'required|min:10',
            'deadline' => 'required',
            'file' => 'nullable|file'
        ]);

        $task = new Task;
        $task->creator_id = Auth::user()->id;
        $task->user_id = $request->user_id;
        $task->sector_id = $request->sector_id;
        $task->name = $request->name;
        $task->description = $request->description;
        $date = str_replace('/', '-', $request->deadline);
        $task->deadline = date("Y-m-d", strtotime($date) );
        $task->priority = $request->priority;
        $task->status = "Inprogress";

        if($request->file('file')){
            $uploadedFile = $request->file('file');
            $filename = time().$uploadedFile->getClientOriginalName();

            Storage::disk('local')->putFileAs(
                'files/',
                $uploadedFile,
                $filename
            );

            $task->file = $filename;
        }
        $task->save();

        event(new TaskCreatedEvent($task));

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::where('id', $id)->first();

        return view('admin.tasks.view', [
            'task' => $task
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|min:5|max:255',
            'description' => 'required|min:10',
            'deadline' => 'required',
            'file' => 'nullable|file'
        ]);

        $task = Task::find($request->id);
        $task->name = $request->name;
        $task->description = $request->description;
        $date = str_replace('/', '-', $request->deadline);
        $task->deadline = date("Y-m-d", strtotime($date) );
        $task->priority = $request->priority;

        if($request->file('file')){
            Storage::delete('files/'.$task->filename);
            $uploadedFile = $request->file('file');
            $filename = time().$uploadedFile->getClientOriginalName();

            Storage::disk('local')->putFileAs(
                'files/',
                $uploadedFile,
                $filename
            );

            $task->file = $filename;
        }
        $task->save();

        event(new TaskUpdatedEvent($task));

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::where('id', $id)->first();
        if($task->file){
            Storage::delete('files/'.$task->file);
        }
        $task->delete();

        return redirect()->back();
    }

    public function active(){
        $tasks = Auth::user()->tasks()->where('status', 'Inprogress')->paginate(5);
        return view('user.tasks.active', ['tasks' => $tasks]);
    }

    public function finished(){
        $tasks = Auth::user()->tasks()->where('status', 'Completed')->paginate(10);
        return view('user.tasks.finished', ['tasks' => $tasks]);
    }


    public function userTask($id){
        $task = Task::where('id', $id)->first();
        return view('user.tasks.view', ['task' => $task]);
    }

    public function downlaod($id, $taskfile){
        $task = Task::where('id', $id)->first();
        return response()->download(storage_path('app/files/'.$taskfile));
    }

    public function sectorTasks(){
        $tasks = Auth::user()->sector->tasks()->where('user_id', '<>', Auth::user()->id)->where('status', 'Inprogress')->orderBy('deadline', 'ASC')->paginate(5);
        return view('user.tasks.sector', ['tasks' => $tasks]);
    }

    public function sectorCompleted(){
        $tasks = Auth::user()->sector->tasks()->where('user_id', '<>', Auth::user()->id)->where('status', 'Completed')->paginate(10);
        return view('user.tasks.completed', ['tasks' => $tasks]);
    }

    public function overdue(){
        $tasks = $tasks = Task::where('creator_id', 1)->where('deadline', '<', Carbon::now())->where('status', 'Inprogress')->orderBy('deadline', 'ASC')->paginate(20);
        return view('admin.tasks.overdue', ['tasks' => $tasks]);
    }

    public function overdueUser(){
        $overdue = Auth::user()->tasks()->where('deadline', '<', Carbon::now())->where('status', 'Inprogress')->orderBy('deadline', 'ASC')->paginate(16);
        return view('user.tasks.overdue', ['overdue' => $overdue]);
    }

    public function extendDeadlineRequest(Request $request){
        $task = Task::find($request->id);
        $date = str_replace('/', '-', $request->deadline);
        $request->deadline = date("Y-m-d", strtotime($date) );
        event(new ExtendDeadlineEvent($task, $request->deadline));
        return redirect()->back();
    }

    public function extendDeadline($id, Request $request){
        $task = Task::where('id', $id)->first();
        Auth::user()->unreadNotifications->where('id', $request->notification_id)->markAsRead();

        $task->deadline = $request->deadline;
        $task->save();
        event(new ExtendDeadlineAcceptedEvent($task));
        return redirect()->back();
    }

    public function rejectedDeadlineExtend($id, Request $request){
        $task = Task::where('id', $id)->first();
        Auth::user()->unreadNotifications->where('id', $request->notification_id)->markAsRead();

        event(new ExtendDeadlineRejectedEvent($task));

        return redirect()->back();
    }
}
