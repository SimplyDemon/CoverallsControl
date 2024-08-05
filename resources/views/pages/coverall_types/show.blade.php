@extends('layouts.app')
@section('content')
    <main class="sd-main container">
        <h1>
            {{ $single->name }}
        </h1>
        @if(session('error'))
            <div>
                {{ session('error') }}
            </div>
        @endif
        @if(session('message'))
            <div>
                {{ session('message') }}
            </div>
        @endif

        <div>
            Тип: {{$single->typeReadable}}
        </div>
        <div>
            Срок годности (в месяцах): {{$single->term_life}}
        </div>
        <div>
            Изображение: <img src="{{asset('storage/' . $single->img)}}" width="100" height="100" alt="img">
        </div>

        <a href="{{$urlEdit}}">
            Редактировать
        </a>
        <form method="POST" action="{{ $formActionDestroy }}">
            @csrf
            @method('DELETE')
            <button class="btn btn-primary mt-3">
                Удалить
            </button>
        </form>
    </main>
@endsection
