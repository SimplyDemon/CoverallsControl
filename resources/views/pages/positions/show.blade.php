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

        @if($single->coverallTypes)
            <div>
                <h4>Список нужной спецовки</h4>
                <ul class="list-group">
                    @foreach($single->coverallTypes as $coverallType)
                        <li class="list-group-item">
                            {{$coverallType->name}} x{{$coverallType->pivot->quantity}}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

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
