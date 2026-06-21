@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-6">Edit Accessory</h1>

    <form action="{{ route('accessories.update', $accessory) }}" method="POST" class="max-w-lg">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block mb-2">Name *</label>
            <input type="text" name="name" id="name" value="{{ old('name', $accessory->name) }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label for="description" class="block mb-2">Description</label>
            <textarea name="description" id="description" rows="3" class="w-full border rounded px-3 py-2">{{ old('description', $accessory->description) }}</textarea>
        </div>

        <div class="mb-4">
            <label for="price" class="block mb-2">Price *</label>
            <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $accessory->price) }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label for="stock_quantity" class="block mb-2">Stock Quantity *</label>
            <input type="number" name="stock_quantity" id="stock_quantity" value="{{ old('stock_quantity', $accessory->stock_quantity) }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label for="sku" class="block mb-2">SKU (optional)</label>
            <input type="text" name="sku" id="sku" value="{{ old('sku', $accessory->sku) }}" class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded">Update Accessory</button>
            <a href="{{ route('accessories.index') }}" class="ml-2 text-gray-600">Cancel</a>
        </div>
    </form>
</div>
@endsection