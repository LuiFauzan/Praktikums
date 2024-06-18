<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <script src="https://kit.fontawesome.com/46db5e6224.js" crossorigin="anonymous"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')
            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset
            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        
        <script>
            document.addEventListener('DOMContentLoaded', function() {
            // Cek apakah ada pesan sukses dari session
            let successMessage = '{{ Session::get('success') }}';
            if (successMessage) {
                Swal.fire({
                    title: 'Sukses!',
                    text: successMessage,
                    icon: 'success',
                    timer: 5000,
                    timerProgressBar: true,
                    allowOutsideClick: true,  // Mengizinkan klik di luar popup
                    allowEscapeKey: true,     // Mengizinkan tombol escape
                    didDestroy: () => {
                        // Pemulihan atau pembersihan tambahan jika diperlukan
                    }
                });
            }

            // Cek apakah ada pesan error dari session
            let errorMessage = '{{ Session::get('error') }}';
            if (errorMessage) {
                Swal.fire({
                    title: 'Oops..',
                    text: errorMessage,
                    icon: 'error',
                    timer: 5000,
                    timerProgressBar: true,
                    allowOutsideClick: true,  // Mengizinkan klik di luar popup
                    allowEscapeKey: true,     // Mengizinkan tombol escape
                    didDestroy: () => {
                        // Pemulihan atau pembersihan tambahan jika diperlukan
                    }
                });
            }
            });
            document.addEventListener('DOMContentLoaded', function () {
                const confirmButtons = document.querySelectorAll('.confirmButton');
                confirmButtons.forEach(button => {
                    button.addEventListener('click', function (event) {
                        event.preventDefault();
                        const form = this.closest('form');
                        Swal.fire({
                            title: 'Apakah Anda yakin?',
                            text: "Data ini akan dihapus dan tidak bisa dikembalikan!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya, hapus!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            }
                        });
                    });
                });
            });
            document.addEventListener('DOMContentLoaded', function () {
                const confirmButtons = document.querySelectorAll('.setujuiButton');
                confirmButtons.forEach(button => {
                    button.addEventListener('click', function (event) {
                        event.preventDefault();
                        const form = this.closest('form');
                        Swal.fire({
                            title: 'Apakah Anda yakin untuk menyetujui pembayaran ini?',
                            text: "Data ini akan disetujui!",
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya, hapus!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            }
                        });
                    });
                });
            });
            document.addEventListener('DOMContentLoaded', function () {
                const confirmButtons = document.querySelectorAll('.tolakButton');
                confirmButtons.forEach(button => {
                    button.addEventListener('click', function (event) {
                        event.preventDefault();
                        const form = this.closest('form');
                        Swal.fire({
                            title: 'Apakah Anda yakin untuk menolak pembayaran ini?',
                            text: "Data ini akan ditolak!",
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya, hapus!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            }
                        });
                    });
                });
            });
            document.addEventListener('DOMContentLoaded', function () {
                const confirmButtons = document.querySelectorAll('.deleteButton');
                confirmButtons.forEach(button => {
                    button.addEventListener('click', function (event) {
                        event.preventDefault();
                        const form = this.closest('form');
                        Swal.fire({
                            title: 'Apakah Anda yakin untuk menghapus pembayaran ini?',
                            text: "Data ini akan dihapus!",
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya, hapus!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            }
                        });
                    });
                });
            });
        </script>
    </body>
</html>
