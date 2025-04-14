{{-- resources/views/notifications/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notifikasi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if ($notifications->count() > 0)
                        <div class="mb-4 flex justify-end">
                            @if (auth()->user()->unreadNotifications->count() > 0)
                                <a href="{{ route('notifications.markAllAsRead') }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                    Tandai semua dibaca
                                </a>
                            @endif
                        </div>
                        
                        <div class="space-y-4">
                            @foreach ($notifications as $notification)
                                <div class="p-4 border rounded {{ $notification->read_at ? 'bg-white' : 'bg-blue-50' }}">
                                    <div class="flex justify-between">
                                        <h3 class="font-bold">{{ $notification->data['title'] }}</h3>
                                        <span class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($notification->created_at)->format('d M Y H:i') }}</span>
                                    </div>
                                    <p class="text-gray-700 my-2">{{ $notification->data['message'] }}</p>
                                    <div class="flex justify-between mt-2">
                                        <a href="{{ url($notification->data['action_url']) }}" class="text-blue-500 hover:underline">
                                            Lihat Detail
                                        </a>
                                        @if (!$notification->read_at)
                                            <a href="{{ route('notifications.markAsRead', $notification->id) }}" class="text-gray-500 hover:underline">
                                                Tandai telah dibaca
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="mt-4">
                            {{ $notifications->links() }}
                        </div>
                    @else
                        <p class="text-center text-gray-500">Tidak ada notifikasi</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>