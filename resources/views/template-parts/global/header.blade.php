@php($currentRouteName = Route::currentRouteName())
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">

<div class="container" bis_skin_checked="1">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
            <svg class="bi me-2" width="40" height="32">
                <use xlink:href="#bootstrap"></use>
            </svg>
            <span class="fs-4">Главная</span>
        </a>

        <ul class="nav nav-pills">
            <li class="nav-item"><a href="{{route('divisions.index')}}"
                                    class="nav-link {{$currentRouteName === 'divisions.index' ? 'active' : ''}}"
                                    aria-current="page">Подразделения</a></li>
            <li class="nav-item"><a href="{{route('coverall_types.index')}}"
                                    class="nav-link {{$currentRouteName === 'coverall_types.index' ? 'active' : ''}}">Виды
                    спецовок</a></li>
            <li class="nav-item"><a href="{{route('positions.index')}}"
                                    class="nav-link {{$currentRouteName === 'positions.index' ? 'active' : ''}}">Должности</a>
            </li>
            <li class="nav-item"><a href="{{route('employers.index')}}"
                                    class="nav-link {{$currentRouteName === 'employers.index' ? 'active' : ''}}">Работники</a>
            </li>
            <li class="nav-item"><a href="{{route('contracts.index')}}"
                                    class="nav-link {{$currentRouteName === 'contracts.index' ? 'active' : ''}}">Контракты</a>
            </li>
            <li class="nav-item"><a href="{{route('coveralls.index')}}"
                                    class="nav-link {{$currentRouteName === 'coveralls.index' ? 'active' : ''}}">Спецовки</a>
            </li>
        </ul>
    </header>
</div>
