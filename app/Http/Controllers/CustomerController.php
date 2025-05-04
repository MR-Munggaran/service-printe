<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = Customer::query();
    
        // Filter berdasarkan nama
        if ($request->filled('name')) {
            $query->where('name', 'like', "%{$request->name}%");
        }
        if ($request->filled('NIK')) {
            $query->where('NIK', 'like', "%{$request->NIK}%");
        }
    
    
        $customers = $query->latest()->paginate(10)->appends($request->only(['name', 'NIK']));
    
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'address' => ['required'],
            'telephone' => ['required', 'regex:/^[0-9\-\+]+$/'],
            'email' => ['required', 'email', 'unique:customers'],
            'NIK' => ['required', 'unique:customers'],
        ]);

        Customer::create($request->all());
        return redirect()->route('customers.index')->with('success', 'Pelanggan berhasil ditambahkan');
    }

    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'address' => ['required'],
            'telephone' => ['required', 'regex:/^[0-9\-\+]+$/'],
            'email' => ['required', 'email', 'unique:customers,email,'.$customer->id],
            'NIK' => ['required', 'unique:customers,NIK,'.$customer->id],
        ]);

        $customer->update($request->all());
        return redirect()->route('customers.index')->with('success', 'Pelanggan berhasil diupdate');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Pelanggan berhasil dihapus');
    }
}
