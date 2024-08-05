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
            Имя {{ $single->name_first }}
        </div>
        <div>
            Фамилия {{ $single->name_last }}
        </div>
        <div>
            Отчество {{ $single->name_middle }}
        </div>
        <div>
            Номер удостоверения {{ $single->certificate_id }}
        </div>
        <div>
            Должность {{ $single->position->name }}
        </div>
        <div>
            Дата рождения {{ $single->date_of_birth }}
        </div>
        <div>
            Телефон {{ $single->phone }}
        </div>
        <div>
            Адрес прописки {{ $single->address_documental }}
        </div>
        <div>
            Адрес проживания {{ $single->address_actual }}
        </div>
        <div>
            Размер головы {{ $single->size_head }}
        </div>
        <div>
            Размер тела {{ $single->size_body }}
        </div>
        <div>
            Размер обуви {{ $single->size_foot }}
        </div>
        <div>
            Размер лица {{ $single->size_face }}
        </div>
        <div>
            Размер перчаток {{ $single->size_gloves }}
        </div>
        <div>
            Высота {{ $single->height }}
        </div>
        <div>
            Статус {{ $single->status }}
        </div>
        <div>
            Изображение: <img src="{{asset('storage/' . $single->img)}}" width="100" height="100" alt="img">
        </div>
        <div>
            Подразделение {{ $single->division->name }}
        </div>

        <a class="btn btn-primary mt-3" href="{{$urlEdit}}">
            Редактировать
        </a>
        <form method="POST" action="{{ $formActionDestroy }}">
            @csrf
            @method('DELETE')
            <button class="btn btn-primary  mt-3">
                Удалить
            </button>
        </form>
    </main>
@endsection
