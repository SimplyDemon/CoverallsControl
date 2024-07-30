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

        <form method="post" action="{{$formActionUpdate}}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">
                    Название
                </label>
                <input class="form-control" type="text" name="name" id="name" value="{{old('name',$single->name)}}">
            </div>

            <div class="form-group sd-js-repeater-target">
                <label for="coverall_types">
                    Список нужной спецовки
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
                                <option value="" selected>
                                    Нет необходимости в спецовке
                                </option>
                                @foreach($coverallTypes as $coverallType)
                                    <option value="{{$coverallType->id}}"
                                            @if ($coverallType->id === $existedCoverallType->id) selected @endif
                                    >
                                        {{$coverallType->name}}
                                    </option>
                                @endforeach
                            </select>
                            <input class="form-control" type="number" name="quantities[]"
                                   value="{{$existedCoverallType->pivot->quantity}}" min="1">
                        </div>
                    @endforeach

                @else
                    <div class="form-group sd-js-repeater-target">
                        <label for="coverall_types">
                            Список нужной спецовки
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
                                <option value="" selected>
                                    Нет необходимости в спецовке
                                </option>
                                @foreach($coverallTypes as $coverallType)
                                    <option value="{{$coverallType->id}}">
                                        {{$coverallType->name}}
                                    </option>
                                @endforeach
                            </select>
                            <input class="form-control" type="number" name="quantities[]"
                                   value="1" min="1">
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
