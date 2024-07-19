@extends('layouts.app')
@section('content')
    <main class="sd-main">
        <h1>
            {{ $title ?? 'Добавить' }}
        </h1>
        @if(session('error'))
            <div>
                {{ session('error') }}
            </div>
        @endif
        @if(session('messageLink') && session('messageText'))
            <div>
                <a href="{{session('messageLink')}}">{{ session('messageText')}}</a>
            </div>
        @endif

        <form method="post" action="{{ $formActionCreate }}">
            @csrf
            <div class="form-group">
                <label for="name">
                    Название
                </label>
                <input class="form-control" type="text" name="name" id="name" value="{{old('name','')}}">
            </div>

            <button class="btn btn-primary">
                Добавить
            </button>
        </form>

    </main>

@endsection
