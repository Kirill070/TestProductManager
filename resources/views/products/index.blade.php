@extends('layouts.app')

@section('content')
    <h1>Продукты</h1>
    @can('create products')
        <a href="{{ route('products.create') }}" class="btn">Добавить продукт</a>
    @endcan
    @if ($products->isEmpty())
        <p>Нет продуктов.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Артикул</th>
                    <th>Название</th>
                    <th>Статус</th>
                    <th>Данные</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->article }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->status }}</td>
                        <td>{!! $product->data ?? '' !!}</td>
                        <td>
                            <a href="{{ route('products.show', $product) }}">Просмотр</a>
                            @can('edit products')
                                | <a href="{{ route('products.edit', $product) }}">Редактировать</a>
                            @endcan
                            @can('delete products')
                                |
                                <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Удалить продукт?')">Удалить</button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection