@extends('layouts.app')

@section('content')
    <h1>Добавить продукт</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="article">Артикул</label>
            <input type="text" name="article" id="article" value="{{ old('article') }}" class="form-control">
            @error('article')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="name">Название</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control">
            @error('name')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="status">Статус</label>
            <select name="status" id="status" class="form-control">
                <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Доступен</option>
                <option value="unavailable" {{ old('status') == 'unavailable' ? 'selected' : '' }}>Недоступен</option>
            </select>
            @error('status')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="data">Дополнительные данные (JSON)</label>
            <textarea name="data" id="data" class="form-control">{!! old('data') !!}</textarea>
            @error('data')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn">Создать</button>
    </form>
@endsection