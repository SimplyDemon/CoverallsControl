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
            Номер {{ $single->number }}
        </div>
        <div>
            Дата заключения {{ $single->date_conclusion }}
        </div>
        <div>
            Дата доставки документальная {{ $single->date_delivery_documental }}
        </div>
        @if($single->date_delivery_actual)
            <div>
                Дата доставки фактическая {{ $single->date_delivery_actual }}
            </div>
        @endif
        <div>
            <a href="{{asset('storage/' . $single->file)}}">Файл</a>
        </div>
        <div>
            Статус {{ $single->status }}
        </div>

        @if($single->coverallTypes)
            <div>
                <h4>Список заказанной спецовки</h4>
                @foreach($single->coverallTypes as $coverallType)
                    <div>
                        <a href="{{route('coverall_types.show',$coverallType )}}"> {{$coverallType->name}}</a>.
                        Размер: {{$coverallType->pivot->size}}. {{$coverallType->pivot->quantity_planned}} ед.
                    </div>
                @endforeach
            </div>
        @endif

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
