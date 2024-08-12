<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function lowStock()
    {
        // Get the count of products with quantity less than 10
        $products = Product::where('quantity', '<', 10)->where('isDeleted', 0)->get();
        // Store the count in session
        // Pass the count to the view
        return view('admin.users.dashboard', compact('products'));
    }
}
