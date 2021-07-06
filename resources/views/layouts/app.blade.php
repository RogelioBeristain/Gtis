

<!DOCTYPE html>
<html lang="es">

<head>

    <link rel="icon" type="image/png" href="{{ asset('paper') }}/img/gtis-logo.png">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <!-- Extra details for Live View on GitHub Pages -->
    <!-- Canonical SEO -->

<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-166206181-1');
</script>
 
  <title>{{ config('app.name', 'Gtis - Sistema') }}</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />

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
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <!-- CSS Files -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
      integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  {{--   <link href="{{ asset('paper') }}/css/bootstrap.min.css" rel="stylesheet" />
    --}} <link href="{{ asset('paper') }}/css/paper-dashboard.css?v=2.0.0" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="{{ asset('paper') }}/demo/demo.css" rel="stylesheet" />

  {{--   <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-NKDMSK6');</script>
    <!-- End Google Tag Manager --> --}}
</head>

<body class="{{ $class }}">
    <div id="app">
        {{--    <!-- Google Tag Manager (noscript) -->
            <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKDMSK6"
                height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
            <!-- End Google Tag Manager (noscript) -->
             --}}
        @auth()
        @include('layouts.page_templates.auth')
        @include('layouts.navbars.fixed-plugin')
        @endauth
        
        @guest
        @include('layouts.page_templates.guest')
        @endguest
        
        <!--   Core JS Files   -->
{{--        <script src="{{ asset('paper') }}/js/core/jquery.min.js"></script>
        <script src="{{ asset('paper') }}/js/core/popper.min.js"></script>
        <script src="{{ asset('paper') }}/js/core/bootstrap.min.js"></script>
    --}} {{--     <script src="{{ asset('paper') }}/js/plugins/perfect-scrollbar.jquery.min.js"></script>
        --}}<!--  Google Maps Plugin    -->
   {{--   <script src="{{ asset('paper') }}/js/core/jquery.min.js"></script>
      
       <script src="{{ asset('paper') }}/js/core/popper.min.js"></script>
       <script src="{{ asset('paper') }}/js/core/bootstrap.min.js"></script> --}}
 {{--    <script src="{{ asset('paper') }}/js/plugins/perfect-scrollbar.jquery.min.js"></script>
      --}}
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 {{--      <script src="{{ asset('paper') }}/js/plugins/perfect-scrollbar.jquery.min.js"></script> 
      --}} <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
        <!-- Chart JS -->
        <script src="{{ asset('paper') }}/js/plugins/chartjs.min.js"></script>
        <!--  Notifications Plugin    -->
        <script src="{{ asset('paper') }}/js/plugins/bootstrap-notify.js"></script>
        <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
        <script src="{{ asset('paper') }}/js/paper-dashboard.min.js" type="text/javascript"></script>
        <!-- Paper Dashboard DEMO methods, don't include it in your project! -->
        <script src="{{ asset('paper') }}/demo/demo.js"></script>
        <!-- Sharrre libray -->
        {{--  <script src="../assets/demo/jquery.sharrre.js"></script> --}}
        <script src="{{ asset('paper') }}/demo/jquery.sharrre.js"></script>
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
     @stack('scripts')
     
        @include('layouts.navbars.fixed-plugin-js')
    </div>

</body>

</html>
