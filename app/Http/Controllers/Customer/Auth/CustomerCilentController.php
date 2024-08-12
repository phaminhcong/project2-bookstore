<?php

namespace App\Http\Controllers\Customer\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class CustomerCilentController extends Controller
{
    public function updateCustomer(Request $request, $id)
{
    $customer = Customer::find($id);
    if (!$customer) {
        return response()->json(['error' => 'Customer not found'], 404);
    }

    // Validation rules
    $rules = [
        'name' => 'sometimes|required|string|max:255',
        'email' => 'sometimes|required|string|email|max:255|unique:customers,email,' . $id,
        'password' => 'sometimes|nullable|string|min:8|confirmed',
        'phone_number' => 'sometimes|required|string|max:15',
    ];

    // Validate the request
    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }
    if ($request->filled('password') && !Hash::check($request->input('current_password'), $customer->password)) {
        return redirect()->back()->withErrors(['current_password' => 'Current password is incorrect'])->withInput();
    }

    // Update customer data if present in the request
    if ($request->has('name')) {
        $customer->name = $request->input('name');
    }
    if ($request->has('email')) {
        $customer->email = $request->input('email');
    }
    if ($request->filled('password')) {
        $customer->password = Hash::make($request->input('password'));
    }
    if ($request->has('phone_number')) {
        $customer->phone_number = $request->input('phone_number');
    }
    session()->forget('customer');
        session()->put('customer', $customer);
    // Save the updated customer
    $customer->save();
    Session::flash('success', 'Cập nhật thông tin thành công');
    return redirect()->back();
}
}
