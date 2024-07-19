@extends('layouts.app')
@section('content')
    <main class="sd-main">
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

        <form
            method="post"
            action="{{$formActionUpdate}}"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="number">
                    Имя
                </label>
                <input class="form-control" type="text" name="number" id="number"
                       value="{{old('number',$single->number)}}">
            </div>

            <div class="form-group">
                <label for="date_conclusion">
                    Дата заключения
                </label>
                <input type="date" id="date_conclusion" name="date_conclusion"
                       value="{{old('date_conclusion', $single->date_conclusion)}}">
            </div>
            <div class="form-group">
                <label for="date_delivery_documental">
                    Дата доставки документальная
                </label>
                <input type="date" id="date_delivery_documental" name="date_delivery_documental"
                       value="{{old('date_delivery_documental', $single->date_delivery_documental)}}">
            </div>
            <div class="form-group">
                <label for="date_delivery_actual">
                    date_delivery_actual
                </label>
                <input type="date" id="date_delivery_actual" name="date_delivery_actual"
                       value="{{old('date_delivery_actual', $single->date_delivery_actual)}}">
            </div>
            <div class="form-group">
                <label for="base_file">
                    Файл
                </label>
                file {{asset('storage/' . $single->file)}}
                <input class="form-control" type="file" name="base_file" id="base_file" value="">
            </div>

            <button class="btn btn-primary">
                Сохранить
            </button>
        </form>

    </main>

@endsection
