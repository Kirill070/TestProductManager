@extends('layouts.app')

@section('content')
    <h1>Редактировать продукт #{{ $product->id }}</h1>
    <form action="{{ route('products.update', $product) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Название</label>
            <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required>
            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="article">Артикул</label>
            <input type="text" name="article" id="article" value="{{ old('article', $product->article) }}" required>
            @error('article')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="status">Статус</label>
            <select name="status" id="status" required>
                <option value="available" {{ old('status', $product->status) == 'available' ? 'selected' : '' }}>Доступен</option>
                <option value="unavailable" {{ old('status', $product->status) == 'unavailable' ? 'selected' : '' }}>Недоступен</option>
            </select>
            @error('status')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="data">Данные (JSON)</label>
            <textarea name="data" id="data">{{ old('data', json_encode($product->data)) }}</textarea>
            @error('data')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn">Сохранить</button>
    </form>
@endsection
