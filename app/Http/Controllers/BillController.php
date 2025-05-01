<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Bill;
use App\Models\Item;
use App\Models\Customer;

class BillController extends Controller
{

    public function index()
    {
        $bills = Bill::with(['item', 'customer'])->latest()->paginate(10);
        return view('bills.index', compact('bills'));
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
            'item_id' => ['required', 'exists:items,id'],
            'customer_id' => ['required', 'exists:customers,id'],
            'amount' => ['required', 'integer', 'min:1'],
            'total' => ['required', 'numeric', 'min:0'],
            'period' => ['required', 'date_format:Y-m'], // Validasi format YYYY-MM
        ]);
    
        // Konversi YYYY-MM ke YYYY-MM-DD (gunakan tanggal 1 sebagai default)
        $period = Carbon::createFromFormat('Y-m', $request->period)->format('Y-m-d');
    
        Bill::create([
            'item_id' => $request->item_id,
            'customer_id' => $request->customer_id,
            'amount' => $request->amount,
            'total' => $request->total,
            'period' => $period, // Simpan sebagai YYYY-MM-DD
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
        'item_id' => ['required', 'exists:items,id'],
        'customer_id' => ['required', 'exists:customers,id'],
        'amount' => ['required', 'integer', 'min:1'],
        'total' => ['required', 'numeric', 'min:0'],
        'period' => ['required', 'date_format:Y-m'],
    ]);

    // Ubah format YYYY-MM menjadi YYYY-MM-DD
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
