@extends('layouts.app')
@section('content')
    <main class="sd-main">
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
            coverall_type_id {{ $single->coverall_type_id }}
        </div>
        <div>
            status {{ $single->statusReadable }}
        </div>
        <div>
            size {{ $single->size }}
        </div>
        <div>
            date_issuance {{ $single->date_issuance }}
        </div>
        <div>
            date_replacement {{ $single->date_replacement }}
        </div>
        <div>
            contract_id {{ $single->contract_id }}
        </div>

        <a href="{{$urlEdit}}">
            Редактировать
        </a>
        <form method="POST" action="{{ $formActionDestroy }}">
            @csrf
            @method('DELETE')
            <button class="btn btn-primary">
                Удалить
            </button>
        </form>
    </main>
@endsection
