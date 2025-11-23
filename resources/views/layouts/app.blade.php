<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Mengatur font agar terlihat lebih bersih dan modern */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f7f7f7;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .header-bg {
            background-color: #332244;
        }

        .footer-bg {
            background-color: #241A33;
        }

        .text-light {
            color: #d1d5db;
        }
    </style>
    <!-- Ikon untuk Footer (Font Awesome) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>

    <header class="header-bg shadow-lg">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">

                <!-- Kumpulan Menu Navigasi (Rata Kiri) -->
                <nav class="flex space-x-4 md:space-x-8">
                    <!-- Navigasi utama dari list <ul> Anda -->
                    <a href="{{ route('home') }}" class="text-light hover:text-white transition duration-200 p-2 rounded-lg">Home</a>
                    <a href="{{ route('about') }}" class="text-light hover:text-white transition duration-200 p-2 rounded-lg">Tentang</a>
                    <a href="{{ route('aspiration.store') }}" class="text-light hover:text-white transition duration-200 p-2 rounded-lg">Aspirasi</a>
                    <a href="{{ route('activity') }}" class="text-light hover:text-white transition duration-200 p-2 rounded-lg">Activity</a>
                    <a href="{{ route('visitors') }}" class="text-light hover:text-white transition duration-200 p-2 rounded-lg">Graphic</a>

                    <!-- Link Admin (hanya muncul jika admin login) -->
                    @if(Auth::guard('admin')->check())
                    <a href="{{ route('admin.index') }}" class="text-light hover:text-white transition duration-200 p-2 rounded-lg font-semibold bg-indigo-600/30">Kelola Aspirasi</a>
                    @endif
                    @if(Auth::guard('admin')->check())
                    <a href="{{ route('admin.reports.index') }}" class="text-light hover:text-white transition duration-200 p-2 rounded-lg font-semibold bg-indigo-600/30">Laporan Aspirasi</a>
                    @endif
                </nav>


                <!-- Tombol Aksi (Rata Kanan) -->
                <div class="flex items-center space-x-4">
                    @if (!Auth::guard('admin')->check() && !Auth::guard('dosen')->check() && !Auth::guard('mahasiswa')->check())
                    <!-- Tombol Login/Masuk -->
                    <a href="{{ route('login') }}"
                        class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition duration-200 shadow-md"
                        title="Login">
                        Login
                    </a>
                    @else
                    <!-- Tombol Profile -->
                    <a href="{{ route('profile') }}"
                        class="text-light hover:text-white transition duration-200 p-2 rounded-lg"
                        title="My Profile">
                        Profile
                    </a>

                    <!-- Tombol Logout -->
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit"
                            class="px-4 py-2 text-sm font-medium text-red-100 bg-red-600/70 rounded-lg hover:bg-red-700 transition duration-200 shadow-md"
                            title="Logout">
                            Logout
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </header>

    <main class="flex-grow">
        @yield('content')
    </main>

    <footer class="footer-bg py-8 mt-auto">
        <p class="text-sm text-gray-400 text-center">&copy; 2025 Our Website - Aspirasi Mahasiswa. All rights reserved.</p>
    </footer>

</body>

</html>