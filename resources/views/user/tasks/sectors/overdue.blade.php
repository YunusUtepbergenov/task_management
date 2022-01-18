@extends('layouts.user')

@section('main')
<!-- Page Header -->
<div class="page-header">
    <div class="row">
        <div class="col-sm-12">
            <h3 class="page-title">Overdue Tasks</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active">Overdue Tasks</li>
            </ul>
        </div>
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
                            <tr>
                                <td><a href="#" class="btn">{{ $task->user->name }}</a></td>
                                <td>{{ $task->name }}</td>
                                <td>{{ $task->priority }}</td>
                                <td>{{ $task->deadline }}</td>
                                <td>Overdue</td>
                                <td>{{ $task->created_at->format('Y-m-d') }}</td>
                                <td><a class="btn btn-primary" href="{{ route('user.task', $task->id) }}">View</a></td>
                            </tr>
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

@endsection
