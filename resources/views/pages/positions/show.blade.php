@extends('layouts.app')
@section('content')
    <main class="sd-main">
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
                @foreach($single->coverallTypes as $coverallType)
                    <div>
                        {{$coverallType->name}} x{{$coverallType->pivot->quantity}}
                    </div>
                @endforeach
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
