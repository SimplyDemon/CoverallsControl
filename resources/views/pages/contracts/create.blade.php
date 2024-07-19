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

        <form
            method="post"
            action="{{ $formActionCreate }}"
            enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="number">
                    Имя
                </label>
                <input class="form-control" type="text" name="number" id="number"
                       value="{{old('number','')}}">
            </div>

            <div class="form-group">
                <label for="date_conclusion">
                    Дата заключения
                </label>
                <input type="date" id="date_conclusion" name="date_conclusion" value="{{old('date_conclusion', '')}}">
            </div>
            <div class="form-group">
                <label for="date_delivery_documental">
                    Дата доставки документальная
                </label>
                <input type="date" id="date_delivery_documental" name="date_delivery_documental"
                       value="{{old('date_delivery_documental', '')}}">
            </div>
            <div class="form-group">
                <label for="date_delivery_actual">
                    date_delivery_actual
                </label>
                <input type="date" id="date_delivery_actual" name="date_delivery_actual"
                       value="{{old('date_delivery_actual', '')}}">
            </div>
            <div class="form-group">
                <label for="base_file">
                    Файл
                </label>
                <input class="form-control" type="file" name="base_file" id="base_file" value="">
            </div>

            <button class="btn btn-primary">
                Добавить
            </button>
        </form>
    </main>

@endsection
