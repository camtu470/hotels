<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <script src="//unpkg.com/alpinejs" defer></script>


    <style>
    body {
        font-family: 'Oswald', sans-serif !important;

    }

    .btn-save {
        background-color: #05561F;
        font-weight: 700;
        font-size: 16px;
        color: white;
        border-radius: 5px;
    }

    .btn-save:hover {
        background-color: #0a7a2e;
        color: white;
    }

    .btn-filter {
        background-color: #a9141e;
        font-weight: 700;
        font-size: 16px;
        color: white;
        border-radius: 5px;
    }

    .btn-filter:hover {
        background-color: #8D0F16;
        color: white;
    }

    .btn-back {
        background-color: #213448;
        font-weight: 700;
        font-size: 16px;
        color: white;
        border-radius: 5px;
    }

    .btn-back:hover {
        background-color: #273F4F;
        color: white;
    }
    </style>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="">
    <x-navbar />
    <main class="p-6">
        @yield('content')
    </main>
    <x-footer />

</html>