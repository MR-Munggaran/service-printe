<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Bill;
use App\Models\Item;
use App\Models\Customer;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Illuminate\Support\Facades\Response;

class BillController extends Controller
{
    public function index(Request $request)
    {
        $query = Bill::with(['item', 'customer']);
        if ($request->filled('item_name')) {
            $query->whereHas('item', function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->item_name}%");
            });
        }
        if ($request->filled('customer_name')) {
            $query->whereHas('customer', function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->customer_name}%");
            });
        }
        if ($request->filled('period')) {
            [$year, $month] = explode('-', $request->period) + [null, null];
            if ($year && $month) {
                $query->whereYear('period', $year)
                      ->whereMonth('period', $month);
            }
        }
        if ($request->filled('min_amount')) {
            $query->where('amount', '>=', $request->min_amount);
        }
        if ($request->filled('max_amount')) {
            $query->where('amount', '<=', $request->max_amount);
        }
        $bills = $query->latest()->paginate(10)->appends($request->only([
            'item_name', 'customer_name', 'period',
            'min_amount', 'max_amount'
        ]));
        return view('bills.index', compact('bills'));
    }

    public function exportXlsx(Request $request)
    {
        // 1. Siapkan query dengan filter sama seperti index()
        $query = Bill::with(['item', 'customer']);
        if ($request->filled('item_name')) {
            $query->whereHas('item', fn($q) => $q->where('name', 'like', "%{$request->item_name}%"));
        }
        if ($request->filled('customer_name')) {
            $query->whereHas('customer', fn($q) => $q->where('name', 'like', "%{$request->customer_name}%"));
        }
        if ($request->filled('period')) {
            [$year, $month] = explode('-', $request->period) + [null, null];
            if ($year && $month) {
                $query->whereYear('period', $year)
                      ->whereMonth('period', $month);
            }
        }
        if ($request->filled('min_amount')) {
            $query->where('amount', '>=', $request->min_amount);
        }
        if ($request->filled('max_amount')) {
            $query->where('amount', '<=', $request->max_amount);
        }
    
        // 2. Nama file untuk diunduh
        $fileName = 'bills_' . now()->format('Ymd_His') . '.xlsx';
    
        // 3. Stream download
        return Response::streamDownload(function () use ($query) {
            // Buat writer dan arahkan ke output PHP
            $writer = WriterEntityFactory::createXLSXWriter();
            $writer->openToFile('php://output');
    
            // Header baris pertama
            $writer->addRow(WriterEntityFactory::createRowFromArray([
                'ID', 'Nama Barang', 'Pelanggan', 'Jumlah', 'Total', 'Periode'
            ]));
    
            // Ambil data per chunk untuk efisiensi memori
            $query->chunk(500, function ($bills) use ($writer) {
                foreach ($bills as $bill) {
                    $writer->addRow(WriterEntityFactory::createRowFromArray([
                        $bill->id,
                        $bill->item->name,
                        $bill->customer->name,
                        $bill->amount,
                        $bill->total,
                        Carbon::parse($bill->period)->format('Y-m'),
                    ]));
                }
            });
    
            // Pastikan semua data ter-flush
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
        return view('bills.create', compact('items', 'customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'customer_id' => 'required|exists:customers,id',
            'amount' => 'required|integer|min:1',
            'total' => 'required|numeric|min:0',
            'period' => 'required|date_format:Y-m',
        ]);
        $period = Carbon::createFromFormat('Y-m', $request->period)->format('Y-m-d');
        Bill::create([
            'item_id' => $request->item_id,
            'customer_id' => $request->customer_id,
            'amount' => $request->amount,
            'total' => $request->total,
            'period' => $period,
        ]);
        return redirect()->route('bills.index')->with('success', 'Nota berhasil ditambahkan');
    }

    public function show(Bill $bill)
    {
        return view('bills.show', compact('bill'));
    }

    public function edit(Bill $bill)
    {
        $items = Item::all();
        $customers = Customer::all();
        return view('bills.edit', compact('bill', 'items', 'customers'));
    }

    public function update(Request $request, Bill $bill)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'customer_id' => 'required|exists:customers,id',
            'amount' => 'required|integer|min:1',
            'total' => 'required|numeric|min:0',
            'period' => 'required|date_format:Y-m',
        ]);
        $period = Carbon::createFromFormat('Y-m', $request->period)->format('Y-m-d');
        $bill->update([
            'item_id' => $request->item_id,
            'customer_id' => $request->customer_id,
            'amount' => $request->amount,
            'total' => $request->total,
            'period' => $period,
        ]);
        return redirect()->route('bills.index')->with('success', 'Nota berhasil diupdate');
    }

    public function destroy(Bill $bill)
    {
        $bill->delete();
        return redirect()->route('bills.index')->with('success', 'Nota berhasil dihapus');
    }
}
