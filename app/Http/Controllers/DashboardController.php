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
            return redirect()->route('admin.dashboard');
        } else if ($role === 'user') {
            dd('See DashboardController, you are a user');
        }
    }

    public function admin() {
        $breadcrumbs = [
            ['Utility', route('admin.dashboard')],
            ['Acielana', route('logout')],
        ];
        $breadcrumb_active = 'Blank Page';

        return view('admin.dashboard.index', compact('breadcrumbs', 'breadcrumb_active'));
    }

    public function image() {
        dd(Str::uuid());
    }
}
