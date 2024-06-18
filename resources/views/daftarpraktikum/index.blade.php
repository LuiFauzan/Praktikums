<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Daftar Praktikum') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-4 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="mb-4" x-data="{ openModalDosen: false, selectedUsers: [], selectedJadwalPraktikum: [] }">
                    <div class="flex gap-2">
                        <button x-on:click="openModalDosen = true" class="p-2 bg-slate-200 hover:bg-slate-300 rounded-md text-sm">
                            <i class="fas fa-user-plus"></i> Tambah Daftar Praktikum
                        </button>
                        <form action="{{ route('daftarpraktikum.batchDelete') }}" method="POST">
                            @csrf
                            @method('DELETE')     
                            <button type="button" class="confirmButton p-2 bg-red-200 hover:bg-red-300 rounded-md text-sm"><i class="fa-solid fa-trash-can"></i> Hapus yang Dipilih</button>
                        </form>
                    </div>
                    <!-- Modal untuk Form Tambah Daftar Praktikum -->
                    <div x-show="openModalDosen" x-on:keydown.escape.window="openModalDosen = false" class="fixed top-0 left-0 w-full h-full p-10 bg-black bg-opacity-50 flex justify-center items-center">
                        <!-- Modal Content -->
                        <div class="bg-white rounded-lg p-8 max-w-3xl w-full overflow-hidden">
                            <h2 class="text-lg font-semibold mb-4">Tambah Daftar</h2>
                        
                            <!-- Form Filter -->
                            <form method="GET" action="{{ route('daftarpraktikum') }}" class="mb-4">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div>
                                        <x-input-label for="kelas" :value="__('Filter Kelas')" />
                                        <select id="kelas" name="kelas" class="block mt-1 w-full">
                                            <option value="">Pilih Kelas</option>
                                            @foreach ($kelasList as $kelas)
                                                <option value="{{ $kelas }}">{{ $kelas }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <x-input-label for="semester" :value="__('Filter Semester')" />
                                        <select id="semester" name="semester" class="block mt-1 w-full">
                                            <option value="">Pilih Semester</option>
                                            @foreach ($semesterList as $semester)
                                                <option value="{{ $semester }}">{{ $semester }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <x-input-label for="tahunmasuk" :value="__('Filter Tahun Masuk')" />
                                        <select id="tahunmasuk" name="tahunmasuk" class="block mt-1 w-full">
                                            <option value="">Pilih Tahun Masuk</option>
                                            @foreach ($tahunMasukList as $tahunmasuk)
                                                <option value="{{ $tahunmasuk }}">{{ $tahunmasuk }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Filter</button>
                                </div>
                            </form>
                        
                            <form method="POST" action="{{ route('daftarpraktikum.store') }}">
                                @csrf
                        
                                <h2>Pilih User</h2>
                                <div class="overflow-y-auto max-h-48"> <!-- Scrollable container -->
                                    @foreach ($users as $user)
                                        <label class="flex items-center">
                                            <input type="checkbox" name="user_id[]" value="{{ $user->id }}" x-model="selectedUsers" class="text-black">
                                            <span class="ml-2">{{ $user->nama }}</span>
                                        </label>
                                    @endforeach
                                    <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                                </div>
                        
                                <h2 class="mt-4">Pilih Jadwal Praktikum</h2>
                                <div class="overflow-y-auto max-h-48"> <!-- Scrollable container -->
                                    @foreach ($jadwalPraktikums as $jadwalPraktikum)
                                        <label class="flex items-center">
                                            <input type="checkbox" name="jadwal_praktikum_id[]" value="{{ $jadwalPraktikum->id }}" x-model="selectedJadwalPraktikum" class="text-black">
                                            <span class="ml-2 text-black">{{ $jadwalPraktikum->praktikum->nama }}</span>
                                        </label>
                                    @endforeach
                                    <x-input-error :messages="$errors->get('jadwal_praktikum_id')" class="mt-2" />
                                </div>
                        
                                <!-- Tombol Simpan dan Cancel -->
                                <div class="mt-4 flex justify-end">
                                    <button type="button" x-on:click="openModalDosen = false" class="px-4 py-2 mr-2 bg-gray-400 text-white rounded-md hover:bg-gray-500">Cancel</button>
                                    <x-primary-button>
                                        {{ __('Simpan') }}
                                    </x-primary-button>                                </div>
                            </form>
                        </div>
                        
                    </div>
                </div>
                
                            
                <table class="min-w-full divide-y w-full divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                No
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama Mahasiswa
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama Pratikum
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($dp as $index => $item)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <input type="checkbox" name="selected_items[]" value="{{ $item->id }}" class="mr-1">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $item->user->nama }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $item->jadwalpraktikum->praktikum->nama }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                {{-- <a href="{{ route('dosen.edit', $item->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a> --}}
                                <form action="{{ route('daftarpraktikum.destroy', $item->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="confirmButton text-red-600 hover:text-red-900 ml-2">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center whitespace-nowrap text-sm text-gray-500">
                                BELUM ADA DAFTAR
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    
                </table>
            </div>
        </div>
    </div>
    {{ $dp->links() }}
    
</x-app-layout>