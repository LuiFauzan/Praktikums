<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Praktikum') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-4 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="mb-4" x-data="{ openModalPraktikum: false }">
                    <button x-on:click="openModalPraktikum = true" class="p-2 bg-slate-200 hover:bg-slate-300 rounded-md text-sm">
                        <i class="fas fa-plus"></i> Tambah Praktikum
                    </button>
                    <!-- Modal untuk Form Tambah Praktikum -->
                    <div x-show="openModalPraktikum" x-on:keydown.escape.window="openModalPraktikum = false" class="fixed top-0 left-0 w-full h-full p-10 bg-black bg-opacity-50 flex justify-center items-center">
                        <!-- Modal Content -->
                        <div class="bg-white rounded-lg p-8 max-w-3xl w-full">
                            <h2 class="text-lg font-semibold mb-4">Tambah Praktikum</h2>
                            <!-- Form Tambah Praktikum -->
                            <form method="POST" action="{{ route('praktikum.store') }}" class="grid grid-cols-2 gap-x-4">
                                @csrf
                                <!-- Nama -->
                                <div class="col-span-2">
                                    <x-input-label for="nama" :value="__('Nama')" />
                                    <x-text-input id="nama" class="block mt-1 w-full" type="text" name="nama" :value="old('nama')" required autofocus autocomplete="nama" />
                                    <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                                </div>
                                <!-- Slug -->
                                <div class="col-span-2">
                                    <x-input-label for="slug" :value="__('Nomor Mata Kuliah')" />
                                    <x-text-input id="slug" class="block mt-1 w-full" type="text" name="slug" :value="old('slug')" required />
                                    <x-input-error :messages="$errors->get('slug')" class="mt-2" />
                                </div>
                                <!-- Semester -->
                                <div class="col-span-2">
                                    <x-input-label for="semester" :value="__('Semester')" />
                                    <x-text-input id="semester" class="block mt-1 w-full" type="text" name="semester" :value="old('semester')" required />
                                    <x-input-error :messages="$errors->get('semester')" class="mt-2" />
                                </div>
                                <!-- Tahun Ajaran -->
                                <div class="col-span-2">
                                    <x-input-label for="tahunajaran" :value="__('Tahun Ajaran')" />
                                    <select id="tahunajaran" name="tahunajaran" class="block mt-1 w-full" required>
                                        <option value="" disabled selected>Pilih Tahun Ajaran</option>
                                        <option value="2023-2024 Ganjil" @if(old('tahunajaran') == '2023-2024 Ganjil') selected @endif>2023-2024 Ganjil</option>
                                        <option value="2023-2024 Genap" @if(old('tahunajaran') == '2023-2024 Genap') selected @endif>2023-2024 Genap</option>
                                        <option value="2024-2025 Ganjil" @if(old('tahunajaran') == '2024-2025 Ganjil') selected @endif>2024-2025 Ganjil</option>
                                        <option value="2024-2025 Genap" @if(old('tahunajaran') == '2024-2025 Genap') selected @endif>2024-2025 Genap</option>
                                        <option value="2025-2026 Ganjil" @if(old('tahunajaran') == '2025-2026 Ganjil') selected @endif>2025-2026 Ganjil</option>
                                        <option value="2025-2026 Genap" @if(old('tahunajaran') == '2025-2026 Genap') selected @endif>2025-2026 Genap</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('tahunajaran')" class="mt-2" />
                                </div>

                                <!-- Tombol Simpan dan Batal -->
                                <div class="col-span-2 flex justify-end mt-6">
                                    <button type="button" x-on:click="openModalPraktikum = false" class="mr-2 px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 focus:outline-none">Batal</button>
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
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nomor Mata Kuliah</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Semester</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tahun Ajaran</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($praktikum as $index => $item)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->nama }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->slug }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->semester }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->tahunajaran }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                {{-- <a href="{{ route('praktikum.edit', $item->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a> --}}
                                <div class="flex">

                                    <div class="mb-4" x-data="{ openModalPraktikum{{ $item->id }}: false }">
                                        <button x-on:click="openModalPraktikum{{ $item->id }} = true" class="text-indigo-600 hover:text-indigo-900">
                                            Edit
                                        </button>
                                        <!-- Modal untuk Form Tambah Praktikum -->
                                        <div x-show="openModalPraktikum{{ $item->id }}" x-on:keydown.escape.window="openModalPraktikum{{ $item->id }} = false" class="fixed top-0 left-0 w-full h-full p-10 bg-black bg-opacity-50 flex justify-center items-center">
                                            <!-- Modal Content -->
                                            <div class="bg-white rounded-lg p-8 max-w-3xl w-full">
                                                <h2 class="text-lg font-semibold mb-4">Edit Praktikum</h2>
                                                <!-- Form Tambah Praktikum -->
                                                <form method="POST" action="{{ route('praktikum.update',$item->id) }}" class="grid grid-cols-2 gap-x-4">
                                                    @csrf
                                                    @method('PUT')
                                                    <!-- Nama -->
                                                    <div class="col-span-2">
                                                        <x-input-label for="nama" :value="__('Nama')" />
                                                        <x-text-input id="nama" class="block mt-1 w-full" type="text" name="nama" value="{{ $item->nama }}" required autofocus autocomplete="nama" />
                                                        <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                                                    </div>
                                                    <!-- Slug -->
                                                    <div class="col-span-2">
                                                        <x-input-label for="slug" :value="__('Nomor Mata Kuliah')" />
                                                        <x-text-input id="slug" class="block mt-1 w-full" type="text" name="slug" value="{{ $item->slug }}" required />
                                                        <x-input-error :messages="$errors->get('slug')" class="mt-2" />
                                                    </div>
                                                    <!-- Semester -->
                                                    <div class="col-span-2">
                                                        <x-input-label for="semester" :value="__('Semester')" />
                                                        <x-text-input id="semester" class="block mt-1 w-full" type="text" name="semester" value="{{ $item->semester }}" required />
                                                        <x-input-error :messages="$errors->get('semester')" class="mt-2" />
                                                    </div>
                                                    <!-- Tahun Ajaran -->
                                                    <div class="col-span-2">
                                                        <x-input-label for="tahunajaran" :value="__('Tahun Ajaran')" />
                                                        <select id="tahunajaran" name="tahunajaran" class="block mt-1 w-full" required>
                                                            <option value="" disabled selected>Pilih Tahun Ajaran</option>
                                                            <option value="2023-2024 Ganjil" @if(old('tahunajaran') == '2023-2024 Ganjil') selected @endif>2023-2024 Ganjil</option>
                                                            <option value="2023-2024 Genap" @if(old('tahunajaran') == '2023-2024 Genap') selected @endif>2023-2024 Genap</option>
                                                            <option value="2024-2025 Ganjil" @if(old('tahunajaran') == '2024-2025 Ganjil') selected @endif>2024-2025 Ganjil</option>
                                                            <option value="2024-2025 Genap" @if(old('tahunajaran') == '2024-2025 Genap') selected @endif>2024-2025 Genap</option>
                                                            <option value="2025-2026 Ganjil" @if(old('tahunajaran') == '2025-2026 Ganjil') selected @endif>2025-2026 Ganjil</option>
                                                            <option value="2025-2026 Genap" @if(old('tahunajaran') == '2025-2026 Genap') selected @endif>2025-2026 Genap</option>
                                                        </select>
                                                        <x-input-error :messages="$errors->get('tahunajaran')" class="mt-2" />
                                                    </div>
                    
                                                    <!-- Tombol Simpan dan Batal -->
                                                    <div class="col-span-2 flex justify-end mt-6">
                                                        <button type="button" x-on:click="openModalPraktikum{{ $item->id }} = false" class="mr-2 px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 focus:outline-none">Batal</button>
                                                        <x-primary-button>
                                                            {{ __('Simpan') }}
                                                        </x-primary-button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <form action="{{ route('praktikum.destroy', $item->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="confirmButton text-red-600 hover:text-red-900 ml-2">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <td colspan="6" class="px-6 py-4 text-center whitespace-nowrap text-sm text-gray-500">
                            DATA PRAKTIKUM BELUM ADA
                        </td>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">

                {{ $praktikum->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
