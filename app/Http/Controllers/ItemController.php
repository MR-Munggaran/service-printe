<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::with('category')->latest()->paginate(10);
        return view('items.index', compact('items'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('items.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'unique:items,name', 'max:255'],
            'brand' => ['required', 'max:255'],
            'purchase_price' => ['required', 'numeric', 'min:0'],
            'selling_price' => ['required', 'numeric', 'min:0'],
            'satuan_barang' => ['required', 'in:pcs,kg,ltr,pack,boks'],
            'stock' => ['required', 'integer', 'min:0'],
        ]);

        Item::create($request->all());
        return redirect()->route('items.index')->with('success', 'Barang berhasil ditambahkan');
    }

    public function show(Item $item)
    {
        return view('items.show', compact('item'));
    }

    public function edit(Item $item)
    {
        $categories = Category::all();
        return view('items.edit', compact('item', 'categories'));
    }

    public function update(Request $request, Item $item)
    {
        $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'unique:items,name,'.$item->id, 'max:255'],
            'brand' => ['required', 'max:255'],
            'purchase_price' => ['required', 'numeric', 'min:0'],
            'selling_price' => ['required', 'numeric', 'min:0'],
            'satuan_barang' => ['required', 'in:pcs,kg,ltr,pack,boks'],
            'stock' => ['required', 'integer', 'min:0'],
        ]);

        $item->update($request->all());
        return redirect()->route('items.index')->with('success', 'Barang berhasil diupdate');
    }

    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('items.index')->with('success', 'Barang berhasil dihapus');
    }
}
