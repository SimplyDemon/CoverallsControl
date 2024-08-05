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
                <label for="coverall_type_id">
                    Тип спецовки
                </label>
                <select class="form-select" name="coverall_type_id" id="coverall_type_id">
                    @foreach($coverallTypes as $coverallType)
                        <option value="{{$coverallType->id}}">
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
                       value="{{old('size','')}}">
            </div>
            <div class="form-group">
                <label for="status">
                    Статус
                </label>
                <select class="form-select" name="status" id="status">
                    @foreach($statuses as $statusKey => $statusValue)
                        <option value="{{$statusKey}}">
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
                        <option value="{{$contract->id}}">
                            {{$contract->number}}
                        </option>
                    @endforeach
                </select>
            </div>
            <button class="btn btn-primary  mt-3">
                Добавить
            </button>
        </form>
    </main>

@endsection
