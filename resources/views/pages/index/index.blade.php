@extends('layouts.app')
@section('content')
    <main class="sd-main">
        <h1 class="">
            {{ $title }}
        </h1>
        @if(session('message'))
            <div>
                {{ session('message') }}
            </div>
        @endif

        <h4>Спецовка на состояние {{$dateFormatted}}</h4>
        @if($coverallsInfo)
            <ul>
                @foreach($coverallsInfo as $coverallInfo)
                    <li>
                        {{$coverallInfo['coverallType']->name}} {{$coverallInfo['quantityHas']}}
                        /{{$coverallInfo['quantityNeed']}} Необходимо: {{$coverallInfo['quantityLacks']}}

                        @if($coverallInfo['sizes'])
                            <ul>
                                @foreach($coverallInfo['sizes'] as $size => $coverallInfoSize)
                                    <li>
                                        Размер: {{$size}} Необходимо: {{$coverallInfoSize['lacks']}}
                                        Доступно: {{$coverallInfoSize['available']}}
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        @endif

        <form method="post" action="{{ $formAction }}">
            @csrf
            <div class="form-group">
                <label for="date">
                    Дата на которую необходимо рассчитать потребность
                </label>
                <input class="form-control" type="date" name="date" id="date" value="{{old('name',$dateForForm)}}">
            </div>

            <button class="btn btn-primary" name="submit" value="show">
                Показать
            </button>
            <button class="btn btn-primary" name="submit" value="report">
                Создать отчёт
            </button>
        </form>
    </main>
@endsection
