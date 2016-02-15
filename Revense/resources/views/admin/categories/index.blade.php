@extends('layouts.admin')

@section('content')
    <h2>Tüm Kategoriler</h2>
    <ul class="contentList">
        @foreach($categories as $category)
            <li>
                <span class="contentName">{{ $category->trName }}</span>
                <a href="{{ action('AdminController@get_editCategory', array('id' => $category->id)) }}" class="editButton"></a>
            </li>
        @endforeach
    </ul>
@endsection