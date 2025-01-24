<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
  
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ResumeLive') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
	
    {{-- <style>
        /* Initial Sidebar Style */
        #sidebar {
            width: 250px;
            transition: all 0.3s ease;
        }

        #sidebar.mini-sidebar {
            width: 80px;
        }

        #sidebar.mini-sidebar .sidebar-menu li .hide-menu {
            display: none;
        }

        #sidebar.mini-sidebar .sidebar-item > a {
            padding-left: 10px;
        }

        #sidebar.mini-sidebar .sidebar-link {
            text-align: center;
        }
    </style> --}}
</head>
<body>
    <div id="app">
       

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>