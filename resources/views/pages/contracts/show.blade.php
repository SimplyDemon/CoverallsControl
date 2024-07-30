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
            number {{ $single->number }}
        </div>
        <div>
            date_conclusion {{ $single->date_conclusion }}
        </div>
        <div>
            date_delivery_documental {{ $single->date_delivery_documental }}
        </div>
            <div>
                date_delivery_actual {{ $single->date_delivery_actual }}
            </div>
            <div>
                file {{asset('storage/' . $single->file)}}
            </div>
            <div>
                status {{ $single->status }}
            </div>

            @if($single->coverallTypes)
                <div>
                    <h4>Список заказанной спецовки</h4>
                    @foreach($single->coverallTypes as $coverallType)
                        <div>
                            {{$coverallType->name}}. Размер: {{$coverallType->pivot->size}}. Доставлено:
                            [{{$coverallType->pivot->quantity_received}} / {{$coverallType->pivot->quantity_planned}}]
                        </div>
                    @endforeach
                </div>
            @endif

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
