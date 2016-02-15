@extends('layouts.admin')

@section('content')
    <h2>Yeni Kategori Ekle</h2>
    
    {!! Form::open(array('route' => 'adminAddCategory', 'method' => 'post')) !!}
        <div class="formRow">
            <div class="formRowLeft">Üst Kategori</div>
            <div class="formRowRight">
                <select name="parentCategory" class="defaultSelect">
                    <option value="-1">Kategori Seç</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->nameTranslation->trValue}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="formRow">
            <div class="formRowLeft">Kategori İsmi (Türkçe)</div>
            <div class="formRowRight">{!! Form::text('trName', '', array('class' => 'defaultTextBox')) !!}</div>
        </div>
        <div class="formRow">
            <div class="formRowLeft">Kategori İsmi (İngilizce)</div>
            <div class="formRowRight">{!! Form::text('enName', '', array('class' => 'defaultTextBox')) !!}</div>
        </div>
        <div class="formRow">
            <div class="formRowLeft">SEO İsmi (Türkçe)</div>
            <div class="formRowRight">{!! Form::text('trSlug', '', array('class' => 'defaultTextBox')) !!}</div>
        </div>
        <div class="formRow">
            <div class="formRowLeft">SEO İsmi (İngilizce)</div>
            <div class="formRowRight">{!! Form::text('enSlug', '', array('class' => 'defaultTextBox')) !!}</div>
        </div>
        <div class="formRow">
            <div class="formRowLeft">Açıklama (Türkçe)</div>
            <div class="formRowRight">{!! Form::text('trDescription', '', array('class' => 'defaultTextBox')) !!}</div>
        </div>
        <div class="formRow">
            <div class="formRowLeft">Açıklama (İngilizce)</div>
            <div class="formRowRight">{!! Form::text('enDescription', '', array('class' => 'defaultTextBox')) !!}</div>
        </div>
        <div class="formRow">
            <div class="formRowLeft">Model İsmi</div>
            <div class="formRowRight">{!! Form::text('modelName', '', array('class' => 'defaultTextBox')) !!}</div>
        </div>
        <div class="formRow">
            <div class="formRowLeft">Tablo İsmi</div>
            <div class="formRowRight">{!! Form::text('tableName', '', array('class' => 'defaultTextBox')) !!}</div>
        </div>
        <div class="formRow">
            <div class="formRowLeft"></div>
            <div class="formRowRight">{!! Form::submit('Kaydet', array('class' => 'defaultButton')) !!}</div>
        </div>
    {!! Form::close() !!}
@endsection