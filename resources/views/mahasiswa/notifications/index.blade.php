@extends('mahasiswa.layouts.app')

@section('content')
<div class="container-lg">
    <div class="card mb-4">
        <div class="card-header">
            <strong>Semua Notifikasi</strong>
            
        </div>
        <div class="card-body">
            @if($notifications->count() > 0)
                <div class="list-group">
                    @foreach($notifications as $notification)
                    <div class="list-group-item list-group-item-action {{ $notification->read_at ? '' : 'fw-bold' }}">
                        <div class="d-flex w-100 justify-content-between align-items-center">
                            <div>
                                <div class="mb-1">
                                    <a href="{{ $notification->data['action_url'] }}" class="text-decoration-none">
                                        <div class="d-flex align-items-center">
                                            <div class="me-3">
                                                @if(isset($notification->data['type']) && $notification->data['type'] == 'message')
                                                    <div class="avatar avatar-md bg-primary-gradient text-white">
                                                        <svg class="icon icon-xl">
                                                            <use xlink:href="{{ asset('template') }}/vendors/@coreui/icons/svg/free.svg#cil-envelope-open"></use>
                                                        </svg>
                                                    </div>
                                                @elseif(isset($notification->data['type']) && $notification->data['type'] == 'alert')
                                                    <div class="avatar avatar-md bg-danger-gradient text-white">
                                                        <svg class="icon icon-xl">
                                                            <use xlink:href="{{ asset('template') }}/vendors/@coreui/icons/svg/free.svg#cil-warning"></use>
                                                        </svg>
                                                    </div>
                                                @else
                                                    <div class="avatar avatar-md bg-info-gradient text-white">
                                                        <svg class="icon icon-xl">
                                                            <use xlink:href="{{ asset('template') }}/vendors/@coreui/icons/svg/free.svg#cil-info"></use>
                                                        </svg>
                                                    </div>
                                                @endif
                                            </div>
                                            <div>
                                                <h5 class="mb-1">{{ $notification->data['title'] }}</h5>
                                                <p class="text-body-secondary mb-0">{{ $notification->data['message'] }}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <small class="text-muted me-3">{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</small>
                                @if(!$notification->read_at)
                                <form action="{{ route('notifications.read', ['role' => $role, 'id' => $notification->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-secondary">
                                        <svg class="icon">
                                            <use xlink:href="{{ asset('template') }}/vendors/@coreui/icons/svg/free.svg#cil-check"></use>
                                        </svg>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <div class="mt-4">
                    {{ $notifications->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <svg class="icon icon-3xl text-secondary mb-3">
                        <use xlink:href="{{ asset('template') }}/vendors/@coreui/icons/svg/free.svg#cil-bell-exclamation"></use>
                    </svg>
                    <h5>Tidak ada notifikasi</h5>
                    <p class="text-muted">Anda belum memiliki notifikasi apapun</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection