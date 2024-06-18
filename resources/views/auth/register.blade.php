<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="nama" :value="__('Nama')" />
            <x-text-input id="nama" class="block mt-1 w-full" type="text" name="nama" :value="old('nama')" required autofocus autocomplete="nama" />
            <x-input-error :messages="$errors->get('nama')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        {{-- <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full"
                          type="password"
                          name="password"
                          required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                          type="password"
                          name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div> --}}

        <!-- NPM -->
        <div class="mt-4">
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
        <div class="mt-4">
            <x-input-label for="kelas" :value="__('Kelas')" />
            <x-text-input id="kelas" class="block mt-1 w-full" type="text" name="kelas" :value="old('kelas')" required />
            <x-input-error :messages="$errors->get('kelas')" class="mt-2" />
        </div>

        <!-- Tahun Masuk -->
        <div class="mt-4">
            <x-input-label for="tahunmasuk" :value="__('Tahun Masuk')" />
            <x-text-input id="tahunmasuk" class="block mt-1 w-full" type="text" name="tahunmasuk" :value="old('tahunmasuk')" required />
            <x-input-error :messages="$errors->get('tahunmasuk')" class="mt-2" />
        </div>

        <!-- Role -->
        <div class="mt-4">
            <x-input-label for="role" :value="__('Role')" />
            <select id="role" name="role" class="block mt-1 w-full" required onchange="togglePraktikumField(this)">
                <option value="" disabled selected>{{ __('Select Role') }}</option>
                <option value="Mahasiswa">{{ __('Mahasiswa') }}</option>
                <option value="Ketua Lab">{{ __('Ketua Lab') }}</option>
                    <option value="Asisten Lab">{{ __('Asisten Lab') }}</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>
        
        <div class="mt-4" id="praktikumField" style="display: none;">
            <x-input-label for="praktikum_id" :value="__('Praktikum')" />
            <select id="praktikum_id" name="praktikum_id" class="block mt-1 w-full">
                @foreach ($praktikum as $item)
                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('praktikum_id')" class="mt-2" />
        </div>
        

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
    <script>
        function togglePraktikumField(select) {
            var praktikumField = document.getElementById('praktikumField');
            var praktikumIdField = document.getElementById('praktikum_id');
    
            if (select.value.startsWith('Asisten Lab')) {
                praktikumField.style.display = 'block';
                praktikumIdField.setAttribute('required', 'required');
            } else {
                praktikumField.style.display = 'none';
                praktikumIdField.removeAttribute('required');
            }
        }
    </script>
</x-guest-layout>
