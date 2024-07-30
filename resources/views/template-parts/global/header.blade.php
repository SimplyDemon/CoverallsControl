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

<div>
    <ul>
        <li><a href="{{route('divisions.index')}}">Подразделения</a></li>
        <li><a href="{{route('coverall_types.index')}}">Виды спецовок</a></li>
        <li><a href="{{route('positions.index')}}">Должность</a></li>
        <li><a href="{{route('employers.index')}}">Работники</a></li>
        <li><a href="{{route('contracts.index')}}">Контракты</a></li>
        <li><a href="{{route('coveralls.index')}}">Спецовки</a></li>
    </ul>
</div>
