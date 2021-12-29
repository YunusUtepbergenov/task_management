@extends('layouts.main')

@section('main')
<!-- Page Header -->
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Department</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                <li class="breadcrumb-item active">Department</li>
            </ul>
        </div>
    </div>
</div>
<!-- /Page Header -->

<div class="row">
    <div class="col-md-12">
        <div>
            <table class="table table-striped custom-table mb-0 datatable">
                <thead>
                    <tr>
                        <th style="width: 30px;">#</th>
                        <th>Department Name</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sectors as $sector)
                        <tr>
                            <td>{{ $sector->id }}</td>
                            <td>{{ $sector->name }}</td>
                            <td class="text-right">
                            <div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_department"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_department"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                </div>
                                </div>
                            </td>
                        </tr>                            
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
