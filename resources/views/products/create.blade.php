@extends('layouts.app')

@section('content')
    <h1>Добавить продукт</h1>
    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Название</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required>
            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="article">Артикул</label>
            <input type="text" name="article" id="article" value="{{ old('article') }}" required>
            @error('article')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="status">Статус</label>
            <select name="status" id="status" required>
                <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Доступен</option>
                <option value="unavailable" {{ old('status') == 'unavailable' ? 'selected' : '' }}>Недоступен</option>
            </select>
            @error('status')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="data">Данные (JSON)</label>
            <textarea name="data" id="data">{{ old('data') }}</textarea>
            @error('data')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn">Сохранить</button>
    </form>
@endsection
