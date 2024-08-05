@extends('layouts.app')
@section('content')
    <main class="sd-main container">
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
            <ul class="list-group">
                @foreach($coverallsInfo as $coverallInfo)
                    <li class="list-group-item">
                        <p>{{$coverallInfo['coverallType']->name}} <span
                                class="fw-bold">{{$coverallInfo['quantityHas']}}
                                /{{$coverallInfo['quantityNeed']}} </span>
                            Необходимо: {{$coverallInfo['quantityLacks']}}
                        </p>
                        @if($coverallInfo['sizes'])
                            <ul class="list-group">
                                @foreach($coverallInfo['sizes'] as $size => $coverallInfoSize)
                                    <li class="list-group-item">
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

        <form class="mb-3" method="post" action="{{ $formAction }}">
            @csrf
            <div class="form-group w-50 mb-3">
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
