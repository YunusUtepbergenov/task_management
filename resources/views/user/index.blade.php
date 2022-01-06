@extends('layouts.user')

@section('main')
    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="page-title">Welcome</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /Page Header -->
    {{-- {{ dd(auth()->user()->unreadNotifications) }} --}}
    <div class="row">
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="card dash-widget">
                <div class="card-body">
                    <span class="dash-widget-icon"><i class="fa fa-cubes"></i></span>
                    <div class="dash-widget-info">
                        <h3>{{ $tasks->count() }}</h3>
                        <span>Total tasks</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="card dash-widget">
                <div class="card-body">
                    <span class="dash-widget-icon"><i class="fa fa-bolt"></i></span>
                    <div class="dash-widget-info">
                        <h3>{{ $tasks->where('status', 'Inprogress')->count() }}</h3>
                        <span>Tasks Inporgress</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="card dash-widget">
                <div class="card-body">
                    <span class="dash-widget-icon"><i class="fa fa-flag"></i></span>
                    <div class="dash-widget-info">
                        <h3>{{ $tasks->where('status', 'Completed')->count() }}</h3>
                        <span>Completed Tasks</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                                @foreach (Auth::user()->tasks()->where('status', 'Inprogress')->get() as $task)
                                <tr>
                                    <td>{{ Auth::user()->name }}</td>
                                    <td>{{ $task->name }}</td>
                                    <td>{{ $task->priority }}</td>
                                    <td>{{ $task->deadline }}</td>
                                    <td>{{ $task->status }}</td>
                                    <td>{{ $task->created_at->format('Y-m-d') }}</td>
                                    <td><a href="{{ route('user.task', $task->id) }}">View</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
