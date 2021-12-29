
<!-- Notifications -->
<li class="nav-item dropdown">
    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
        <i class="fa fa-bell-o"></i> <span class="badge badge-pill">{{ auth()->user()->unreadNotifications()->count() }}</span>
    </a>
    <div class="dropdown-menu notifications">
        <div class="topnav-dropdown-header">
            <span class="notification-title">Notifications</span>
        </div>
        <div class="noti-content">
            <ul class="notification-list">
                @foreach (auth()->user()->unreadNotifications as $notification)
                    <li class="notification-message">
                        <div class="notification-action">
                            {{-- <a href="#" class="action-icon"><i class="fa fa-trash" aria-hidden="true"></i></a> --}}
                            <form method="POST" action="{{ route('notification.read', $notification->id) }}">
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">                                    
                                <button class="action-icon"><i class="fa fa-trash" aria-hidden="true"></i></button>
                            </form>
                        </div>
                            <div class="media">
                                <span class="avatar">
                                    <img alt="" src="{{ asset('assets/img/profiles/avatar.png') }}">
                                </span>
                                <div class="media-body">
                                    <p class="noti-details"><span class="noti-title">{{ $notification->data['creator_name'] }}</span> added new task <span class="noti-title">{{ $notification->data['name'] }}</span></p>
                                    <p class="noti-time"><span class="notification-time">{{ \App\Helpers\AppHelper::time_elapsed_string($notification->created_at) }}</span></p>
                                </div>
                            </div>
                        
                    </li>                    
                @endforeach
            </ul>
        </div>
    </div>
</li>
<!-- /Notifications -->
