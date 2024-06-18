<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/46db5e6224.js" crossorigin="anonymous"></script>
    <!-- <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> -->
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Styles -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap');
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Quicksand', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: #000;
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
            max-width: 1200px; /* max-width adjusted */
            background: #222;
            z-index: 1000;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
            border-radius: 4px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 9);
            overflow-x: auto; /* horizontal scroll added for smaller screens */
        }

        section .signin .content {
            width: 100%;
            overflow-x: auto; /* horizontal scroll added for smaller screens */
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px; /* margin added to separate from form */
        }

        .table th,
        .table td {
            border: 1px solid #0f0;
            padding: 8px;
            text-align: left;
        }
        .table td{
            color: white
        }
        .table th {
            background-color: #0f0;
            color: black;
            text-transform: uppercase;
        }
        /* 
        .table tr:nth-child(even) {
            background-color: #f9f9f9;
        } */

        /* .table tr:hover {
            background-color: #f1f1f1;
        } */

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

<body>
<section>
    @for($i = 0; $i < 150; $i++)
     <span></span>
    @endfor
    
     <div class="signin">
        
        <div class="content">
            
            <div class="flex justify-between items-center">
                <h1 class="text-center text-[#0f0] text-2xl font-bold">Jadwal Praktikum</h1>
                <a href="{{ route('login') }}" class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white text-2xl"><i class="fa-solid fa-right-to-bracket"></i></a>
            </div>
            <div class="p-2 mt-2 rounded-lg shadow-md">
                <form action="" method="GET">
                    <div class="flex items-center border rounded-lg overflow-hidden">
                        <input type="text" name="query" class="py-2 px-3 text-white leading-tight bg-transparent focus:outline-none w-full" placeholder="Search...">
                        <button type="submit" class="bg-[#0f0] hover:bg-[#00ff00e4] text-black py-2 px-4 rounded-r-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-5 h-5">
                                <path fill-rule="evenodd" d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>      
                  
            <table class="table">
                <thead>
                <tr class="">
                    <th scope="col">No</th>
                    <th scope="col">Nama Praktikum</th>
                    <th scope="col">Nama Dosen</th>
                    <th scope="col">Ruangan</th>
                    <th scope="col">Kelas</th>
                    <th scope="col">Hari</th>
                    <th scope="col">Waktu</th>
                    {{-- <th scope="col">Jam Beres</th> --}}
                    {{-- <th scope="col">Action</th> --}}
                </tr>
                </thead>
                <tbody>
                @forelse($jp as $index => $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->praktikum->nama }}</td>
                        <td>{{ $item->dosen->nama }}</td>
                        <td>{{ $item->ruangan }}</td>
                        <td>{{ $item->kelas }}</td>
                        <td>{{ $item->hari }}</td>
                        <td>{{ $item->jammulai }} - {{ $item->jamberes }}</td>
                    </tr>
                @empty
                    <tr>
                        @if (request('query') == true)
                        <td colspan="9" class="text-center">JADWAL UNTUK {{ request('query') }} BELUM ADA</td>
                        @else
                        <td colspan="9" class="text-center">JADWAL BELUM ADA</td>
                        @endif
                    </tr>
                @endforelse
                </tbody>
            </table>
            {{ $jp->links('vendor.pagination.custom') }}
        </div>
    </div>
</section>
</body>
</html>
