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
            name_first {{ $single->name_first }}
        </div>
        <div>
            name_last {{ $single->name_last }}
        </div>
        <div>
            name_middle {{ $single->name_middle }}
        </div>
        <div>
            certificate_id {{ $single->certificate_id }}
        </div>
        <div>
            position_id {{ $single->position_id }}
        </div>
        <div>
            date_of_birth {{ $single->date_of_birth }}
        </div>
            <div>
                phone {{ $single->phone }}
            </div>
            <div>
                address_documental {{ $single->address_documental }}
            </div>
            <div>
                address_actual {{ $single->address_actual }}
            </div>
            <div>
                size_head {{ $single->size_head }}
            </div>
            <div>
                size_body {{ $single->size_body }}
            </div>
            <div>
                size_foot {{ $single->size_foot }}
            </div>
            <div>
                height {{ $single->height }}
            </div>
            <div>
                status {{ $single->status }}
            </div>
            <div>
                Изображение: <img src="{{asset('storage/' . $single->img)}}" width="100" height="100" alt="img">
            </div>
            <div>
                division_id {{ $single->division_id }}
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
