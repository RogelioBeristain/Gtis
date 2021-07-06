<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>{{ config('app.name', 'Gtis - Sistema') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <link rel="apple-touch-icon" href="logo_icon.png">
    <link rel="icon" type="image/png" href="logo_icon.png" sizes="64x64">

    <link rel="manifest" href="/manifest.json">
    <link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon.png">

    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">

    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#4299b2">
    <meta name="msapplication-TileColor" content="#2b5797">

    <meta name="theme-color" content="#003aa5">


    <meta name="app-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="#003aa5" />
    <meta name="telephone=no" />
    <meta name="apple-mobile-web-app-title" content="Gtis" />


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://cdn.tiny.cloud/1/s1o4rspxb2335t2avlh7zjviqwagwbcec78fjsy06ciqhvn7/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>


    <script src="https://kit.fontawesome.com/4a0500928d.js" crossorigin="anonymous"></script>

    <script>
        const formatter = new Intl.NumberFormat('es-MX', {
  style: 'currency',
  currency: 'MXN',
  minimumFractionDigits: 2
})
    </script>

</head>

<body>
    <div id="app">
        @include('partials.navtop')


        <main class="py-4">
            @yield('content')
        </main>
        @include('partials.footer')
    </div>
</body>

</html>