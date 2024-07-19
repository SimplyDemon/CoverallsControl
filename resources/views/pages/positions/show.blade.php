@extends('layouts.app')
@section('content')
    <main class="sd-main">
        <h1>
            {{ $single->name }}
        </h1>

        @if(session('message'))
            <div>
                {{ session('message') }}
            </div>
        @endif

        <a href="{{$urlEdit}}">
            Редактировать
        </a>
        <form method="POST" action="{{ $formActionDestroy }}">
            @csrf
            @method('DELETE')
            <button class="btn btn-primary">
                Удалить
            </button>
        </form>
    </main>
@endsection
