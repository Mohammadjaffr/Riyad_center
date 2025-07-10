<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}" />
    <title>@yield('title')</title>
    @vite(['resources/sass/app.scss','resources/js/app.js'])
    <meta name="description" content="مركز الرياض متخصص في بيع الملابس الرجالية الجاهزة، الأحذية، والبدلات. جودة عالية، أناقة، وخدمة متميزة.">
    <meta name="keywords" content="ملابس رجالية، أحذية رجالية، بدلات، أزياء رجالية، مركز الرياض، ملابس جاهزة رجالية">
    <meta name="author" content="مركز الرياض">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="مركز الرياض للملابس الرجالية الجاهزة والأحذية والبدلات">
    <meta property="og:description" content="مركز الرياض متخصص في بيع الملابس الرجالية الجاهزة، الأحذية، والبدلات. جودة عالية، أناقة، وخدمة متميزة.">
    <meta property="og:image" content="{{ asset('assets/images/logo.png') }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="مركز الرياض للملابس الرجالية الجاهزة والأحذية والبدلات">
    <meta name="twitter:description" content="مركز الرياض متخصص في بيع الملابس الرجالية الجاهزة، الأحذية، والبدلات. جودة عالية، أناقة، وخدمة متميزة.">
    <meta name="twitter:image" content="{{ asset('assets/images/logo.png') }}">
{{--    <link rel="stylesheet" href="{{asset('assets/css/custom-style.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('assets/css/fonts.css')}}">--}}
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <!-- FontAwesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
{{--    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />--}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
