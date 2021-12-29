@extends('layouts.main')

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

    <div class="row">
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="card dash-widget">
                <div class="card-body">
                    <span class="dash-widget-icon"><i class="fa fa-cubes"></i></span>
                    <div class="dash-widget-info">
                        <h3>{{ $tasks->count() }}</h3>
                        <span>Tasks</span>
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
                        <span>Inprogress</span>
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
                        <span>Finished Tasks</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="card dash-widget">
                <div class="card-body">
                    <span class="dash-widget-icon"><i class="fa fa-user"></i></span>
                    <div class="dash-widget-info">
                        <h3>{{ $users_count }}</h3>
                        <span>Employees</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Widget -->
    <div class="row">
        
        <div class="col-md-12 col-lg-6 col-xl-4 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <h4 class="card-title">Task Statistics</h4>
                    <div class="statistics">
                        <div class="row">
                            <div class="col-md-6 col-6 text-center">
                                <div class="stats-box mb-4">
                                    <p>Total Tasks</p>
                                    <h3>{{ $tasks->count() }}</h3>
                                </div>
                            </div>
                            <div class="col-md-6 col-6 text-center">
                                <div class="stats-box mb-4">
                                    <p>Overdue Tasks</p>
                                    <h3>{{ $tasks->where('status', 'Overdue')->count() }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($tasks->count() > 0)
                    <div class="progress mb-4">
                        <div class="progress-bar bg-purple" role="progressbar" style="width: {{ $tasks->where('status', 'Completed')->count() / $tasks->count() * 100}}%" aria-valuenow="{{ $tasks->where('status', 'Completed')->count() / $tasks->count() * 100}}" aria-valuemin="0" aria-valuemax="100">{{ $tasks->where('status', 'Completed')->count() / $tasks->count() *100 }}%</div>
                        <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $tasks->where('status', 'Inprogress')->count() / $tasks->count() * 100}}%" aria-valuenow="{{ $tasks->where('status', 'Inprogress')->count() / $tasks->count() * 100}}" aria-valuemin="0" aria-valuemax="100">{{ $tasks->where('status', 'Inprogress')->count() / $tasks->count() * 100}}%</div>
                        <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $tasks->where('status', 'Overdue')->count() / $tasks->count() * 100}}%" aria-valuenow="{{ $tasks->where('status', 'Overdue')->count() / $tasks->count() * 100}}" aria-valuemin="0" aria-valuemax="100">{{ $tasks->where('status', 'Overdue')->count() / $tasks->count() * 100}}%</div>
                    </div>
                    <div>
                        <p><i class="fa fa-dot-circle-o text-purple mr-2"></i>Completed Tasks 
                            <span class="float-right">{{ $tasks->where('status', 'Completed')->count() }}</span>
                        </p>
                        <p><i class="fa fa-dot-circle-o text-warning mr-2"></i>Inprogress Tasks 
                            <span class="float-right">{{ $tasks->where('status', 'Inprogress')->count() }}</span>
                        </p>
                        <p><i class="fa fa-dot-circle-o text-danger mr-2"></i>Overdue 
                            <span class="float-right">{{ $tasks->where('status', 'Overdue')->count() }}</span>
                        </p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-8 d-flex">
            <div class="card card-table flex-fill">
                <div class="card-header">
                    <h3 class="card-title mb-0">Recent Tasks</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table custom-table mb-0">
                            <thead>
                                <tr>
                                    <th>Task Name </th>
                                    <th>Assigned To</th>
                                    <th>Priority</th>
                                    <th>Deadline</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($latest_tasks as $task)
                                    <tr>
                                        <td>
                                            <h2><a href="#">{{ $task->name }}</a></h2>
                                        </td>
                                        <td>
                                            <h2>{{ $task->user->name }}</h2>
                                        </td>
                                        <td>
                                            <h2>{{ $task->priority }}</h2>
                                        </td>
                                        <td>
                                            <h2>{{ $task->deadline }}</h2>
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="{{ route('task.show', $task->id) }}" class="action-icon">View</a>
                                            </div>
                                        </td>
                                    </tr>                                    
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="projects.html">View all projects</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /Statistics Widget -->
@endsection
