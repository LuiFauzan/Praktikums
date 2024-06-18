<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg ">
                <x-slot name="header">
                    <div class="flex justify-between items-center border p-4">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ __('Dashboard') }}
                        </h2>
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" class="relative focus:outline-none">
                                <!-- Icon Bell -->
                                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.5V11a6.002 6.002 0 00-5-5.917V5a3 3 0 00-6 0v.083A6.002 6.002 0 002 11v3.5c0 .42-.162.827-.405 1.095L0 17h5m10 0v1a3 3 0 01-6 0v-1m6 0H9" />
                                </svg>
                                <!-- Red Dot -->
                                @if ($notifications->isNotEmpty())
                                    <span class="absolute top-0 right-0 block h-2 w-2 bg-red-600 rounded-full ring-2 ring-white"></span>
                                @endif
                            </button>
                            <!-- Notification Dropdown -->
                            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-64 bg-white rounded-lg shadow-lg overflow-hidden z-20">
                                @if ($notifications->isEmpty())
                                    <div class="p-4 text-gray-600 text-sm">Tidak ada notifikasi baru.</div>
                                @else
                                    <ul class="divide-y divide-gray-200">
                                        @foreach ($notifications as $notification)
                                            <li class="p-4 text-gray-600 text-sm" x-data="{ read: false }" x-show="!read">
                                                <button @click="read = true; markAsRead('{{ $notification->id }}')">
                                                    {{ $notification->data['message'] }}
                                                    <span class="block text-xs text-gray-500">{{ $notification->created_at->diffForHumans() }}</span>
                                                </button>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                </x-slot>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (auth()->user()->role == 'Ketua Lab')
                    {{ __("Selamat Datang Ketua") }}
                    @elseif(auth()->user()->role == 'Mahasiswa')
                    {{ __("Selamat Datang Mahasiswa") }}
                    @elseif(auth()->user()->role == 'Asisten Lab')
                    {{ __("Selamat Datang Asisten") }}
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script>
        function markAsRead(id) {
            fetch('{{ route("notifications.read") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ id: id })
            }).then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    // You can add additional logic here if needed
                }
            });
        }
        </script>
</x-app-layout>
