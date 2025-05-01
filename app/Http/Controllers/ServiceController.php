<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Item;
use App\Models\Customer;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::with(['item', 'customer'])->latest()->paginate(10);
        return view('services.index', compact('services'));
    }

    public function create()
    {
        $items = Item::all();
        $customers = Customer::all();
        return view('services.create', compact('items', 'customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_id' => ['required', 'exists:items,id'],
            'customer_id' => ['nullable', 'exists:customers,id'],
            'description' => ['required', 'string'],
            'service_date' => ['required', 'date'],
            'status' => ['required', 'in:pending,in_progress,completed'],
        ]);

        Service::create($request->all());
        return redirect()->route('services.index')->with('success', 'Service berhasil ditambahkan');
    }

    public function show(Service $service)
    {
        return view('services.show', compact('service'));
    }

    public function edit(Service $service)
    {
        $items = Item::all();
        $customers = Customer::all();
        return view('services.edit', compact('service', 'items', 'customers'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'item_id' => ['required', 'exists:items,id'],
            'customer_id' => ['nullable', 'exists:customers,id'],
            'description' => ['required', 'string'],
            'service_date' => ['required', 'date'],
            'status' => ['required', 'in:pending,in_progress,completed'],
        ]);

        $service->update($request->all());
        return redirect()->route('services.index')->with('success', 'Service berhasil diupdate');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('services.index')->with('success', 'Service berhasil dihapus');
    }
}