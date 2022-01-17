@extends('layouts.user')

@section('main')
<!-- Page Header -->
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Task Information</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                <li class="breadcrumb-item active">Project</li>
            </ul>
        </div>
    </div>
</div>
<!-- /Page Header -->

<div class="row">
    <div class="col-lg-8 col-xl-9">
        <div class="card">
            <div class="card-body">
                <div class="project-title">
                    <h3 class="card-title">{{ $response->task->name }}</h3>
                </div>
                <p>{{ $response->task->description }}</p>
            </div>
        </div>
        @if($response->task->file)
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
                                    <span class="file-name text-ellipsis"><a href="{{ route('download.taskfile', [$response->task->id, $response->task->file])}}">{{ $response->task->file }}</a></span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Complete Task</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('response.update', $response->id) }}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label">Text</label>
                        <div class="col-lg-10">
                            @error('description')
                                <div class="alert alert-danger" style="margin-bottom: 10px">{{ $message }}</div>
                            @enderror
                            <textarea rows="5" cols="5" class="form-control" name="description" placeholder="Enter text here">{{ $response->description }}</textarea>
                        </div>

                    </div>
                    <input type="hidden" name="task_id" value="{{ $response->task->id }}">
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label">File</label>
                        <div class="col-lg-10">
                            @error('filename')
                                <div class="alert alert-danger" style="margin-bottom: 10px">{{ $message }}</div>
                            @enderror
                            <input class="form-control" name="filename" type="file" value="{{ $response->filename }}">
                        </div>
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        </div>

    <div class="col-lg-4 col-xl-3">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title m-b-15">Project details</h6>
                <table class="table table-striped table-border">
                    <tbody>
                        <tr>
                            <td>Created:</td>
                            <td class="text-right">{{ $response->task->created_at->format('Y-m-d') }}</td>
                        </tr>
                        <tr>
                            <td>Deadline:</td>
                            <td class="text-right">{{ $response->task->deadline }}</td>
                        </tr>
                        <tr>
                            <td>Priority:</td>
                            <td class="text-right">
                                <div class="btn-group">
                                    <a href="#" class="badge badge-danger" style="padding: 6px">{{ $response->task->priority }} </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Status:</td>
                            <td class="text-right">{{ $response->task->status }}</td>
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
                                    <span class="message-author">{{ $response->task->user->name }}</span>
                                    <div class="clearfix"></div>
                                    <span class="message-content">{{ $response->task->user->role->name }}</span>
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
