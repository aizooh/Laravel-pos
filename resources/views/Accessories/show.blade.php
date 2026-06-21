@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-6">{{ $accessory->name }}</h1>

    <div class="bg-white rounded shadow p-6">
        <p><strong>SKU:</strong> {{ $accessory->sku ?? 'N/A' }}</p>
        <p><strong>Price:</strong> ${{ number_format($accessory->price, 2) }}</p>
        <p><strong>Stock:</strong> {{ $accessory->stock_quantity }}</p>
        <p><strong>Description:</strong> {{ $accessory->description ?? 'No description' }}</p>
        <p><strong>Created:</strong> {{ $accessory->created_at->format('Y-m-d H:i') }}</p>
        <p><strong>Last Updated:</strong> {{ $accessory->updated_at->format('Y-m-d H:i') }}</p>

        <div class="mt-4">
            <a href="{{ route('accessories.edit', $accessory) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">Edit</a>
            <a href="{{ route('accessories.index') }}" class="ml-2 text-gray-600">Back to List</a>
        </div>
    </div>
</div>
@endsection