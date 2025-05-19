<?php

namespace App\Http\Middleware;



use Illuminate\Auth\Middleware\Authenticate as Middleware;

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
        // Người dùng chưa đăng nhập => redirect về trang đăng nhập hoặc /home
        if (!$request->expectsJson()) {
            return route('login'); // hoặc route('login') nếu bạn có route đăng nhập riêng
        }
    }
}