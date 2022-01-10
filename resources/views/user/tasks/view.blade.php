@extends('layouts.user')

@section('main')
<!-- Page Header -->
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Task Information</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                <li class="breadcrumb-item active">Task information</li>
            </ul>
        </div>
    </div>
</div>
<!-- /Page Header -->

<div class="row">
    <div class="col-lg-7 col-xl-8">
        <div class="card">
            <div class="card-body">
                <div class="project-title">
                    <h3 class="card-title">{{ $task->name }}</h3>
                </div>
                <p>{{ $task->description }}</p>
            </div>
        </div>
        @if($task->file)
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title m-b-20">Uploaded file</h5>
                    <ul class="files-list">
                        <li>
                            <div class="files-cont">
                                <div class="file-type">
                                    <span class="files-icon"><i class="fa fa-file-pdf-o"></i></span>
                                </div>
                                <div class="files-info">
                                    <span class="file-name text-ellipsis"><a href="{{ route('download.taskfile', [$task->id, $task->file])}}">{{ $task->file }}</a></span>
                                    <div class="file-size">{{ round(Storage::size('/files/'.$task->file) / 1024, 1)  }} KB</div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        @endif
        @if ($task->status !== "Completed" && $task->user_id == Auth::user()->id)
        @can('overdue', $task)
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Complete Task</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('response.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Text</label>
                            <div class="col-lg-10">
                                @error('description')
                                    <div class="alert alert-danger" style="margin-bottom: 10px">{{ $message }}</div>
                                @enderror
                                <textarea rows="5" cols="5" class="form-control" name="description" placeholder="Enter text here"></textarea>
                            </div>

                        </div>
                        <input type="hidden" name="task_id" value="{{ $task->id }}">
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label">File</label>
                            <div class="col-lg-10">
                                @error('filename')
                                    <div class="alert alert-danger" style="margin-bottom: 10px">{{ $message }}</div>
                                @enderror
                                <input class="form-control" name="filename" type="file">
                            </div>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        @endcan
        @elseif($task->status == "Completed")
        <div class="card">
            <div class="card-body">
                <h5 class="card-title m-b-20">Submitted Task</h5>
                <p>{{ $task->response->description }}</p>
                <ul class="files-list">
                    <li>
                        <div class="files-cont">
                            <div class="file-type">
                                <span class="files-icon"><i class="fa fa-file-pdf-o"></i></span>
                            </div>
                            @if($task->response->filename)
                            <div class="files-info">
                                <span class="file-name text-ellipsis"><a href="{{ route('download.responsefile', [$task->response->id, $task->response->filename])}}">{{ $task->response->filename }}</a></span>
                                <div class="file-size">{{ round(Storage::size('/files/responses/'.$task->response->filename) / 1024, 1)  }} KB</div>
                            </div>
                            @endif
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        @endif
        </div>

    <div class="col-lg-5 col-xl-4">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title m-b-15">Task details</h6>
                <table class="table table-striped table-border">
                    <tbody>
                        <tr>
                            <td>Created:</td>
                            <td class="text-right">{{ $task->created_at->format('Y-m-d') }}</td>
                        </tr>
                        <tr>
                            <td>Deadline:</td>
                            <td class="text-right">{{ $task->deadline }}</td>
                        </tr>
                        <tr>
                            <td>Priority:</td>
                            <td class="text-right">
                                <div class="btn-group">
                                    <a href="#" class="badge badge-danger" style="padding: 6px">{{ $task->priority }} </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Status:</td>
                            <td class="text-right">{{ $task->status }}</td>
                        </tr>
                        @if ($task->status == "Completed")
                            @can('update', $task->response)
                                @can('overdue', $task)
                                    <tr>
                                        <td>Response Actions:</td>
                                        <td class="nowrap">
                                            <div class="row">
                                                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                                    <div class="btn-group mr-2" role="group" aria-label="First group">
                                                        <a href="{{ route('response.edit', $task->response->id) }}" class="btn btn-secondary btn-sm">Edit</a>
                                                    </div>
                                                    <div class="btn-group mr-2" role="group" aria-label="Second group">
                                                        <form action="{{ route('response.delete', $task->response->id) }}" method="post">
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                            <button class="btn btn-primary btn-sm">Delete</button>
                                                        </form>
                                                    </div>
                                                {{-- <div class="col">
                                                    <a href="{{ route('response.edit', $task->response->id) }}" class="btn btn-secondary btn-sm">Edit</a>
                                                </div>
                                                <div class="col">
                                                    <form action="{{ route('response.delete', $task->response->id) }}" method="post">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <button class="btn btn-primary btn-sm">Delete</button>
                                                    </form>                                                            
                                                </div> --}}
                                            </div>
                                        </td>
                                    </tr>
                                @endcan
                            @endcan
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card project-user">
            <div class="card-body">
                <h6 class="card-title m-b-20">Assigned Leader</h6>
                <ul class="list-box">
                    <li>
                        <a href="#">
                            <div class="list-item">
                                <div class="list-left">
                                    <span class="avatar"><img alt="" src="{{ asset('assets/img/profiles/avatar-11.jpg') }}"></span>
                                </div>
                                <div class="list-body">
                                    <span class="message-author">{{ $task->user->name }}</span>
                                    <div class="clearfix"></div>
                                    <span class="message-content">{{ $task->user->role->name }}</span>
                                </div>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
