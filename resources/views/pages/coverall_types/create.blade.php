@extends('layouts.app')
@section('content')
    <main class="sd-main container">
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

        <form
            method="post"
            action="{{ $formActionCreate }}"
            enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">
                    Название
                </label>
                <input class="form-control" type="text" name="name" id="name" value="{{old('name','')}}" required>
            </div>
            <div class="form-group">
                <label for="type">
                    Тип
                </label>
                <select class="form-select" name="type" id="type" required>
                    @foreach($types as $typeKey => $typeValue)
                        <option value="{{$typeKey}}">
                            {{$typeValue}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="term_life">
                    Срок годности (в месяцах)
                </label>
                <input class="form-control" type="number" name="term_life" id="term_life"
                       value="{{old('term_life','')}}" required>
            </div>
            <div class="form-group">
                <label for="image">
                    Фото
                </label>
                <input class="form-control" type="file" name="image" id="image" value="" required>
            </div>

            <button class="btn btn-primary mt-3">
                Добавить
            </button>
        </form>

    </main>

@endsection
