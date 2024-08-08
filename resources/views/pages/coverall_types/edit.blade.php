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
                <input class="form-control" type="text" name="name" id="name" value="{{old('name',$single->name)}}"
                       required>
            </div>
            <div class="form-group">
                <label for="type">
                    Тип
                </label>
                <select name="type" id="type" class="form-select" required>
                    @foreach($types as $typeKey => $typeValue)
                        <option value="{{$typeKey}}" {{$typeKey === $single->type ? 'selected' : ''}}>
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
                       value="{{old('term_life',$single->term_life)}}" required>
            </div>
            <img src="{{asset('storage/' . $single->img)}}" width="100" height="100" alt="img">
            <div class="form-group">
                <label for="image">
                    Фото
                </label>
                <input class="form-control" type="file" name="image" id="image" value="">
            </div>

            <button class="btn btn-primary mt-3">
                Сохранить
            </button>
        </form>

    </main>

@endsection
