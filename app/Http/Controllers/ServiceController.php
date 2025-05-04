<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Item;
use App\Models\Customer;
use Illuminate\Http\Request;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Illuminate\Support\Facades\Response;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        // Query dasar dengan eager loading item dan customer
        $query = Service::with(['item', 'customer']);
    
        // Filter berdasarkan nama barang
        if ($request->filled('item_name')) {
            $query->whereHas('item', function($q) use ($request) {
                $q->where('name', 'like', "%{$request->item_name}%");
            });
        }
    
        // Filter berdasarkan nama pelanggan
        if ($request->filled('customer_name')) {
            $query->whereHas('customer', function($q) use ($request) {
                $q->where('name', 'like', "%{$request->customer_name}%");
            });
        }
    
        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
    
        // Filter berdasarkan tanggal service (exact match)
        if ($request->filled('service_date')) {
            $query->whereDate('service_date', $request->service_date);
        }
    
        // Paginasi
        $services = $query->latest()->paginate(10)->appends($request->only(['item_name', 'customer_name', 'status', 'service_date']));
    
        return view('services.index', compact('services'));
    }

    public function exportXlsx(Request $request)
    {
        // 1. Siapkan query dengan filter yang sama
        $query = Service::with(['item', 'customer']);
        if ($request->filled('item_name')) {
            $query->whereHas('item', fn($q) => $q->where('name', 'like', "%{$request->item_name}%"));
        }
        if ($request->filled('customer_name')) {
            $query->whereHas('customer', fn($q) => $q->where('name', 'like', "%{$request->customer_name}%"));
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('service_date')) {
            $query->whereDate('service_date', $request->service_date);
        }

        // 2. Nama file
        $fileName = 'services_' . now()->format('Ymd_His') . '.xlsx';

        // 3. Stream download via Laravel
        return Response::streamDownload(function () use ($query) {
            $writer = WriterEntityFactory::createXLSXWriter();
            $writer->openToFile('php://output');

            // Header
            $writer->addRow(WriterEntityFactory::createRowFromArray([
                'ID', 'Nama Barang', 'Pelanggan', 'Deskripsi', 'Tanggal Service', 'Status'
            ]));

            // Data per chunk
            $query->chunk(500, function ($services) use ($writer) {
                foreach ($services as $svc) {
                    $writer->addRow(WriterEntityFactory::createRowFromArray([
                        $svc->id,
                        $svc->item->name,
                        $svc->customer?->name,
                        $svc->description,
                        $svc->service_date->format('Y-m-d'),
                        ucfirst(str_replace('_', ' ', $svc->status)),
                    ]));
                }
            });

            $writer->close();
        }, $fileName, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => "attachment; filename=\"{$fileName}\"",
        ]);
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