<?php
namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        // Xóa thông tin admin khỏi session
        $request->session()->forget('admin');
        
        // Đăng xuất admin
        Auth::guard('admin')->logout();

        // Chuyển hướng về trang đăng nhập
        return redirect('/admin');
    }
}