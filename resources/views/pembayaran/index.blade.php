<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Pembayaran') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-4 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="mb-4" x-data="{ openModalPembayaran: false }">
                    <button x-on:click="openModalPembayaran = true" class="p-2 bg-slate-200 hover:bg-slate-300 rounded-md text-sm">
                        <i class="fas fa-user-plus"></i> Tambah Pembayaran
                    </button>
                    <!-- Modal untuk Form Tambah Pembayaran -->
                    <div x-show="openModalPembayaran" x-on:keydown.escape.window="openModalPembayaran = false" class="fixed top-0 left-0 w-full h-full p-10 bg-black bg-opacity-50 flex justify-center items-center">
                        <!-- Modal Content -->
                        <div class="bg-white rounded-lg p-8 max-w-3xl w-full">
                            <h2 class="text-lg font-semibold mb-4">Tambah Pembayaran</h2>

                            <!-- Form Tambah Pembayaran -->
                            <form method="POST" action="{{ route('pembayaran.store') }}" class="grid grid-cols-2 gap-x-4">
                                @csrf
                                <!-- Daftar Praktikum -->
                                <div class="col-span-2">
                                    <x-input-label for="jadwal_praktikum_id" :value="__('Daftar Praktikum')" />
                                    <select id="jadwal_praktikum_id" name="jadwal_praktikum_id" class="block mt-1 w-full" required>
                                        <option value="">Pilih Daftar Praktikum</option>
                                        @foreach ($daftarPraktikum as $item)
                                            <option value="{{ $item->jadwalpraktikum->id }}">{{ $item->jadwalPraktikum->praktikum->nama }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('jadwal_praktikum_id')" class="mt-2" />
                                </div>
                                <!-- Nama Rekening -->
                                <div class="col-span-2">
                                    <x-input-label for="namarek" :value="__('Nama Rekening')" />
                                    <x-text-input id="namarek" class="block mt-1 w-full" type="text" name="namarek" :value="old('namarek')" required autofocus autocomplete="namarek" />
                                    <x-input-error :messages="$errors->get('namarek')" class="mt-2" />
                                </div>
                                <!-- Nomor Rekening -->
                                <div class="col-span-2">
                                    <x-input-label for="norek" :value="__('Nomor Rekening')" />
                                    <x-text-input id="norek" class="block mt-1 w-full" type="number" name="norek" :value="old('norek')" required />
                                    <x-input-error :messages="$errors->get('norek')" class="mt-2" />
                                </div>
                                <!-- Harga -->
                                <div class="col-span-2">
                                    <x-input-label for="harga" :value="__('Harga')" />
                                    <x-text-input id="harga" class="block mt-1 w-full" type="number" name="harga" :value="old('harga')" required />
                                    <x-input-error :messages="$errors->get('harga')" class="mt-2" />
                                </div>
                                <!-- Tombol Simpan dan Batal -->
                                <div class="col-span-2 flex justify-end mt-6">
                                    <button type="button" x-on:click="openModalPembayaran = false" class="mr-2 px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 focus:outline-none">Batal</button>
                                    <x-primary-button>
                                        {{ __('Simpan') }}
                                    </x-primary-button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>             
                <table class="min-w-full divide-y w-full divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                No
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama Praktikum
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama Rekening
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nomor Rekening
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Harga
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
                                {{ $item->jadwalPraktikum->praktikum->nama }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $item->namarek }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $item->norek }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ 'Rp. ' . number_format($item->harga, 0, ',', '.') . ' ,-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                @if (auth()->user()->praktikum_id == optional(optional($item->jadwalPraktikum)->praktikum)->id)
                                    <a href="{{ route('pembayaran.edit', $item->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    <form action="{{ route('pembayaran.destroy', $item->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="confirmButton text-red-600 hover:text-red-900 ml-2">Delete</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <td colspan="5" class="px-6 py-4 text-center whitespace-nowrap text-sm text-gray-500">
                            DATA PEMBAYARAN BELUM ADA
                        </td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{ $pembayaran->links() }}
</x-app-layout>
