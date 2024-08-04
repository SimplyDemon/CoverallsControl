@extends('layouts.app')
@section('content')
    <main class="sd-main">
        <h1>
            {{ $title ?? 'Редактировать' }}
        </h1>
        @if(session('error'))
            <div>
                {{ session('error') }}
            </div>
        @endif
        @if(session('messageLink') && session('messageText'))
            <div>
                <a href="{{session('messageLink')}}">{{ session('messageText')}}</a>
            </div>
        @endif

        <form
            method="post"
            action="{{$formActionUpdate}}"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name_first">
                    Имя
                </label>
                <input class="form-control" type="text" name="name_first" id="name_first"
                       value="{{old('name_first',$single->name_first)}}">
            </div>

            <div class="form-group">
                <label for="name_last">
                    Фамилия
                </label>
                <input class="form-control" type="text" name="name_last" id="name_last"
                       value="{{old('name_last',$single->name_last)}}">
            </div>

            <div class="form-group">
                <label for="name_middle">
                    Отчество
                </label>
                <input class="form-control" type="text" name="name_middle" id="name_middle"
                       value="{{old('name_middle',$single->name_middle)}}">
            </div>
            <div class="form-group">
                <label for="certificate_id">
                    Номер удостоверения
                </label>
                <input class="form-control" type="text" name="certificate_id" id="certificate_id"
                       value="{{old('certificate_id',$single->certificate_id)}}">
            </div>
            <div class="form-group">
                <label for="date_of_birth">
                    Дата рождения
                </label>
                <input type="date" id="date_of_birth" name="date_of_birth"
                       value="{{old('date_of_birth',$single->date_of_birth)}}">
            </div>

            <div class="form-group">
                <label for="phone">
                    Телефон
                </label>
                <input class="form-control" type="text" name="phone" id="phone" value="{{old('phone',$single->phone)}}">
            </div>
            <div class="form-group">
                <label for="address_documental">
                    Адрес прописки
                </label>
                <input class="form-control" type="text" name="address_documental" id="address_documental"
                       value="{{old('address_documental',$single->address_documental)}}">
            </div>
            <div class="form-group">
                <label for="address_actual">
                    Адрес проживания
                </label>
                <input class="form-control" type="text" name="address_actual" id="address_actual"
                       value="{{old('address_actual',$single->address_actual)}}">
            </div>
            <div class="form-group">
                <label for="size_head">
                    Размер головы
                </label>
                <input class="form-control" type="number" name="size_head" id="size_head"
                       value="{{old('size_head',$single->size_head)}}">
            </div>
            <div class="form-group">
                <label for="size_body">
                    Размер тела
                </label>
                <input class="form-control" type="number" name="size_body" id="size_body"
                       value="{{old('size_body',$single->size_body)}}">
            </div>
            <div class="form-group">
                <label for="size_foot">
                    Размер обуви
                </label>
                <input class="form-control" type="number" name="size_foot" id="size_foot"
                       value="{{old('size_foot',$single->size_foot)}}">
            </div>
            <div class="form-group">
                <label for="size_face">
                    Размер лица
                </label>
                <input class="form-control" type="number" name="size_face" id="size_face"
                       value="{{old('size_face',$single->size_face)}}">
            </div>
            <div class="form-group">
                <label for="size_gloves">
                    Размер перчаток
                </label>
                <input class="form-control" type="number" name="size_gloves" id="size_gloves"
                       value="{{old('size_gloves',$single->size_gloves)}}">
            </div>
            <div class="form-group">
                <label for="height">
                    Высота
                </label>
                <input class="form-control" type="number" name="height" id="height"
                       value="{{old('height',$single->height)}}">
            </div>
            <div class="form-group">
                <label for="division_id">
                    Подразделение
                </label>
                <select name="division_id" id="division_id">
                    @foreach($divisions as $division)
                        <option value="{{$division->id}}" {{$division->id === $single->divison_id ? 'selected' : ''}}>
                            {{$division->name}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="position_id">
                    Должность
                </label>
                <select name="position_id" id="position_id">
                    @foreach($positions as $position)
                        <option value="{{$position->id}}" {{$position->id === $single->position_id ? 'selected' : ''}}>
                            {{$position->name}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="image">
                    Фото
                </label>
                <img src="{{asset('storage/' . $single->img)}}" width="100" height="100" alt="img">
                <input class="form-control" type="file" name="image" id="image" value="">
            </div>

            @if($coverallTypesInfo)
                <div>
                    <h4>Информация о спецовке</h4>
                    @foreach($coverallTypesInfo as $coverallType)
                        <div>
                            {{$coverallType->name}} {{$coverallType->quantityHas}}/{{$coverallType->quantityNeed}}
                            Просрочено: {{$coverallType->quantityOverdue}}
                        </div>
                    @endforeach
                </div>
            @endif
            @if($single->coveralls)
                <div>
                    <h4>Список выданной спецовки</h4>
                    @foreach($single->coveralls as $employerCoverall)
                        <div>
                            {{$employerCoverall->coverallType->name}}
                        </div>
                    @endforeach
                </div>
            @endif
            @if($employerAvailableCoveralls)
                <div>
                    <h4>Список доступной спецовки</h4>
                    @foreach($employerAvailableCoveralls as $employerAvailableCoverall)
                        <div>
                            <label>{{$employerAvailableCoverall['coverall']->coverallType->name}}</label>
                            <input class="form-control" type="number" name="coverall_types_ids[]"
                                   value="{{$employerAvailableCoverall['coverall']->coverall_type_id}}" min="1">
                            <label>Количество</label>
                            <input class="form-control" type="number" name="coverall_counts[]" value="1" min="0"
                                   max="{{$employerAvailableCoverall['coverallCount']}}">
                        </div>
                    @endforeach
                </div>
            @endif

            <button class="btn btn-primary">
                Сохранить
            </button>
        </form>

    </main>

@endsection
