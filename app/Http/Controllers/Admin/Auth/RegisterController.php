<?php

namespace App\Http\Controllers\Admin\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function show() {
        return view('admin.auth.register');
    }
    public function store(Request $request) {
        $validator = Validator::make($request-> all(), [
            'username' => 'required|max:255',
            'email' => 'required|unique:admin',
            'phone_number' =>'required|unique:admin',
            'password' => 'required|min:8'
        ],
        [
            'username.required' => 'Họ và tên không được để trống',
            'username.max' => 'Không được vượt quá 255 kí tự',
            'email.required' => 'Email không được để trống',
            'email.unique' => 'Email đã tồn tại',
            'phone_number.required' => 'Số điện thoại không được để trống',
            'phone_number.unique' => 'Số điện thoại đã được sử dụng ',
            'password.required' => 'Vui lòng tạo mật khẩu',
            'password.min' => 'Mật khẩu phải trên 8 kí tự'
        ]
    
    );
    if ($validator->fails()) {
        return redirect() -> route('register.show') ->withErrors($validator) ->withInput();
    }
        $admin = new Admin();
        $admin -> username = $request->username;
        $admin -> email = $request->email;
        $admin -> phone_number = $request->phone_number;
        $admin -> level = 1;
        $password = $request->input('password');
        $admin->setPassword($password);
        $admin -> save();
        return redirect()->route('admin.logout');
    }
}
