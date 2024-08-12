<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;


class OrderController extends Controller
{
    public function all() {
        $order = Order::where('isDeleted', 0)->orderBy('created_at', 'desc')->Paginate(5);
        $data['order'] = $order;
        return view('admin.orders.list_order', compact('order'), $data);
    }
    public function softDeleted($id)
    {
        DB::table("orders")
            ->where("id", $id)
            ->update(['isDeleted' => 1]);
        return redirect()->route('order.all');
    }
    public function showOrderDetail($order_id) {
        $order = Order::find($order_id);
        $order_detail = OrderDetail::with('product')->where('order_id',$order_id)->get();
       
        // dd($order_detail);
        return view('admin.orders.list_order_detail', compact('order','order_detail'));
    }
    public function orderHistory($id) {
        $order = Order::find($id);
        $order_detail = OrderDetail::with('product')->where('order_id',$id)->get();
        return view('customer.cart.order_history', compact('order','order_detail'));
    }
    public function getOrdersByCustomer($id)
    {
        $customer = Customer::findOrFail($id);
        $orders = $customer->orders()->where('order_status', '!=', 5)->with('orderDetails')->get();
        return view('customer.informationCustomer', compact('customer','orders'));
    }
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'order_status',
        ]);
        $order = Order::findOrFail($id);
        if ($request->order_status < $order->order_status) {
            return redirect()->back()->with('error', 'Bạn không thể cập nhật trạng thái về trước đó');
        }
        $order->update([
            'order_status' => $request->order_status,
            
        ]);
        return redirect()->back()->with('success', 'Cập nhật trạng thái thành công');
    }
    public function updateOrder($id)
    {
        DB::table("orders")
        ->where("id", $id)
        ->update(['order_status' => 5]);
        return redirect()->back();
    }
    public function index()
    {
        $revenues = $this->getRevenueByDay();
        return view('admin.index', compact('revenues'));
    }
    private function getRevenueByDay()
    {
        $startDate = Carbon::now()->subDays(6)->startOfDay();
        $endDate = Carbon::now()->endOfDay();

        $revenues = DB::table('orders')
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(total_product_value) as total_revenue')
            )
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();
        return $revenues;
    }
}
