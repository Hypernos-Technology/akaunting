@props([
    'title',
])

<head>
    @stack('head_start')

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8; charset=ISO-8859-1"/>

    <title>{!! $title !!} - @setting('company.name')</title>

    <base href="{{ config('app.url') . '/' }}">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('public/img/favicon.ico') }}" type="image/png">

    <!-- Css -->
    <link rel="stylesheet" href="{{ asset('public/css/print.css') }}" type="text/css">

    <style>
        @font-face {
            font-family: 'firefly';
            src: url('{{ asset("/public/css/fonts/firefly_sung_normal.ttf") }}') format("truetype");
        }

        * {
            font-family: DejaVu Sans, sans-serif !important;
        }

        span[lang="zh"] {
            font-family: 'firefly', sans-serif !important;
        }
    </style>

    @stack('css')

    @stack('stylesheet')

    @livewireStyles

    @stack('js')

    @stack('scripts')

    @stack('head_end')
</head>
