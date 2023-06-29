<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function index() {
        $role = auth()->user()->role;
        if ($role === 'admin') {
            return redirect()->route('dashboard.admin');
        } else if ($role === 'user') {
            dd('See DashboardController, you are a user');
        }
    }

    public function admin() {
        return view('admin.dashboard.index');
    }

    public function image() {
        dd(Str::uuid());
    }
}
