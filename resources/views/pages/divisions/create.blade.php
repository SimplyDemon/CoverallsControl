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
            <div class="form-group">
                <label for="coverall_type_id">
                    Родительское подразделение
                </label>
                <select name="division_id" id="division_id">
                    <option value="">
                        Родительское подразделение
                    </option>
                    @foreach($divisions as $division)
                        <option value="{{$division->id}}">
                            {{$division->name}}
                        </option>
                    @endforeach
                </select>
            </div>

            <button class="btn btn-primary">
                Добавить
            </button>
        </form>

    </main>

@endsection
