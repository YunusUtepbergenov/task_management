@extends('layouts.main')

@section('styles')
	<!-- Select2 CSS -->
	<link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">
	<!-- Datatable CSS -->
	<link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}">
			
	<!-- Datetimepicker CSS -->
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}">
@endsection

@section('main')
	<!-- Page Content -->
	<div class="content container-fluid">
	
		<!-- Page Header -->
		<div class="page-header">
			<div class="row align-items-center">
				<div class="col">
					<h3 class="page-title">Employee</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
						<li class="breadcrumb-item active">Employee</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /Page Header -->
							
		<div class="row">
			<div class="col-md-12">
				<div class="table-responsive">
					<table class="table table-striped custom-table datatable">
						<thead>
							<tr>
								<th>Name</th>
								<th>Email</th>
								<th>Sector</th>
								<th>Role</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($employees as $employee)
								<tr>
									<td>
										<h2 class="table-avatar">
											<a href="#" class="avatar"><img alt="" src="{{ asset('assets/img/profiles/avatar-02.jpg') }}"></a>
											<a href="#">{{ $employee->name }} <span>Web Designer</span></a>
										</h2>
									</td>
									<td>{{ $employee->email }}</td>
									<td class="text-wrap">{{ $employee->sector->name }}</td>
									<td>{{ $employee->role->name }}</td>
								</tr>								
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>

	
	</div>
	<!-- /Page Content -->
@endsection

@section('scripts')
	<!-- Select2 JS -->
	<script src="{{ asset('assets/js/select2.min.js') }}"></script>
	<script src="{{ asset('assets/js/moment.min.js') }}"></script>
	<script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
	<!-- Datatable JS -->
	<script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>
	
@endsection