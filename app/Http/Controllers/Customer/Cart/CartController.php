<?php

namespace App\Http\Controllers\Customer\Cart;

use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class CartController extends Controller
{
    public function showCart()
    {
        $cart = session()->get('cart');
        return view('customer.cart.list_product_cart', compact('cart'));
    }
    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        // Thêm sản phẩm vào giỏ hàng
        $cart = session()->get('cart');
        if (!$cart) {
            $cart = [
                $id => [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'sale' => $product->sale,
                    'image_product' => $product->image_product,
                    'quantity' => 1
                ]
            ];
            if ($request->hasFile('image_product')) {
                $imageName = time() . '.' . $request->file('image_product')->getClientOriginalExtension();
                $request->file('image_product')->move(public_path('dist/img'), $imageName);
                $product->update(['image_product' => $imageName]);
            }

            session()->put('cart', $cart);
            // dd(session()->get('cart'));
            return redirect()->route('cart.show');
        }

        // Nếu sản phẩm đã tồn tại trong giỏ hàng, tăng số lượng lên 1
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
            session()->put('cart', $cart);
            return redirect()->route('cart.show');
        }

        // Nếu sản phẩm chưa tồn tại trong giỏ hàng, thêm mới
        $cart[$id] = [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'sale' => $product->sale,
            'image_product' => $product->image_product,
            'quantity' => 1
        ];
        session()->put('cart', $cart);
        // dd(session()->get('cart'));
        return redirect()->route('cart.show');
    }


    public function removeFromCart(Request $request, $id)
    {
        $cart = session()->get('cart');

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->route('cart.show')->with('success', 'Product removed from cart successfully!');
    }
    public function getTotal()
    {
        $cart = session()->get('cart');
        $total = 0;
        if ($cart) {
            foreach ($cart as $row) {
                $discountedPrice = ($row['price'] - ($row['price'] * $row['sale'] / 100));
                $total += $discountedPrice * $row['quantity'];
            }
        }
        return $total;
    }

    public function updateCart(Request $request)
    {
        $quantities = $request->input('quantity');
        $cart = session()->get('cart');

        if ($quantities && $cart) {
            foreach ($cart as $id => $row) {
                if (isset($quantities[$id])) {
                    $quantity = $quantities[$id];
                    if ($quantity <= 0) {
                        unset($cart[$id]);
                    } else {
                        $cart[$id]['quantity'] = $quantity;
                    }
                }
            }
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Cart updated successfully!');
    }
    public function showCheckoutCart()
    {
        if (session()->has('customer')) {
        $cart = session()->get('cart');
        return view('customer.cart.check_out', compact('cart'));
    } else {
        return redirect()->route('customer.login');
    }
    }
    public function cartOrder(Request $request)
    {
        if (session()->has('customer')) {
            $cart = session()->get('cart');
            $totalProductValue = 0;
            if ($cart) {
                foreach ($cart as $row) {
                    $discountedPrice = ($row['price'] - ($row['price'] * $row['sale'] / 100));
                    $totalProductValue += $discountedPrice * $row['quantity'];
                }
            }
            $request->validate([
                'receiveName' => 'required',
                'receivePhoneNumber' => 'required|numeric',
                'receiveAddress' => 'required',
                'receiveEmail' => 'required',
                'orderNote'
            ], [
                'receiveName.required' => 'Vui lòng nhập tên',
                'receivePhoneNumber.required' => 'Vui lòng số điện thoại',
                'receiveAddress.required' => 'Vui lòng nhập địa chỉ nhận hàng',
                'receiveEmail.required' => 'Vui lòng nhập email',
            ]);
            foreach ($cart as $c) {
                $product = Product::find($c['id']);
                if ($product->quantity < $c['quantity']) {
                    Session::flash('error', 'Sản phẩm ' . $product->name . ' không đủ số lượng trong kho');
                    return redirect()->route('cart.checkout');
                }
            }
           $order = Order::create([
                'receiveName' => $request->receiveName,
                'receivePhoneNumber' => $request->receivePhoneNumber,
                'receiveAddress' => $request->receiveAddress,
                'receiveEmail' => $request->receiveEmail,
                'orderNote' => $request->orderNote,
                'cust_id' =>  session('customer')->id,
                'total_product_value' =>  $totalProductValue,
            ]);
            foreach ($cart as $c) {
                $product = Product::find($c['id']);
                $quantity = $c['quantity'];
                $price_each_product = ( $c['price']  - ($c['price']  * $c['sale'] / 100) ) * $c['quantity'];
                OrderDetail::create([
                    'order_id' => $order->id,
                    'prd_id' => $product->id,
                    'quantity_product' => $quantity,
                    'price_each_product' => $price_each_product,
                    'price_all_product' => $totalProductValue, // Include total here
                ]);
                $product->quantity -= $quantity;
                $product->save();
                
            }
            session()->forget('cart');
            Session::flash('success', 'Đơn hàng của bạn đã được nhận, hãy tiếp tục mua sắm');   
            return redirect('/cilent/cart');
        } else {
            return redirect()->route('customer.login');
        }
    }
}
