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

        <form
            method="post"
            action="{{$formActionUpdate}}"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="coverall_type_id">
                    Тип спецовки
                </label>
                <select class="form-select" name="coverall_type_id" id="coverall_type_id">
                    @foreach($coverallTypes as $coverallType)
                        <option
                            value="{{$coverallType->id}}" {{$coverallType->id === $single->coverall_type_id ? 'selected' : ''}}>
                            {{$coverallType->name}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="size">
                    Размер
                </label>
                <input class="form-control" type="number" name="size" id="size"
                       value="{{old('size',$single->size)}}">
            </div>
            <div class="form-group">
                <label for="status">
                    Статус
                </label>
                <select class="form-select" name="status" id="status">
                    @foreach($statuses as $statusKey => $statusValue)
                        <option value="{{$statusKey}}" {{$statusKey === $single->status ? 'selected' : ''}}>
                            {{$statusValue}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="contract_id">
                    Контракт
                </label>
                <select class="form-select" name="contract_id" id="contract_id">
                    @foreach($contracts as $contract)
                        <option value="{{$contract->id}}" {{$contract->id === $single->contract_id ? 'selected' : ''}}>
                            {{$contract->number}}
                        </option>
                    @endforeach
                </select>
            </div>

            <button class="btn btn-primary">
                Сохранить
            </button>
        </form>

    </main>

@endsection
