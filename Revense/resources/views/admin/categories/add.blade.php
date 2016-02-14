@extends('layouts.admin')

@section('content')
    <h2>Yeni Kategori Ekle</h2>
    
    {!! Form::open(array('route' => 'adminLoginSubmit', 'method' => 'post')) !!}
        <div class="formRow">
            <div class="formRowLeft">Ana Kategori</div>
            <div class="formRowRight">
                <select name="parentCategory" class="defaultSelect">
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->nameTranslation->trValue}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="formRow">
            <div class="formRowLeft">Kategori İsmi</div>
            <div class="formRowRight">{!! Form::text('name', '', array('class' => 'defaultTextBox')) !!}</div>
        </div>
        <div class="formRow">
            <div class="formRowLeft">Slug</div>
            <div class="formRowRight">{!! Form::text('slug', '', array('class' => 'defaultTextBox')) !!}</div>
        </div>
        <div class="formRow">
            <div class="formRowLeft">Açıklama</div>
            <div class="formRowRight">{!! Form::text('description', '', array('class' => 'defaultTextBox')) !!}</div>
        </div>
        <div class="formRow">
            <div class="formRowLeft">Model İsmi</div>
            <div class="formRowRight">{!! Form::text('modelName', '', array('class' => 'defaultTextBox')) !!}</div>
        </div>
    {!! Form::close() !!}
@endsection