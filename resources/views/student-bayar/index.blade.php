<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Pembayaran') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-4 overflow-hidden shadow-sm sm:rounded-lg">
                <table class="min-w-full divide-y w-full divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                No
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama Praktikum
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Jumlah Bayar
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($pembayaran as $index => $item)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $item->jadwalpraktikum->praktikum->nama }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ 'Rp. ' . number_format($item->harga, 0, ',', '.') . ' ,-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <div x-data="{ showModal: false, itemId: '', imageUrl: '' }">
                                    <button @click="itemId = '{{ $item->id }}'; showModal = true" class="text-indigo-600 hover:text-indigo-900">Bayar</button>
                                    <!-- Modal Background -->
                                    <div x-show="showModal" class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-75 z-50">
                                        <!-- Modal Content -->
                                        <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full" @click.away="showModal = false">
                                            <div class="flex justify-end">
                                                <button @click="showModal = false" class="text-gray-600 hover:text-gray-800 focus:outline-none">
                                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                            <h2 class="text-lg font-semibold mb-4">Form Pembayaran</h2>
                                            <form action="{{ route('checkout') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="item_id" :value="itemId">
                                                <div class="mb-4">
                                                    <label for="nama_rek" class="block text-sm font-medium text-gray-700">Nama Pemilik Rekening</label>
                                                    <input type="text" id="nama_rek" value="{{ $item->namarek }}" disabled name="nama_rek" required
                                                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                </div>
                                                <div class="mb-4">
                                                    <label for="no_rek" class="block text-sm font-medium text-gray-700">Nomor Rekening</label>
                                                    <input type="text" id="no_rek" value="{{ $item->norek }}" disabled name="no_rek"
                                                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                </div>
                                                <div class="mb-4">
                                                    <label for="jumlah" class="block text-sm font-medium text-gray-700">Jumlah Pembayaran</label>
                                                    <input type="text" id="jumlah" value="{{ 'Rp ' . number_format($item->harga, 0, ',', '.') . ' ,-' }}" disabled name="jumlah"
                                                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                </div>
                                                <div class="mb-4">
                                                    <label for="bukti_pembayaran" class="block text-sm font-medium text-gray-700">Bukti Pembayaran</label>
                                                    <input type="file" id="bukti_pembayaran" name="photo" @change="previewImage" required
                                                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                </div>
                                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                                <input type="hidden" name="pembayaran_praktikum_id" value="{{ $item->id }}">
                                                <div class="mb-4" x-show="imageUrl">
                                                    <label class="block text-sm font-medium text-gray-700">Preview Gambar</label>
                                                    <img :src="imageUrl" alt="Preview Bukti Pembayaran" class="mt-2 rounded-md max-h-48">
                                                </div>
                                                <div class="flex justify-end">
                                                    <button type="submit"
                                                        class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                                        Bayar
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                                   
                        </tr>
                        @empty
                        <td colspan="10" class="px-6 py-4 text-center whitespace-nowrap text-sm text-gray-500">
                            DATA JADWAL BELUM ADA
                        </td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- {{ $jadwalpraktikum->links() }} --}}
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/alpine.min.js" defer></script>

<script>
    function openModal(itemId) {
        Alpine.store('modalData').itemId = itemId;
        Alpine.store('modalData').showModal = true;
    }

    function closeModal() {
        Alpine.store('modalData').showModal = false;
    }
    document.addEventListener('alpine:init', () => {
        Alpine.data('modal', () => ({
            showModal: false,
            itemId: '',
            imageUrl: '',

            previewImage(event) {
                const input = event.target;
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.imageUrl = e.target.result;
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
        }));
    });
</script>
</x-app-layout>