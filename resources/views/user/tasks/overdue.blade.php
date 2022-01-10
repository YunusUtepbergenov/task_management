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
                <h3 class="page-title">Overdue Tasks</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active">Overdue Tasks</li>
                </ul>
            </div>
            <div class="col-auto float-right ml-auto">
                <a href="#" class="btn add-btn" data-toggle="modal" data-target="#create_project"><i class="fa fa-plus"></i> Create Task</a>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach ($overdue as $task)
            @cannot('overdue', $task)
                <div class="col-lg-4 col-sm-6 col-md-4 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="dropdown dropdown-action profile-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="javascript:void(0)" onclick="editTask({{ $task->id }})" data-toggle="modal" data-target="#extend_deadline"><i class="fa fa-pencil m-r-5"></i> Extend Deadline Request</a>
                                </div>
                            </div>
                            <h4 class="project-title"><a href="{{ route('tasks.show', $task->id) }}">{{ $task->name }}</a></h4>
                            <a href="{{ route('tasks.show', $task->id) }}"><p class="text-muted">{{substr($task->description, 0, 40)}} ...
                            </p></a>
                            <div class="pro-deadline m-b-15">
                                <div class="sub-title">
                                    Deadline:
                                </div>
                                <div class="text-muted">
                                    {{ $task->deadline }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan
        @endforeach
    </div>

    <!-- Edit Project Modal -->
    <div id="extend_deadline" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Extend Deadline Request</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('extend.deadline') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Deadline</label>
                                    <div class="cal-icon">
                                        <input type="hidden" name="id" id="id1">
                                        <input name="deadline" id="deadline1" class="form-control datetimepicker" type="text" autocomplete="off">
                                    </div>
                                </div>
                                <div class="alert alert-danger d-none" id="deadline2"></div>
                            </div>
                        </div>
                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn">Send Extend Deadline Request</button>
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
    <script>
        $(document).ready(function(){
        $("#name").addClass("d-none");
        $("#deadline").addClass("d-none");
        $("#priority").addClass("d-none");
        $("#user_id").addClass("d-none");
        $("#description").addClass("d-none");
        $("#file").addClass("d-none");
    });
    </script>
@endsection
