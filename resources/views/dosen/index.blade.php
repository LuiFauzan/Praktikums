<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Dosen') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-4 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="mb-4" x-data="{ openModalDosen: false }">
                    <button x-on:click="openModalDosen = true" class="p-2 bg-slate-200 hover:bg-slate-300 rounded-md text-sm">
                        <i class="fas fa-user-plus"></i> Tambah Dosen
                    </button>
                    <!-- Modal untuk Form Tambah Asisten Lab -->
                    <div x-show="openModalDosen" x-on:keydown.escape.window="openModalDosen = false" class="fixed top-0 left-0 w-full h-full p-10 bg-black bg-opacity-50 flex justify-center items-center">
                        <!-- Modal Content -->
                        <div class="bg-white rounded-lg p-8 max-w-3xl w-full">
                            <h2 class="text-lg font-semibold mb-4">Tambah Dosen</h2>

                            <!-- Form Tambah Asisten Lab -->
                            <form method="POST" action="{{ route('dosen.store') }}" class="grid grid-cols-2 gap-x-4">
                                @csrf
                                <!-- Nama -->
                                <div class="col-span-2">
                                    <x-input-label for="nama" :value="__('Nama')" />
                                    <x-text-input id="nama" class="block mt-1 w-full" type="text" name="nama" :value="old('nama')" required autofocus autocomplete="nama" />
                                    <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                                </div>
                                <!-- NPM -->
                                <div class="col-span-2">
                                    <x-input-label for="nid" :value="__('NID')" />
                                    <x-text-input id="nid" class="block mt-1 w-full" type="text" name="nid" :value="old('nid')" required />
                                    <x-input-error :messages="$errors->get('nid')" class="mt-2" />
                                <!-- Tombol Simpan dan Batal -->
                                <div class="col-span-2 flex justify-end mt-6">
                                    <button type="button" x-on:click="openModalDosen = false" class="mr-2 px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 focus:outline-none">Batal</button>
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
                                NID
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($dosen as $index => $item)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $item->nama }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $item->nid }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                {{-- <a href="{{ route('dosen.edit', $item->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a> --}}
                                <div class="mb-4" x-data="{ openModalDosen{{ $item->id }}: false }">
                                    <button x-on:click="openModalDosen{{ $item->id }} = true" class="text-indigo-600 hover:text-indigo-900">
                                        Edit
                                    </button>
                                    <!-- Modal untuk Form Tambah Asisten Lab -->
                                    <div x-show="openModalDosen{{ $item->id }}" x-on:keydown.escape.window="openModalDosen{{ $item->id }} = false" class="fixed top-0 left-0 w-full h-full p-10 bg-black bg-opacity-50 flex justify-center items-center">
                                        <!-- Modal Content -->
                                        <div class="bg-white rounded-lg p-8 max-w-3xl w-full">
                                            <h2 class="text-lg font-semibold mb-4">Edit Dosen</h2>
                                            <!-- Form Tambah Asisten Lab -->
                                            <form method="POST" action="{{ route('dosen.update',$item->id) }}" class="grid grid-cols-2 gap-x-4">
                                                @csrf
                                                @method('PUT')
                                                <!-- Nama -->
                                                <div class="col-span-2">
                                                    <x-input-label for="nama" :value="__('Nama')" />
                                                    <x-text-input id="nama" class="block mt-1 w-full" type="text" name="nama" value="{{ $item->nama }}"  required autofocus autocomplete="nama" />
                                                    <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                                                </div>
                                                <!-- NPM -->
                                                <div class="col-span-2">
                                                    <x-input-label for="nid" :value="__('NID')" />
                                                    <x-text-input id="nid" class="block mt-1 w-full" type="text" name="nid" value="{{ $item->nid }}" required />
                                                    <x-input-error :messages="$errors->get('nid')" class="mt-2" />
                                                <!-- Tombol Simpan dan Batal -->
                                                <div class="col-span-2 flex justify-end mt-6">
                                                    <button type="button" x-on:click="openModalDosen{{ $item->id }} = false" class="mr-2 px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 focus:outline-none">Batal</button>
                                                    <x-primary-button>
                                                        {{ __('Simpan') }}
                                                    </x-primary-button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>  
                                <form action="{{ route('dosen.destroy', $item->id) }}" method="POST" class="inline">
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
        </div>
        <div class="mt-5">
            {{ $dosen->links() }}
        </div>
    </div>

    
</x-app-layout>