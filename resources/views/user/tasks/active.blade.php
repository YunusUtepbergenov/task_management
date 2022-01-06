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
                <h3 class="page-title">Active Tasks</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active">Active Tasks</li>
                </ul>
            </div>
            @if(Auth::user()->id == Auth::user()->sector->head_id)
            <div class="col-auto float-right ml-auto">
                <a href="#" class="btn add-btn" data-toggle="modal" data-target="#create_project"><i class="fa fa-plus"></i> Create Task</a>
            </div>
            @endif
        </div>
    </div>
    <!-- /Page Header -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Assigned Tasks</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Task Name</th>
                                    <th>Priority</th>
                                    <th>Deadline</th>
                                    <th>Status</th>
                                    <th>Start Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $task)
                                    @can('overdue', $task)
                                        <tr>
                                            <td>{{ $task->user->name }}</td>
                                            <td>{{ $task->name }}</td>
                                            <td>{{ $task->priority }}</td>
                                            <td>{{ $task->deadline }}</td>
                                            <td>{{ $task->status }}</td>
                                            <td>{{ $task->created_at->format('Y-m-d') }}</td>
                                            <td><a class="btn btn-primary" href="{{ route('user.task', $task->id) }}">View</a></td>
                                        </tr>
                                    @endcan
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="float: right; margin-right: 30px;">
        {{ $tasks->links('pagination::bootstrap-4') }}
    </div>


    <!-- Create Project Modal -->
    <div id="create_project" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('tasks.store') }}" method="POST" enctype="multipart/form-data" id="createTask">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Task Name</label>
                                    <input class="form-control" name="name" type="text">
                                </div>
                                <div class="alert alert-danger" id="name"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Deadline</label>
                                    <div class="cal-icon">
                                        <input name="deadline" class="form-control datetimepicker" type="text" autocomplete="off">
                                    </div>
                                </div>
                                <div class="alert alert-danger" id="deadline"></div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Priority</label>
                                    <select class="select" name="priority">
                                        <option>High</option>
                                        <option>Medium</option>
                                        <option>Low</option>
                                    </select>
                                </div>
                                <div class="alert alert-danger" id="priority"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Select Task Leader</label>
                                    <input type="hidden" name="sector_id" value="{{ Auth::user()->sector->id }}">
                                    <select class="form-control" name="user_id" id="add_task_employee">
                                        <option value="" disabled selected>Select Task Leader</option>
                                            @foreach (Auth::user()->sector->users as $employee)
                                                @if ($employee->name !== Auth::user()->name)
                                                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                                @endif
                                            @endforeach
                                    </select>
                                </div>
                                <div class="alert alert-danger" id="user_id"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea rows="4" class="form-control" name="description" placeholder="Enter description here"></textarea>
                        </div>
                        <div class="alert alert-danger" id="description"></div>

                        <div class="form-group">
                            <label>Upload Files</label>
                            <input class="form-control" name="file" type="file">
                        </div>
                        <div class="alert alert-danger" id="file"></div>

                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn" id="ajaxSubmit">Submit</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Create Project Modal -->
@endsection

@section('scripts')
    <!-- Select2 JS -->
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <!-- Datetimepicker JS -->
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>

    <!-- Summernote JS -->
    <script src="{{ asset('assets/plugins/summernote/dist/summernote-bs4.min.js') }}"></script>

    <script>
        $(document).ready(function(){
            console.log('jeo');
            $("#name").addClass("d-none");
            $("#deadline").addClass("d-none");
            $("#priority").addClass("d-none");
            $("#user_id").addClass("d-none");
            $("#description").addClass("d-none");
            $("#file").addClass("d-none");
        })
    </script>

@endsection
