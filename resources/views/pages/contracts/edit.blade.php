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
                    Номер
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
                @if($single->coverallTypes)
                    @foreach($single->coverallTypes as $existedCoverallType)
                        <div class="sd-js-repeater-source">
                            <select class="form-control" name="coverall_types_ids[]">
                                @foreach($coverallTypes as $coverallType)
                                    <option value="{{$coverallType->id}}"
                                            @if ($coverallType->id === $existedCoverallType->id) selected @endif
                                    >
                                        {{$coverallType->name}}
                                    </option>
                                @endforeach
                            </select>
                            Количество
                            <input class="form-control" type="number" name="quantities_planned[]"
                                   value="{{$existedCoverallType->pivot->quantity_planned}}" min="1">
                            Размер
                            <input class="form-control" type="number" name="sizes[]"
                                   value="{{$existedCoverallType->pivot->size}}" min="1">
                        </div>
                    @endforeach

                @else
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
                @endif

            </div>

            <button class="btn btn-primary">
                Сохранить
            </button>
        </form>

    </main>

@endsection
