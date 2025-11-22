<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>


    <header>        
        @if (
            !Auth::guard('admin')->check() &&
            !Auth::guard('dosen')->check() &&
            !Auth::guard('mahasiswa')->check() 
        )
            <a href="{{ route('login') }}" title="Login">Login</a>
        @else
            <a href="{{ route('profile') }}" title="My Profile">Profile</a>

            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" title="Logout">Logout</button>
        @endif
    </header>

    <nav>
        <ul>
            <li><a href=" {{ route('home') }} ">Homepage</a></li>
            <li><a href=" {{ route('activity') }} ">Activity</a></li>
            <li><a href=" {{ route('aspiration.store') }} ">Aspiration</a></li>
            <li><a href=" {{ route('visitors') }} ">Graphic</a></li>
            <li><a href=" {{ route('about') }} ">About</a></li>
        </ul>
    </nav>

    @yield('content')

    <footer>
        <p>&copy; 2025 Our Website</p>
    </footer>

</body>

</html>