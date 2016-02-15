@extends('layouts.admin')

@section('content')
    <h2>Yeni Kategori Ekle</h2>
    
    {!! Form::model($category, array('route' => array('adminEditCategory', $category->id))) !!}
        <div class="formRow">
            <div class="formRowLeft">Üst Kategori</div>
            <div class="formRowRight">{!! Form::select('parentCategory', $categories, null, array('class' => 'defaultSelect')) !!}</div>
        </div>
        <div class="formRow">
            <div class="formRowLeft">Kategori İsmi (Türkçe)</div>
            <div class="formRowRight">{!! Form::text('trName', null, array('class' => 'defaultTextBox')) !!}</div>
        </div>
        <div class="formRow">
            <div class="formRowLeft">Kategori İsmi (İngilizce)</div>
            <div class="formRowRight">{!! Form::text('enName', null, array('class' => 'defaultTextBox')) !!}</div>
        </div>
        <div class="formRow">
            <div class="formRowLeft">SEO İsmi (Türkçe)</div>
            <div class="formRowRight">{!! Form::text('trSlug', null, array('class' => 'defaultTextBox')) !!}</div>
        </div>
        <div class="formRow">
            <div class="formRowLeft">SEO İsmi (İngilizce)</div>
            <div class="formRowRight">{!! Form::text('enSlug', null, array('class' => 'defaultTextBox')) !!}</div>
        </div>
        <div class="formRow">
            <div class="formRowLeft">Açıklama (Türkçe)</div>
            <div class="formRowRight">{!! Form::text('trDescription', null, array('class' => 'defaultTextBox')) !!}</div>
        </div>
        <div class="formRow">
            <div class="formRowLeft">Açıklama (İngilizce)</div>
            <div class="formRowRight">{!! Form::text('enDescription', null, array('class' => 'defaultTextBox')) !!}</div>
        </div>
        <div class="formRow">
            <div class="formRowLeft">Model İsmi</div>
            <div class="formRowRight">{!! Form::text('modelName', null, array('class' => 'defaultTextBox')) !!}</div>
        </div>
        <div class="formRow">
            <div class="formRowLeft">Tablo İsmi</div>
            <div class="formRowRight">{!! Form::text('tableName', null, array('class' => 'defaultTextBox')) !!}</div>
        </div>
        <div class="formRow">
            <div class="formRowLeft"></div>
            <div class="formRowRight">{!! Form::submit('Kaydet', array('class' => 'defaultButton')) !!}</div>
        </div>
    {!! Form::close() !!}
@endsection