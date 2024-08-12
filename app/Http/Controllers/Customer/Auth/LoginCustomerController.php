<?php

namespace App\Http\Controllers\Customer\Auth;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginCustomerController extends Controller
{
    public function show()
    {
        return view('customer.login-customer');
    }
    public function authenticate(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required|email',
                'password' => 'required'
            ],
            [
                'email.required' => 'Email không được để trống',
                'email.email' => 'Email phải đúng định dạng',
                'password.required' => 'Vui lòng nhập mật khẩu'
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $loginInforCustomer = ['email' => $request->email, 'password' => $request->password];
        $customer = Customer::where('email', $request->email)->where('isDeleted', 0)->first();

        if (!$customer || !Auth::guard('customer')->attempt($loginInforCustomer)) {
            Session::flash('error', 'Email hoặc mật khẩu không hợp lệ');
            return redirect()->route('customer.login');
        }

        session(['customer' => $customer]);
        $intendedUrl = session()->pull('url.intended', '/cilent');
        // Chuyển hướng người dùng đến URL trước khi đăng nhập hoặc '/client' nếu không có URL nào trong session
        return redirect($intendedUrl);
    }
        
    
    
}
