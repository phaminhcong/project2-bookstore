<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            // Lưu URL đầy đủ vào session
            session(['url.intended' => $request->fullUrl()]);

            // Kiểm tra guard để xác định người dùng là admin hay customer và chuyển hướng tương ứng
            if ($request->is('admin/*')) {
                return route('admin.login');
            }
            return route('customer.login');
        }
    }
}
