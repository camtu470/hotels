<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @return string
     */
    protected function redirectTo()
    {
        $user = Auth::user();

        // Nếu có một URL đã được lưu trữ trước đó (trong session), redirect tới URL đó
        if (session()->has('url.intended')) {
            return session()->get('url.intended');
        }

        // Dựa theo role, chuyển hướng đến trang dashboard hoặc index
        switch ($user->role) {
            case 'admin':
                return '/admin/dashboard';  // Trang admin
            case 'user':
                return '/customer/index';   // Trang user
            default:
                return '/home';             // Trang mặc định nếu role không xác định
        }
    }
}