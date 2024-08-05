@extends('layouts.app')
@section('content')
    <main class="sd-main container">
        <h1>
            {{ $single->name }}
        </h1>

        @if(session('message'))
            <div>
                {{ session('message') }}
            </div>
        @endif
        @if($single->division)
            <div>
                Родительское подразделение: <a
                    href="{{route('divisions.show', $single->division)}}">{{$single->division->name}}</a>
            </div>
        @endif

        <a class="btn btn-primary mt-3" href="{{$urlEdit}}">
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
