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

        @if ($all)
            <section class="">

                @foreach($all as $single)
                    <div class="">
                        <a href="{{ route( 'coveralls.show', $single ) }}">
                            {{$single->coverallType->name}} Размер: {{$single->size}}
                        </a>
                    </div>
                @endforeach

            </section>

            <section>
                <div>
                    <a href="{{ $buttonUrlAddNew }}">Добавить</a>
                </div>
            </section>
        @endif
    </main>
@endsection
