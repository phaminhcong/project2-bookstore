<?php

namespace App\Http\Controllers\Admin\Review;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function post_review(Request $request)
    { {
            $request->validate([
                'product_id' => 'required|exists:products,id',
                'comments' => 'string|max:1000',
                'customer_id' => 'required|exists:customers,id',
                'evaluate' => 'required|integer|between:1,5',
            ]);
            Review::create([
                'product_id' => $request->product_id,
                'customer_id' => $request->customer_id,
                'comments' => $request->comments,
                'evaluate' => $request->evaluate,
            ]);
            return redirect()->back()->with('success', 'Đánh giá của bạn đã được gửi.');
        }
    }
    public function show($id)
    {
        $product = Product::findOrFail($id);
        if (Auth::guard('customer')->check()) {
            $customer = Auth::guard('customer')->user();
            $customerId = $customer->id;
            $hasCommented = Review::where('product_id', $id)
                ->where('customer_id', $customerId)
                ->get();

        }
        $reviews = Review::where('product_id', $id)
            ->join('customers', 'reviews.customer_id', '=', 'customers.id')
            ->select('reviews.*', 'customers.name as customer_name')
            ->get();

        return view('customer.product.product_detail', compact('product', 'reviews', 'hasCommented')) ->with('hasCommented', $hasCommented);;
    }
}
