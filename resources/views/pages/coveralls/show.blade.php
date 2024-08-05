@extends('layouts.app')
@section('content')
    <main class="sd-main container">
        @if(session('error'))
            <div>
                {{ session('error') }}
            </div>
        @endif
        @if(session('message'))
            <div>
                {{ session('message') }}
            </div>
        @endif
        <div>
            {{ $single->coverallType->name }}
        </div>
        <div>
            Статус {{ $single->statusReadable }}
        </div>
        <div>
            Размер {{ $single->size }}
        </div>
        @if($single->date_issuance)
            <div>
                Дата выдачи {{ $single->date_issuance }}
            </div>
        @endif
        @if($single->date_replacement)
            <div>
                Дата замены {{ $single->date_replacement }}
            </div>
        @endif
        <div>
            Контракт <a href="{{route('contracts.show',$single->contract )}}">{{ $single->contract->number }}</a>
        </div>

        <a class="btn btn-primary mt-3" href="{{$urlEdit}}">
            Редактировать
        </a>
        <form method="POST" action="{{ $formActionDestroy }}">
            @csrf
            @method('DELETE')
            <button class="btn btn-primary mt-3">
                Удалить
            </button>
        </form>
    </main>
@endsection
