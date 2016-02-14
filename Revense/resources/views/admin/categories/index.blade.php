@extends('layouts.admin')

@section('content')
    <h2>Tüm Kategoriler</h2>

    @foreach($categories as $category)
    <div>{{ $category->nameTranslation->trValue }}</div>
    @endforeach
@endsection