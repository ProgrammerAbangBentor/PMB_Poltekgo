<?php

namespace App\Http\Controllers\Pendaftar;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout()
    {
        Auth::guard('pendaftar')->logout();

        return redirect()->route('login')->with('status', 'Anda telah logout.');
    }
}
