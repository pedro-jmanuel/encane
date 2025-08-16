<!DOCTYPE html>
<html lang="pt-PT">
<head>

    <!-- Basic Page Needs
    ================================================== -->
    <meta charset="utf-8">

    <!-- Mobile Specific Metas
    ================================================== -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="{{ $meta_description ?? ''}}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="author" content="{{ $author ?? ''}}">
    <meta name="generator" content="{{ $generator ?? ''}}">

    <!-- Primary Meta Tags -->
    <title>{{ $meta_title ?? ''}}</title>
    <meta name="title" content="{{ $meta_title ?? ''}}">
    <meta name="description" content="{{ $meta_description ?? ''}}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ $meta_url ?? ''}}">
    <meta property="og:title" content="{{ $meta_title ?? ''}}">
    <meta property="og:description" content="{{ $meta_description ?? '' }}">
    @if(isset($meta_image))
        <meta property="og:image" itemprop="image" content="{{asset($meta_image) ?? ''}}">
    @endif
    <!-- Twitter -->
    <meta property="twitter:card"  content="summary_large_image">
    <meta property="twitter:url"   content="{{ $meta_url ?? ''}}">
    <meta property="twitter:title" content="{{ $meta_title ?? ''}}">
    <meta property="twitter:description" content="{{ $meta_description ?? ''}}">
    @if(isset($meta_image))
        <meta property="twitter:image"    itemprop="image"   content="{{asset($meta_image) ?? ''}}">
    @endif


    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('site.webmanifest')}}">


    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Saira:wght@500;600;700&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{asset('assets/site/lib/animate/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/site/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('assets/site/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{asset('assets/site/css/style.css')}}" rel="stylesheet">

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-ZS8CLBYW9J"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-ZS8CLBYW9J');
    </script>

</head>

<body>


        @include('site.includes.top_bar')

        @include('site.includes.nav_bar')

        @if (request()->is('/'))
                @include('site.includes.banner')
        @else
                @include('site.includes.banner_short')
        @endif

        @yield('content')


        @include('site.includes.footer')



        <!-- Back to Top -->
        <a href="#" class="btn btn-secondary btn-square rounded-circle back-to-top"><i class="fa fa-arrow-up text-white"></i></a>

        
        <!-- JavaScript Libraries -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{asset('assets/site/lib/wow/wow.min.js')}}"></script>
        <script src="{{asset('assets/site/lib/easing/easing.min.js')}}"></script>
        <script src="{{asset('assets/site/lib/waypoints/waypoints.min.js')}}"></script>
        <script src="{{asset('assets/site/lib/owlcarousel/owl.carousel.min.js')}}"></script>

        <!-- Template Javascript -->
        <script src="{{asset('assets/site/js/main.js')}}"></script>

</body>

</html>
