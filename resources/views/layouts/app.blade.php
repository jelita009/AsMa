<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
    }

    header {
        background-color: #35424a;
        color: #ffffff;
        padding: 10px 0;
        text-align: center;
    }
    footer {
        background-color: #35424a;
        color: #ffffff;
        text-align: center;
        padding: 10px 0;
        position: fixed;
        bottom: 0;
        width: 100%;
    }
</style>
<body>

    {{-- <header>
        @if(Auth::check())
            <a href="{{ route('profile') }}" title="My Profile">Profile</a>
        @else
            <a href="{{ route('login') }}" title="Login">Login</a>
    </header>
    --}}

    <nav>
        <ul>
            <li><a href=" {{ route('home') }} ">Homepage</a></li>
            <li><a href=" {{ route('activity') }} ">Activity</a></li>
            <li><a href=" {{ route('aspiration') }} ">Aspiration</a></li>
            <li><a href=" {{ route('visitors') }} ">Graphic</a></li>
            <li><a href=" {{ route('about') }} ">About</a></li>
        </ul>
    </nav>

    @yield('content')

    <footer>
        <p>&copy; 2025 My Website</p>
    </footer>

</body>

</html>