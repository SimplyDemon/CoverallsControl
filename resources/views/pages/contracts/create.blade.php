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
                <label for="number">
                    Номер
                </label>
                <input class="form-control" type="text" name="number" id="number"
                       value="{{old('number','')}}">
            </div>

            <div class="form-group">
                <label for="date_conclusion">
                    Дата заключения
                </label>
                <input class="form-control" type="date" id="date_conclusion" name="date_conclusion"
                       value="{{old('date_conclusion', '')}}">
            </div>
            <div class="form-group">
                <label for="date_delivery_documental">
                    Дата доставки документальная
                </label>
                <input class="form-control" type="date" id="date_delivery_documental" name="date_delivery_documental"
                       value="{{old('date_delivery_documental', '')}}">
            </div>
            <div class="form-group">
                <label for="date_delivery_actual">
                    Дата доставки фактическая
                </label>
                <input class="form-control" type="date" id="date_delivery_actual" name="date_delivery_actual"
                       value="{{old('date_delivery_actual', '')}}">
            </div>
            <div class="form-group">
                <label for="base_file">
                    Файл
                </label>
                <input class="form-control" type="file" name="base_file" id="base_file" value="">
            </div>

            <div class="form-group sd-js-repeater-target">
                <label for="coverall_types">
                    Список заказываемой спецовки
                </label>
                <input
                    class="form-control sd-js-repeater-button"
                    data-repeater-class-source='sd-js-repeater-source'
                    data-repeater-class-target='sd-js-repeater-target'
                    type="button"
                    value="Добавить ещё вид спецовки"
                >
                <div class="sd-js-repeater-source">
                    <select class="form-control" name="coverall_types_ids[]">
                        @foreach($coverallTypes as $coverallType)
                            <option value="{{$coverallType->id}}">
                                {{$coverallType->name}}
                            </option>
                        @endforeach
                    </select>
                    Количество
                    <input class="form-control" type="number" name="quantities_planned[]" value="1" min="1">
                    Размер
                    <input class="form-control" type="number" name="sizes[]" value="1" min="1">
                </div>
            </div>

            <button class="btn btn-primary">
                Добавить
            </button>
        </form>
    </main>

@endsection
