<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;

class ProductController extends Controller
{
    public function store(ProductRequest $request)
    {
        $validated = $request->validated();
        Product::create($validated);
        return response()->json(['message' => 'Продукт успешно добавлен']);
    }

    public function update(ProductRequest $request, Product $product)
    {
        $validated = $request->validated();
        $product->update($validated);
        return response()->json(['message' => 'Продукт успешно обновлён']);
    }
}
