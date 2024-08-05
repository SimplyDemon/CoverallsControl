@extends('layouts.app')
@section('content')
    <main class="sd-main container">
        <h1>
            {{ $title ?? 'Редактировать' }}
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

        <form method="post" action="{{$formActionUpdate}}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">
                    Название
                </label>
                <input class="form-control" type="text" name="name" id="name" value="{{old('name',$single->name)}}">
            </div>

            <div class="form-group">
                <label for="coverall_type_id">
                    Родительское подразделение
                </label>
                <select class="form-select" name="division_id" id="division_id">
                    <option value="">
                        Нет
                    </option>
                    @foreach($divisions as $division)
                        <option value="{{$division->id}}" {{$division->id === $single->division_id ? 'selected' : ''}}>
                            {{$division->name}}
                        </option>
                    @endforeach
                </select>
            </div>

            <button class="btn btn-primary mt-3">
                Сохранить
            </button>
        </form>

    </main>

@endsection
