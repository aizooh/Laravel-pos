<?php

namespace App\Http\Controllers;

use App\Models\Accessory;
use Illuminate\Http\Request;

class AccessoryController extends Controller
{
    public function __construct()
    {
        // Only admin can access these methods
        $this->middleware(['auth', 'role:admin']);
    }

    public function index()
    {
        $accessories = Accessory::latest()->paginate(15);
        return view('accessories.index', compact('accessories'));
    }

    public function create()
    {
        return view('accessories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'sku' => 'nullable|string|unique:accessories,sku',
        ]);

        Accessory::create($validated);

        return redirect()->route('accessories.index')
            ->with('success', 'Accessory created successfully.');
    }

    public function show(Accessory $accessory)
    {
        return view('accessories.show', compact('accessory'));
    }

    public function edit(Accessory $accessory)
    {
        return view('accessories.edit', compact('accessory'));
    }

    public function update(Request $request, Accessory $accessory)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'sku' => 'nullable|string|unique:accessories,sku,' . $accessory->id,
        ]);

        $accessory->update($validated);

        return redirect()->route('accessories.index')
            ->with('success', 'Accessory updated successfully.');
    }

    public function destroy(Accessory $accessory)
    {
        // Optional: prevent deletion if sold items exist? We'll keep simple.
        $accessory->delete();

        return redirect()->route('accessories.index')
            ->with('success', 'Accessory deleted.');
    }
}