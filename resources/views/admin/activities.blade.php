@extends('layouts.main')

@section('main')
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Activities</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Activities</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        
        <div class="row">
            <div class="col-md-12">
                <div class="activity">
                    <div class="activity-box">
                        <ul class="activity-list">
                            @foreach (auth()->user()->notifications as $notification)
                                <li>
                                    <div class="activity-user">
                                        <a href="#" title="{{ $notification->data['creator_name'] }}" data-toggle="tooltip" class="avatar">
                                            <img src="{{ asset('assets/img/profiles/avatar-12.jpg') }}" alt="">
                                        </a>
                                    </div>
                                    <div class="activity-content">
                                        <div class="timeline-content">
                                            <a href="#" class="name">{{ $notification->data['creator_name'] }}</a> added new task <a href="#">{{ $notification->data['name'] }}</a>
                                            <span class="time">{{ \App\Helpers\AppHelper::time_elapsed_string($notification->created_at) }}</span>
                                        </div>
                                    </div>
                                </li>                                
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
@endsection
