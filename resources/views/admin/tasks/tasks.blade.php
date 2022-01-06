@extends('layouts.main')

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
                <h3 class="page-title">Tasks</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active">Tasks</li>
                </ul>
            </div>
            <div class="col-auto float-right ml-auto">
                <a href="#" class="btn add-btn" data-toggle="modal" data-target="#create_project"><i class="fa fa-plus"></i> Create Task</a>
            </div>
        </div>
    </div>
    <!-- /Page Header -->
    {{-- @livewire('filter-task') --}}

    @livewire('task')
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
