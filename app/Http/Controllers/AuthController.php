<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // 超级简化：直接设置用户会话，不检查数据库
        $email = $request->email;
        
        if ($email === 'admin@movie.com') {
            session(['user_id' => 1, 'user_name' => 'Admin', 'user_role' => 'admin']);
            return redirect('/movies')->with('success', 'Logged in as Admin');
        }
        
        if ($email === 'user@example.com') {
            session(['user_id' => 2, 'user_name' => 'Regular User', 'user_role' => 'user']);
            return redirect('/movies')->with('success', 'Logged in as User');
        }
        
        return back()->with('error', 'Use: admin@movie.com or user@example.com (any password)');
    }
    
    public function logout()
    {
        session()->flush();
        return redirect('/')->with('success', 'Logged out');
    }
}
