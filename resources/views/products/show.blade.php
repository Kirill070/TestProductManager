@extends('layouts.app')

@section('content')
    <h1>Продукт #{{ $product->id }}</h1>
    <p><strong>Артикул:</strong> {{ $product->article }}</p>
    <p><strong>Название:</strong> {{ $product->name }}</p>
    <p><strong>Статус:</strong> {{ $product->status }}</p>
    <p><strong>Данные:</strong> {{ json_encode($product->data) }}</p>
    <a href="{{ route('products.index') }}" class="btn">Назад</a>
    <a href="{{ route('products.edit', $product) }}" class="btn">Редактировать</a>
@endsection
