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
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap');
            * {
                margin: 0;
                padding: 0;
                /* box-sizing: border-box; */
                font-family: 'Quicksand', sans-serif;
            }
    
            body {
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
                background: #000;
                width: 100%;
            }
    
            section {
                position: absolute;
                width: 100vw;
                height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
                gap: 2px;
                flex-wrap: wrap;
                overflow: hidden;
            }
    
            section::before {
                content: '';
                position: absolute;
                width: 100%;
                height: 100%;
                background: linear-gradient(#000, #0f0, #000);
                animation: animate 5s linear infinite;
            }
    
            @keyframes animate {
                0% {
                    transform: translateY(-100%);
                }
    
                100% {
                    transform: translateY(100%);
                }
            }
    
            section span {
                position: relative;
                display: block;
                width: calc(6.25vw - 2px);
                height: calc(6.25vw - 2px);
                background: #181818;
                z-index: 2;
                transition: 1.5s;
            }
    
            section span:hover {
                background: #0f0;
                transition: 0s;
            }
    
            section .signin {
                position: absolute;
                width: 100%;
                 /* max-width adjusted */
                background:transparent;
                z-index: 1000;
                /* display: flex; */
                justify-content: center;
                align-items: center;
                /* padding: 40px;
                border-radius: 4px; */
                box-shadow: 0 15px 35px rgba(0, 0, 0, 9);
                overflow-x: auto; /* horizontal scroll added for smaller screens */
            }
    
            section .signin{
                width: 100%;
                height: 100%;
                overflow-x: auto; /* horizontal scroll added for smaller screens */
            }
    
            @media (max-width: 900px) {
                section span {
                    width: calc(10vw - 2px);
                    height: calc(10vw - 2px);
                }
            }
    
            @media (max-width: 600px) {
                section span {
                    width: calc(20vw - 2px);
                    height: calc(20vw - 2px);
                }
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <section>
            @for($i = 0; $i < 150; $i++)
            <span></span>
           @endfor
           <div class="signin w-screen">
            @include('layouts.navigation')
            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="w-full mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
           </div>
        </section>
        
<script>
            document.addEventListener('DOMContentLoaded', function () {
            const loadingSpinner = document.getElementById('loading-spinner');

            // Menunjukkan spinner saat halaman dimuat
                window.addEventListener('beforeunload', function () {
                    loadingSpinner.style.display = 'flex';
                });

                // Sembunyikan spinner setelah halaman dimuat sepenuhnya
                window.addEventListener('load', function () {
                    loadingSpinner.style.display = 'none';
                });
            });

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
