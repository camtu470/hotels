<?php

namespace App\Http\Controllers;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('index');  // Đảm bảo đã đăng nhập mới vào được
    }

    public function index()
    {
        // Kiểm tra nếu người dùng đã đăng nhập
        if (Auth::check()) {
            $user = Auth::user();

            // Nếu là admin, chuyển hướng tới trang dashboard
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            // Nếu là user, chuyển hướng tới trang customer.index
            if ($user->role === 'user') {
                return redirect()->route('customer.index');
            }
        }

        // Nếu chưa đăng nhập, giữ trang home
        // return view('home');

        $branches = Branch::all();
        return view('home', compact('branches'));
    }
}