<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Address Book @yield('section')</title>

    <!-- Fonts -->
{{--    <link href="https://fonts.googleapis.com/css?family=Lato|Ubuntu:400,500,700&display=swap" rel="stylesheet">--}}

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body class="bg-gray-100">
@include ('partials._nav')
<div class="content m-auto sm:w-full md:w-1/2">
    <div id="app">
        @yield('content')
    </div>
</div>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
