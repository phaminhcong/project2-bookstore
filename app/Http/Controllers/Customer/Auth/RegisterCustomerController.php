<?php

namespace App\Http\Controllers\Customer\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class RegisterCustomerController extends Controller
{
    public function show() {
        return view('customer.register-customer');
    }
    public function store(Request $request) {
        $validator = Validator::make($request-> all(), [
            'name' => 'required|max:255',
            'email' => 'required|unique:customers',
            'phone_number' =>'required|unique:customers',
            'password' => 'required|min:8'
        ],
        [
            'name.required' => 'Họ và tên không được để trống',
            'name.max' => 'Không được vượt quá 255 kí tự',
            'email.required' => 'Email không được để trống',
            'email.unique' => 'Email đã tồn tại',
            'phone_number.required' => 'Số điện thoại không được để trống',
            'phone_number.unique' => 'Số điện thoại đã tồn tại',
            'password.required' => 'Vui lòng tạo mật khẩu',
            'password.min' => 'Mật khẩu phải trên 8 kí tự'
        ]
    
    );
    if ($validator->fails()) {
        return redirect() -> route('registerCustomer.show') ->withErrors($validator) ->withInput();
    }
        $customer = new Customer();
        $customer -> name = $request->name;
        $customer -> email = $request->email;
        $customer -> phone_number = $request->phone_number;
        $password = $request->input('password');
        $customer->setPassword($password);
        $customer -> save();
        return redirect('/cilent/login');
    }
   
}
