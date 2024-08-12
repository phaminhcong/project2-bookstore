<?php
namespace App\Http\Controllers\Customer\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutCustomerController extends Controller
{
    public function logout(Request $request)
    {
        // Xóa thông tin admin khỏi session
        $request->session()->forget('customer');
        
        // Đăng xuất admin
        Auth::guard('customer')->logout();

        // Chuyển hướng về trang đăng nhập
        session()->forget('url.intended');
        return redirect('/cilent');
    }
}