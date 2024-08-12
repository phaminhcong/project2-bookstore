<?php

namespace App\Http\Controllers\Admin\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class CustomerController extends Controller
{
    public function all()
    {
        $customer = Customer::where('isDeleted', 0)->Paginate(5);
        return view('admin.customers.list_customer', compact('customer'));
    }
    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $customer = Customer::where('email', 'like', "%$searchTerm%")
        ->where('isDeleted', 0)
        -> paginate(4);
        return view('admin.customers.search_customer', compact('customer', 'searchTerm'));
    }
    public function softDeletedCustomer($id)
    {
        DB::table("customers")
            ->where("id", $id)
            ->update(['isDeleted' => 1]);
        return redirect()->route('customer.all');
    }
}
