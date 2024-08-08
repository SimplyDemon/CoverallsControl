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
                    <li class="list-group-item index-coverall-info ">
                        <div class="index-coveralls-info-top-list">
                            <div class="">{{$coverallInfo['coverallType']->name}} <span
                                    class="fw-bold">{{$coverallInfo['quantityHas']}}
                                    /{{$coverallInfo['quantityNeed']}} </span>
                                Необходимо: {{$coverallInfo['quantityLacks']}}
                                Можно выдать: {{$coverallInfo['quantityAvailable']}}
                            </div>

                            <div class="index-coveralls-info-top-list-right-side">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                     class="bi bi-question-circle {{$coverallInfo['tooltipInfo']['class']}}"
                                     viewBox="0 0 16 16"
                                     data-bs-toggle="tooltip" data-bs-placement="top"
                                     data-bs-custom-class="custom-tooltip"
                                     data-bs-title="{{$coverallInfo['tooltipInfo']['text']}}">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                    <path
                                        d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
                                </svg>
                                <button class="btn btn-primary m-lg-2" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#sd-js-collapse-coverall-type-id-{{$coverallInfo['coverallType']->id}}"
                                        aria-expanded="false"
                                        aria-controls="sd-js-collapse-coverall-type-id-{{$coverallInfo['coverallType']->id}}">
                                    Раскрыть
                                </button>
                            </div>
                        </div>
                        @if($coverallInfo['sizes'])
                            <ul class="list-group collapse mt-2"
                                id="sd-js-collapse-coverall-type-id-{{$coverallInfo['coverallType']->id}}">
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
