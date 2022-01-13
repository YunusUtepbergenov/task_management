@extends('layouts.user')

@section('styles')
	<!-- Select2 CSS -->
	<link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">
    <!-- Datetimepicker CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}">
    <!-- Summernote CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/dist/summernote-bs4.css') }}">    
@endsection

@section('main')
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Sector's Active Tasks</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Sectors' Active Tasks</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /Page Header -->

    <div class="row">
        @foreach ($tasks as $task)
            @can('overdue', $task)
                <div class="col-lg-4 col-sm-6 col-md-4 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="dropdown dropdown-action profile-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="javascript:void(0)" onclick="editTask({{ $task->id }})" data-toggle="modal" data-target="#edit_project"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button class="dropdown-item"><i class="fa fa-trash-o m-r-5"></i>Delete</button>
                                    </form>
                                </div>
                            </div>
                            <h4 class="project-title"><a href="{{ route('user.task', $task->id) }}">{{ $task->name }}</a></h4>
                            <a href="{{ route('user.task', $task->id) }}">
                                <p class="text-muted"> {{ (strlen($task->description) >= 48) ? substr($task->description, 0, 48)."..." : $task->description}}</p>
                            </a>
                            <div class="pro-deadline m-b-15">
                                <div class="sub-title">
                                    Deadline:
                                </div>
                                <div class="text-muted">
                                    {{ $task->deadline }}
                                </div>
                            </div>
                            <div class="project-members m-b-15">
                                <div>Assigned to :</div>
                                <ul class="team-members">
                                    <li>
                                        <a href="#" data-toggle="tooltip" title="Jeffery Lalor"><img alt="" src="{{ asset('assets/img/profiles/avatar-16.jpg') }}"></a>
                                    </li>
                                    <li><p style="padding: 6px 0 0 10px;">{{ $task->user->name }}</p></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan
        @endforeach
    </div>    
    <div style="float: right; margin-right: 30px;">
        {{ $tasks->links('pagination::bootstrap-4') }}
    </div>

    <!-- Edit Project Modal -->
    <div id="edit_project" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('task.update') }}" enctype="multipart/form-data" id="editTask">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" id="generatedToken" name="_token" value="{{ csrf_token() }}">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Task Name</label>
                                    <input type="hidden" name="id" id="id1">
                                    <input class="form-control" id="name1" name="name" type="text">
                                </div>
                                <div class="alert alert-danger d-none" id="name2"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Deadline</label>
                                    <div class="cal-icon">
                                        <input name="deadline" id="deadline1" class="form-control datetimepicker" type="text" autocomplete="off">
                                    </div>
                                </div>
                                <div class="alert alert-danger d-none" id="deadline2"></div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Priority</label>
                                    <select class="select" name="priority" id="priority1">
                                        <option>High</option>
                                        <option>Medium</option>
                                        <option>Low</option>
                                    </select>
                                </div>
                                <div class="alert alert-danger d-none" id="priority2"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea rows="4" class="form-control" name="description" id="description1" placeholder="Enter description here"></textarea>
                        </div>
                        <div class="alert alert-danger d-none" id="description2"></div>

                        <div class="form-group">
                            <label>Upload Files</label>
                            <input class="form-control" name="file" type="file">
                        </div>
                        <div class="alert alert-danger d-none" id="file2"></div>
                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Edit Project Modal -->
@endsection

@section('scripts')
    <!-- Select2 JS -->
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <!-- Datetimepicker JS -->
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
    
    <!-- Summernote JS -->
    <script src="{{ asset('assets/plugins/summernote/dist/summernote-bs4.min.js') }}"></script>    
@endsection