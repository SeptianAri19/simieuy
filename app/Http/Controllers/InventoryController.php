<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;

class InventoryController extends Controller
{

    public function index()
    {
        $inventories = Inventory::latest()->get();
        return view('admin.inventories.index', compact('inventories'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'total_stock' => 'required|integer',
            'description' => 'nullable'
        ]);

        Inventory::create([
            'name' => $request->name,
            'category' => $request->category,
            'total_stock' => $request->total_stock,
            'available_stock' => $request->total_stock,
            'description' => $request->description
        ]);

        return redirect()->route('inventories.index');
    }


    public function update(Request $request, $id)
    {
        $inventory = Inventory::findOrFail($id);

        $inventory->update([
            'name' => $request->name,
            'category' => $request->category,
            'total_stock' => $request->total_stock,
            'available_stock' => $request->total_stock,
            'description' => $request->description
        ]);

        return redirect()->route('inventories.index');
    }


    public function destroy($id)
    {
        $inventory = Inventory::findOrFail($id);
        $inventory->delete();

        return redirect()->route('inventories.index');
    }

}