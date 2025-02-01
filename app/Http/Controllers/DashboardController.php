<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function index()
    {
        $role = auth()->user()->role;

        return redirect()->route($role . '.dashboard');
    }

    public function admin()
    {
        $breadcrumbs = [
            ['Utility', route('admin.dashboard')],
            ['Acielana', route('logout')],
        ];
        $breadcrumb_active = 'Blank Page';

        return view('admin.dashboard.index', compact('breadcrumbs', 'breadcrumb_active'));
    }
}
