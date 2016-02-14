@extends('layouts.admin')

@section('content')
    <h2>Tüm Kategoriler</h2>

    @foreach($categories as $category)
        <ul class="contentList">
            <li>
                <span class="contentName">{{ $category->nameTranslation->trValue }}</span>
            </li>
        </ul>
    @endforeach
@endsection