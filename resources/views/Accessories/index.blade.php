@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Accessories Inventory</h1>
        <a href="{{ route('accessories.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add New Accessory</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border">
            <thead>
                <tr>
                    <th class="px-6 py-3 border-b">Name</th>
                    <th class="px-6 py-3 border-b">SKU</th>
                    <th class="px-6 py-3 border-b">Price</th>
                    <th class="px-6 py-3 border-b">Stock</th>
                    <th class="px-6 py-3 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($accessories as $accessory)
                <tr class="{{ $accessory->stock_quantity < 5 ? 'bg-red-100' : '' }}">
                    <td class="px-6 py-3 border-b">{{ $accessory->name }}</td>
                    <td class="px-6 py-3 border-b">{{ $accessory->sku ?? '-' }}</td>
                    <td class="px-6 py-3 border-b">${{ number_format($accessory->price, 2) }}</td>
                    <td class="px-6 py-3 border-b">{{ $accessory->stock_quantity }}</td>
                    <td class="px-6 py-3 border-b">
                        <a href="{{ route('accessories.show', $accessory) }}" class="text-blue-600">View</a>
                        <a href="{{ route('accessories.edit', $accessory) }}" class="text-yellow-600 ml-2">Edit</a>
                        <form action="{{ route('accessories.destroy', $accessory) }}" method="POST" class="inline-block ml-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600" onclick="return confirm('Delete this accessory?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $accessories->links() }}
    </div>
</div>
@endsection