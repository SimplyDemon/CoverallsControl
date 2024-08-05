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

        @if ($all)
            <ul class="list-group">

                @foreach($all as $single)
                    <li class="list-group-item">
                        <a href="{{ route( 'divisions.show', $single ) }}">
                            {{$single->name}}
                        </a>
                    </li>
                @endforeach

            </ul>

            <a class="btn btn-primary mt-3" href="{{ $buttonUrlAddNew }}">Добавить</a>
        @endif
    </main>
@endsection
