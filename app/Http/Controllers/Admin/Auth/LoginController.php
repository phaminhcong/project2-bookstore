<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function show()
    {
        return view('admin.auth.login');
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
                'password.required' => 'Vui lòng tạo mật khẩu'
            ]
        );
        if (Auth::check()) {
            return redirect('/');
        }
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $loginInfor = ['email' => $request->email, 'password' => $request->password];
        if (Auth::guard('admin')->attempt($loginInfor)) {
            $admin = Auth::guard('admin')->user(); // Retrieve the logged-in admin
            session(['admin' => $admin]);
            return redirect('/admin');
        }
        return redirect()->back()->withErrors($validator)->withInput();
        
    }
}
