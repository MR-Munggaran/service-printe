<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use App\Models\Customer;


class DashboardController extends Controller
{
    public function index()
    {
        $categoriesCount = Category::count();
        $itemsCount = Item::count();
        $CustomersCount = Customer::count();
        
        $categories = Category::all();
        $items = Item::all();
        
        return view('dashboard', compact('categories', 'items', 'categoriesCount', 'itemsCount', 'CustomersCount'));
    }
}
