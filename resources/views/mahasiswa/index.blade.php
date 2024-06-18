<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Mahasiswa') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-4 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="mb-4" x-data="{ openModal: false, selectedRole: '' }">
                    <!-- Tombol untuk Membuka Modal -->
                    <button x-on:click="openModal = true" class="p-2 bg-slate-200 hover:bg-slate-300 rounded-md text-sm">
                        <i class="fas fa-user-plus"></i> Tambah Mahasiswa
                    </button>
                
                    <!-- Modal untuk Form Tambah Asisten Lab -->
                    <div x-show="openModal" x-on:keydown.escape.window="openModal = false" class="fixed top-0 left-0 w-full h-full p-10 bg-black bg-opacity-50 flex justify-center items-center">
                        <!-- Modal Content -->
                        <div class="bg-white rounded-lg p-8 max-w-3xl w-full">
                            <h2 class="text-lg font-semibold mb-4">Tambah Mahasiswa</h2>

                            <!-- Form Tambah Asisten Lab -->
                            <form method="POST" action="{{ route('mahasiswa.store') }}" class="grid grid-cols-2 gap-x-4">
                                @csrf

                                <!-- Nama -->
                                <div class="col-span-2">
                                    <x-input-label for="nama" :value="__('Nama')" />
                                    <x-text-input id="nama" class="block mt-1 w-full" type="text" name="nama" :value="old('nama')" required autofocus autocomplete="nama" />
                                    <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                                </div>

                                <!-- Email -->
                                <div class="col-span-2">
                                    <x-input-label for="email" :value="__('Email')" />
                                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>

                                <!-- NPM -->
                                <div class="col-span-2">
                                    <x-input-label for="npm" :value="__('NPM')" />
                                    <x-text-input id="npm" class="block mt-1 w-full" type="text" name="npm" :value="old('npm')" required />
                                    <x-input-error :messages="$errors->get('npm')" class="mt-2" />
                                </div>

                                <!-- Semester -->
                                <div class="col-span-2">
                                    <x-input-label for="semester" :value="__('Semester')" />
                                    <x-text-input id="semester" class="block mt-1 w-full" type="number" name="semester" :value="old('semester')" required />
                                    <x-input-error :messages="$errors->get('semester')" class="mt-2" />
                                </div>
                            
                                <!-- Kelas -->
                                <div class="col-span-2">
                                    <x-input-label for="kelas" :value="__('Kelas')" />
                                    <x-text-input id="kelas" class="block mt-1 w-full" type="text" name="kelas" :value="old('kelas')" required />
                                    <x-input-error :messages="$errors->get('kelas')" class="mt-2" />
                                </div>

                                <!-- Tahun Masuk -->
                                <div class="col-span-2">
                                    <x-input-label for="tahunmasuk" :value="__('Tahun Masuk')" />
                                    <x-text-input id="tahunmasuk" class="block mt-1 w-full" type="text" name="tahunmasuk" :value="old('tahunmasuk')" required />
                                    <x-input-error :messages="$errors->get('tahunmasuk')" class="mt-2" />
                                </div>

                                 <!-- Role -->
                                 <div class="col-span-2">
                                    <x-input-label for="role" :value="__('Role')" />
                                    <select id="role" name="role" class="block mt-1 w-full" required x-model="selectedRole" x-on:change="togglePraktikumField(selectedRole)">
                                        <option value="" disabled selected>{{ __('Select Role') }}</option>
                                        <option value="Mahasiswa">{{ __('Mahasiswa') }}</option>
                                        <!-- Tambah opsi role lain jika diperlukan -->
                                    </select>
                                    <x-input-error :messages="$errors->get('role')" class="mt-2" />
                                </div>

                                <!-- Tombol Simpan dan Batal -->
                                <div class="col-span-2 flex justify-end mt-6">
                                    <button type="button" x-on:click="openModal = false" class="mr-2 px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 focus:outline-none">Batal</button>
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
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                No
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                NPM
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Email
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Kelas
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tahun Masuk
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Semester
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($mahasiswa as $index => $item)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $item->nama }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $item->npm }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $item->email }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $item->kelas }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $item->tahunmasuk }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                4
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('mahasiswa.edit', $item->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                <form action="{{ route('mahasiswa.destroy', $item->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="confirmButton text-red-600 hover:text-red-900 ml-2">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <td colspan="4" class="px-6 py-4 text-center whitespace-nowrap text-sm text-gray-500">
                            DATA DOSEN BELUM ADA
                        </td>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-5">
                {{ $mahasiswa->links() }}
            </div>
        </div>
    </div>
    
</x-app-layout>