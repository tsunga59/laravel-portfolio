<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    {{-- <link rel="shortcut icon" href="favicon.ico"> --}}
    
    <!-- Title -->
    <title>@yield('title') | {{ config('app.name') }}</title>

    <!-- CSS -->
    <link href="{{ asset('css/reset.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- JQuery -->
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>  
    <!-- JavaScript -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</body>

</html>

</head>
<body>
    <div id="app">
        <x-header></x-header>
        @yield('content')
    </div>

    <script>
        function confirmLogout() {
            window.confirm('本当にログアウトしてよろしいですか？');
        }
        function confirmDelete() {
            window.confirm('本当に削除してよろしいですか？');
        }
    </script>
</body>
</html>
