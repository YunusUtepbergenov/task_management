@extends('layouts.main')

@section('main')
<!-- Page Header -->
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Task Information</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                <li class="breadcrumb-item active">Task Information</li>
            </ul>
        </div>
        <div class="col-auto float-right ml-auto">
            <a href="{{ route('tasks.taskboard') }}" class="btn btn-white float-right m-r-10" data-toggle="tooltip" title="Task Board"><i class="fa fa-bars"></i></a>
        </div>
    </div>
</div>
<!-- /Page Header -->

<div class="row">
    <div class="col-lg-8 col-xl-9">
        <div class="card">
            <div class="card-body">
                <div class="project-title">
                    <h5 class="card-title">{{ $task->name }}</h5>
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
                                <ul class="files-action">
                                    <li class="dropdown dropdown-action">
                                        <a href="" class="dropdown-toggle btn btn-link" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_horiz</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="javascript:void(0)">Download</a>
                                            <a class="dropdown-item" href="javascript:void(0)">Delete</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        @endif
        @if($task->status == "Completed")
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
                            @if ($task->response->filename)
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
    <div class="col-lg-4 col-xl-3">
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
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card project-user">
            <div class="card-body">
                <h6 class="card-title m-b-20">Assigned Leader</h6>
                <ul class="list-box">
                    <li>
                        <a href="profile.html">
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
