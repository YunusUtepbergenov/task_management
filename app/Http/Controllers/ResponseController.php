<?php

namespace App\Http\Controllers;

use App\Events\TaskSubmittedEvent;
use App\Models\Task;
use App\Models\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ResponseController extends Controller
{
    public function store(Request $request){

        $request->validate([
            'description' => 'required',
            'filename' => 'nullable|file|max:40000'
        ]);

        $response = new Response;

        $response->task_id = $request->task_id;
        $response->user_id = Auth::user()->id;
        $response->description = $request->description;
        if($request->file('filename')){
            $uploadedFile = $request->file('filename');
            $filename = time().$uploadedFile->getClientOriginalName();

            Storage::disk('local')->putFileAs(
                'files/responses/',
                $uploadedFile,
                $filename
            );

            $response->filename = $filename;
        }

        $task = Task::where('id', $request->task_id)->first();

        $task->status = "Completed";
        $task->save();

        $response->save();

        event(new TaskSubmittedEvent($task));

        return redirect()->back();
    }

    public function downlaod($id, $responsefile){
        $response = Response::where('id', $id)->first();
        return response()->download(storage_path('app/files/responses/'.$responsefile));
    }

    public function delete($id){
        $response = Response::where('id', $id)->first();
        $task = $response->task;
        $task->status = "Inprogress";
        $task->save();

        if($response->filename)
            Storage::delete('files/responses/'.$response->filename);

        $response->delete();

        return redirect()->back();
    }

    public function editor($id){
        $response = Response::findOrFail($id);

        return view('user.tasks.edit', ['response' => $response]);
    }

    public function update($id, Request $request){
        $request->validate([
            'description' => 'required',
            'filename' => 'nullable|file|max:40000'
        ]);

        $response = Response::find($id);

        $response->user_id = Auth::user()->id;
        $response->description = $request->description;
        if($request->file('filename')){
            Storage::delete('files/responses/'.$response->filename);
            $uploadedFile = $request->file('filename');
            $filename = time().$uploadedFile->getClientOriginalName();

            Storage::disk('local')->putFileAs(
                'files/responses/',
                $uploadedFile,
                $filename
            );

            $response->filename = $filename;
        }

        $response->save();
        return redirect()->route('user.task', $response->task->id);
    }
}
