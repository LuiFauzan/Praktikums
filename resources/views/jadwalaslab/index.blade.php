<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Jadwal Praktikum') }}
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
                                Nama dosen
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama Asisten
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Ruangan
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Kelas
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Hari
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Jam Mulai
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Jam Beres
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($jadwalpraktikum as $index => $item)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $item->praktikum->nama }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $item->dosen->nama }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $item->user->nama }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $item->ruangan }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $item->kelas }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $item->hari }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $item->jammulai }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $item->jamberes }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                @if (auth()->user()->role == "Ketua Lab")
                                <div class="flex">
                                    <div class="mb-4 overflow-auto" x-data="{ openModal{{ $item->id }}: false }">
                                        <!-- Tombol untuk Membuka Modal -->
                                        <button x-on:click="openModal{{ $item->id }} = true" class="text-indigo-600 hover:text-indigo-900">
                                            Edit
                                        </button>
                                    
                                        <!-- Modal untuk Form Tambah Jadwal Praktikum -->
                                        <div x-show="openModal{{ $item->id }}" x-on:keydown.escape.window="openModal{{ $item->id }} = false" class="fixed top-0 left-0 w-full h-full py-10 px-10 bg-black bg-opacity-50 flex justify-center items-center">
                                            <!-- Modal Content -->
                                            <div class="bg-white overflow-y-auto rounded-lg p-8 max-w-3xl h-screen w-full">
                                                <h2 class="text-lg font-semibold mb-4">Tambah Jadwal Praktikum</h2>
                                    
                                                <!-- Form Tambah Jadwal Praktikum -->
                                                <form method="POST" action="{{ route('jadwalpraktikum.update',$item->id) }}" class="grid grid-cols-2 gap-x-4">
                                                    @csrf
                                                    <!-- Hari -->
                                                    @method('PUT')
                                                    <div class="col-span-2">
                                                        <x-input-label for="hari" :value="__('Hari')" />
                                                        <select id="hari" name="hari" class="block mt-1 w-full" required>
                                                            <option value="{{ $item->hari }}" @if(old('hari', $item->hari ?? '') == $item->hari) selected @endif>{{ $item->hari }}</option>
                                                            <option value="Senin" @if(old('hari') == 'Senin') selected @endif>Senin</option>
                                                            <option value="Selasa" @if(old('hari') == 'Selasa') selected @endif>Selasa</option>
                                                            <option value="Rabu" @if(old('hari') == 'Rabu') selected @endif>Rabu</option>
                                                            <option value="Kamis" @if(old('hari') == 'Kamis') selected @endif>Kamis</option>
                                                            <option value="Jumat" @if(old('hari') == 'Jumat') selected @endif>Jumat</option>
                                                            <option value="Sabtu" @if(old('hari') == 'Sabtu') selected @endif>Sabtu</option>
                                                        </select>
                                                        <x-input-error :messages="$errors->get('hari')" class="mt-2" />
                                                    </div>
                                                    
                                                    <!-- Hari -->
                                                    <div class="col-span-2">
                                                        <x-input-label for="tahunajaran" :value="__('Tahun Ajaran')" />
                                                        <select id="tahunajaran" name="tahunajaran" class="block mt-1 w-full" required>
                                                            <option value="" disabled selected>Pilih Tahun Ajaran</option>
                                                            <option value="{{ $item->tahunajaran }}" @if(old('tahunajaran', $item->tahunajaran ?? '') == $item->tahunajaran) selected @endif>{{ $item->tahunajaran }}</option>
                                                            <option value="2023-2024 Ganjil" @if(old('tahunajaran') == '2023-2024 Ganjil') selected @endif>2023-2024 Ganjil</option>
                                                            <option value="2023-2024 Genap" @if(old('tahunajaran') == '2023-2024 Genap') selected @endif>2023-2024 Genap</option>
                                                            <option value="2024-2025 Ganjil" @if(old('tahunajaran') == '2024-2025 Ganjil') selected @endif>2024-2025 Ganjil</option>
                                                            <option value="2024-2025 Genap" @if(old('tahunajaran') == '2024-2025 Genap') selected @endif>2024-2025 Genap</option>
                                                            <option value="2025-2026 Ganjil" @if(old('tahunajaran') == '2025-2026 Ganjil') selected @endif>2025-2026 Ganjil</option>
                                                            <option value="2025-2026 Genap" @if(old('tahunajaran') == '2025-2026 Genap') selected @endif>2025-2026 Genap</option>
                                                        </select>
                                                        <x-input-error :messages="$errors->get('tahunajaran')" class="mt-2" />
                                                    </div>
                    
                                                    <!-- Ruangan -->
                                                    <div class="col-span-2">
                                                        <x-input-label for="ruangan" :value="__('Ruangan')" />
                                                        <select id="ruangan" name="ruangan" class="block mt-1 w-full" required>
                                                            <option value="{{ $item->ruangan }}" @if(old('ruangan', $item->ruangan ?? '') == $item->ruangan) selected @endif>{{ $item->ruangan }}</option>
                                                            <option value="Lab-D301" @if(old('ruangan') == 'Lab-D301') selected @endif>Lab-D301</option>
                                                            <option value="Lab-D302" @if(old('ruangan') == 'Lab-D302') selected @endif>Lab-D302</option>
                                                            <option value="Lab-D201" @if(old('ruangan') == 'Lab-D201') selected @endif>Lab-D201</option>
                                                        </select>
                                                        <x-input-error :messages="$errors->get('ruangan')" class="mt-2" />
                                                    </div>
                                                    
                                    
                                                    <!-- Praktikum -->
                                                    <div class="col-span-2">
                                                        <x-input-label for="praktikum_id" :value="__('Praktikum')" />
                                                        <select id="praktikum_id" name="praktikum_id" class="block mt-1 w-full" required>
                                                            {{-- <option value="" disabled selected>Pilih Praktikum</option> --}}
                                                            {{-- @foreach ($praktikum as $p) --}}
                                                            {{-- <option value="{{ $p->id }}">{{ $p->nama }}</option> --}}
                                                            <option value="{{ $item->praktikum_id }}" @if(old('praktikum_id', $item->praktikum_id ?? '') == $item->praktikum_id) selected @endif>{{ $item->praktikum->nama }}</option>
                                                            {{-- @endforeach --}}
                                                        </select>
                                                        <x-input-error :messages="$errors->get('praktikum_id')" class="mt-2" />
                                                    </div>
                                                    {{-- Dosen --}}
                                                    <div class="col-span-2">
                                                        <x-input-label for="dosen_id" :value="__('Dosen')" />
                                                        <select id="dosen_id" name="dosen_id" class="block mt-1 w-full" required>
                                                            {{-- <option value="" disabled selected>Pilih Dosen</option> --}}
                                                            @foreach ($dosens as $dosen)
                                                            <option value="{{ $item->dosen_id }}" @if(old('dosen_id', $item->dosen_id ?? '') == $item->dosen_id) selected @endif>{{ $item->dosen->nama }}</option>
                                                                <option value="{{ $dosen->id }}" @if(old('dosen_id') == $dosen->id) selected @endif>{{ $dosen->nama }}</option>
                                                            @endforeach
                                                        </select>
                                                        <x-input-error :messages="$errors->get('dosen_id')" class="mt-2" />
                                                    </div>
                                                    {{-- Dosen --}}
                                                    <div class="col-span-2">
                                                        <x-input-label for="user_id" :value="__('Asisten Lab')" />
                                                        <select id="user_id" name="user_id" class="block mt-1 w-full" required>
                                                            {{-- <option value="" disabled selected>Pilih Dosen</option> --}}
                                                            @foreach ($users as $user)
                                                            <option value="{{ $item->user_id }}" @if(old('user_id', $item->user_id ?? '') == $item->user_id) selected @endif>{{ $item->user->nama }}</option>
                                                                <option value="{{ $user->id }}" @if(old('user_id') == $user->id) selected @endif>{{ $user->nama }}</option>
                                                            @endforeach
                                                        </select>
                                                        <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                                                    </div>
                                                    
                                                    <!-- Kelas -->
                                                    <div class="col-span-2">
                                                        <x-input-label for="kelas" :value="__('Kelas')" />
                                                        <x-text-input id="kelas" class="block mt-1 w-full" type="text" name="kelas" value="{{ $item->kelas }}" required />
                                                        <x-input-error :messages="$errors->get('kelas')" class="mt-2" />
                                                    </div>
                                    
                                                    <!-- Jam Mulai -->
                                                    <div class="col-span-2">
                                                        <x-input-label for="jammulai" :value="__('Jam Mulai')" />
                                                        <x-text-input id="jammulai" class="block mt-1 w-full" type="time" name="jammulai" value="{{ $item->jammulai }}" required />
                                                        <x-input-error :messages="$errors->get('jammulai')" class="mt-2" />
                                                    </div>
                                    
                                                    <!-- Jam Selesai -->
                                                    <div class="col-span-2">
                                                        <x-input-label for="jamberes" :value="__('Jam Selesai')" />
                                                        <x-text-input id="jamberes" class="block mt-1 w-full" type="time" name="jamberes" value="{{ $item->jamberes }}" required />
                                                        <x-input-error :messages="$errors->get('jamberes')" class="mt-2" />
                                                    </div>
                                    
                                                    <!-- Tombol Simpan dan Batal -->
                                                    <div class="col-span-2 flex justify-end mt-6">
                                                        <button type="button" x-on:click="openModal{{ $item->id }} = false" class="mr-2 px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 focus:outline-none">Batal</button>
                                                        <x-primary-button>
                                                            {{ __('Simpan') }}
                                                        </x-primary-button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <form action="{{ route('jadwalpraktikum.destroy', $item->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="confirmButton text-red-600 hover:text-red-900 ml-2">Delete</button>
                                    </form>
                                 </div>
                                @else
                                <div class="mb-4 overflow-auto" x-data="{ openModal{{ $item->id }}: false }">
                                    <!-- Tombol untuk Membuka Modal -->
                                    <button x-on:click="openModal{{ $item->id }} = true" class="text-indigo-600 hover:text-indigo-900">
                                        Edit
                                    </button>
                                
                                    <!-- Modal untuk Form Tambah Jadwal Praktikum -->
                                    <div x-show="openModal{{ $item->id }}" x-on:keydown.escape.window="openModal{{ $item->id }} = false" class="fixed top-0 left-0 w-full h-full py-10 px-10 bg-black bg-opacity-50 flex justify-center items-center">
                                        <!-- Modal Content -->
                                        <div class="bg-white overflow-y-auto rounded-lg p-8 max-w-3xl h-screen w-full">
                                            <h2 class="text-lg font-semibold mb-4">Tambah Jadwal Praktikum</h2>
                                
                                            <!-- Form Tambah Jadwal Praktikum -->
                                            <form method="POST" action="{{ route('jadwalpraktikum.update',$item->id) }}" class="grid grid-cols-2 gap-x-4">
                                                @csrf
                                                <!-- Hari -->
                                                @method('PUT')
                                                <div class="col-span-2">
                                                    <x-input-label for="hari" :value="__('Hari')" />
                                                    <select id="hari" name="hari" class="block mt-1 w-full" required>
                                                        <option value="{{ $item->hari }}" @if(old('hari', $item->hari ?? '') == $item->hari) selected @endif>{{ $item->hari }}</option>
                                                        <option value="Senin" @if(old('hari') == 'Senin') selected @endif>Senin</option>
                                                        <option value="Selasa" @if(old('hari') == 'Selasa') selected @endif>Selasa</option>
                                                        <option value="Rabu" @if(old('hari') == 'Rabu') selected @endif>Rabu</option>
                                                        <option value="Kamis" @if(old('hari') == 'Kamis') selected @endif>Kamis</option>
                                                        <option value="Jumat" @if(old('hari') == 'Jumat') selected @endif>Jumat</option>
                                                        <option value="Sabtu" @if(old('hari') == 'Sabtu') selected @endif>Sabtu</option>
                                                    </select>
                                                    <x-input-error :messages="$errors->get('hari')" class="mt-2" />
                                                </div>
                                                
                                                <!-- Hari -->
                                                <div class="col-span-2">
                                                    <x-input-label for="tahunajaran" :value="__('Tahun Ajaran')" />
                                                    <select id="tahunajaran" name="tahunajaran" class="block mt-1 w-full" required>
                                                        <option value="" disabled selected>Pilih Tahun Ajaran</option>
                                                        <option value="{{ $item->tahunajaran }}" @if(old('tahunajaran', $item->tahunajaran ?? '') == $item->tahunajaran) selected @endif>{{ $item->tahunajaran }}</option>
                                                        <option value="2023-2024 Ganjil" @if(old('tahunajaran') == '2023-2024 Ganjil') selected @endif>2023-2024 Ganjil</option>
                                                        <option value="2023-2024 Genap" @if(old('tahunajaran') == '2023-2024 Genap') selected @endif>2023-2024 Genap</option>
                                                        <option value="2024-2025 Ganjil" @if(old('tahunajaran') == '2024-2025 Ganjil') selected @endif>2024-2025 Ganjil</option>
                                                        <option value="2024-2025 Genap" @if(old('tahunajaran') == '2024-2025 Genap') selected @endif>2024-2025 Genap</option>
                                                        <option value="2025-2026 Ganjil" @if(old('tahunajaran') == '2025-2026 Ganjil') selected @endif>2025-2026 Ganjil</option>
                                                        <option value="2025-2026 Genap" @if(old('tahunajaran') == '2025-2026 Genap') selected @endif>2025-2026 Genap</option>
                                                    </select>
                                                    <x-input-error :messages="$errors->get('tahunajaran')" class="mt-2" />
                                                </div>
                
                                                <!-- Ruangan -->
                                                <div class="col-span-2">
                                                    <x-input-label for="ruangan" :value="__('Ruangan')" />
                                                    <select id="ruangan" name="ruangan" class="block mt-1 w-full" required>
                                                        <option value="{{ $item->ruangan }}" @if(old('ruangan', $item->ruangan ?? '') == $item->ruangan) selected @endif>{{ $item->ruangan }}</option>
                                                        <option value="Lab-D301" @if(old('ruangan') == 'Lab-D301') selected @endif>Lab-D301</option>
                                                        <option value="Lab-D302" @if(old('ruangan') == 'Lab-D302') selected @endif>Lab-D302</option>
                                                        <option value="Lab-D201" @if(old('ruangan') == 'Lab-D201') selected @endif>Lab-D201</option>
                                                    </select>
                                                    <x-input-error :messages="$errors->get('ruangan')" class="mt-2" />
                                                </div>
                                                
                                
                                                <!-- Praktikum -->
                                                <div class="col-span-2">
                                                    <x-input-label for="praktikum_id" :value="__('Praktikum')" />
                                                    <select id="praktikum_id" name="praktikum_id" class="block mt-1 w-full" required>
                                                        {{-- <option value="" disabled selected>Pilih Praktikum</option> --}}
                                                        {{-- @foreach ($praktikum as $p) --}}
                                                        {{-- <option value="{{ $p->id }}">{{ $p->nama }}</option> --}}
                                                        <option value="{{ $item->praktikum_id }}" @if(old('praktikum_id', $item->praktikum_id ?? '') == $item->praktikum_id) selected @endif>{{ $item->praktikum->nama }}</option>
                                                        {{-- @endforeach --}}
                                                    </select>
                                                    <x-input-error :messages="$errors->get('praktikum_id')" class="mt-2" />
                                                </div>
                                                {{-- Dosen --}}
                                                <div class="col-span-2">
                                                    <x-input-label for="dosen_id" :value="__('Dosen')" />
                                                    <select id="dosen_id" name="dosen_id" class="block mt-1 w-full" required>
                                                        {{-- <option value="" disabled selected>Pilih Dosen</option> --}}
                                                        @foreach ($dosens as $dosen)
                                                        <option value="{{ $item->dosen_id }}" @if(old('dosen_id', $item->dosen_id ?? '') == $item->dosen_id) selected @endif>{{ $item->dosen->nama }}</option>
                                                            <option value="{{ $dosen->id }}" @if(old('dosen_id') == $dosen->id) selected @endif>{{ $dosen->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                    <x-input-error :messages="$errors->get('dosen_id')" class="mt-2" />
                                                </div>
                                                {{-- Dosen --}}
                                                {{-- <div class="col-span-2">
                                                    <x-input-label for="user_id" :value="__('Asisten Lab')" />
                                                    <select id="user_id" name="user_id" class="block mt-1 w-full" required>
                                                        <option value="" disabled selected>Pilih Dosen</option>
                                                        @foreach ($users as $user)
                                                        <option value="{{ $item->user_id }}" @if(old('user_id', $item->user_id ?? '') == $item->user_id) selected @endif>{{ $item->user->nama }}</option>
                                                            <option value="{{ $user->id }}" @if(old('user_id') == $user->id) selected @endif>{{ $user->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                    <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                                                </div>
                                                 --}}
                                                 <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                                <!-- Kelas -->
                                                <div class="col-span-2">
                                                    <x-input-label for="kelas" :value="__('Kelas')" />
                                                    <x-text-input id="kelas" class="block mt-1 w-full" type="text" name="kelas" value="{{ $item->kelas }}" required />
                                                    <x-input-error :messages="$errors->get('kelas')" class="mt-2" />
                                                </div>
                                
                                                <!-- Jam Mulai -->
                                                <div class="col-span-2">
                                                    <x-input-label for="jammulai" :value="__('Jam Mulai')" />
                                                    <x-text-input id="jammulai" class="block mt-1 w-full" type="time" name="jammulai" value="{{ $item->jammulai }}" required />
                                                    <x-input-error :messages="$errors->get('jammulai')" class="mt-2" />
                                                </div>
                                
                                                <!-- Jam Selesai -->
                                                <div class="col-span-2">
                                                    <x-input-label for="jamberes" :value="__('Jam Selesai')" />
                                                    <x-text-input id="jamberes" class="block mt-1 w-full" type="time" name="jamberes" value="{{ $item->jamberes }}" required />
                                                    <x-input-error :messages="$errors->get('jamberes')" class="mt-2" />
                                                </div>
                                
                                                <!-- Tombol Simpan dan Batal -->
                                                <div class="col-span-2 flex justify-end mt-6">
                                                    <button type="button" x-on:click="openModal{{ $item->id }} = false" class="mr-2 px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 focus:outline-none">Batal</button>
                                                    <x-primary-button>
                                                        {{ __('Simpan') }}
                                                    </x-primary-button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endif
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
    {{ $jadwalpraktikum->links() }}
    
</x-app-layout>