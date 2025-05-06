@extends('layouts.app')

@section('content')
    <h1>Просмотр продукта</h1>

    <div>
        <strong>ID:</strong> {{ $product->id }}
    </div>
    <div>
        <strong>Артикул:</strong> {{ $product->article }}
    </div>
    <div>
        <strong>Название:</strong> {{ $product->name }}
    </div>
    <div>
        <strong>Статус:</strong> {{ $product->status }}
    </div>
    <div>
        <strong>Данные:</strong> {!! $product->data ?? '' !!}
    </div>

    <a href="{{ route('products.index') }}" class="btn">Назад</a>
    @can('edit products')
        <a href="{{ route('products.edit', $product) }}" class="btn">Редактировать</a>
    @endcan
@endsection