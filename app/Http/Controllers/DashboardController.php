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
    public function konsumen()
    {
        $breadcrumbs = [
            ['Utility', route('konsumen.dashboard')],
            ['Acielana', route('logout')],
        ];
        $breadcrumb_active = 'Blank Page';

        $user = auth()->user();

        $application = Application::where('user_id', $user->id)->first();

        if (!$application) {

        }

        return view('konsumen.dashboard.index', compact('breadcrumbs', 'breadcrumb_active'));
    }
    public function dealer()
    {
        $breadcrumbs = [
            ['Utility', route('dealer.dashboard')],
            ['Acielana', route('logout')],
        ];
        $breadcrumb_active = 'Blank Page';

        return view('dealer.dashboard.index', compact('breadcrumbs', 'breadcrumb_active'));
    }
    public function marketing()
    {
        $breadcrumbs = [
            ['Utility', route('marketing.dashboard')],
            ['Acielana', route('logout')],
        ];
        $breadcrumb_active = 'Blank Page';

        return view('marketing.dashboard.index', compact('breadcrumbs', 'breadcrumb_active'));
    }

    public function atasan()
    {
        $breadcrumbs = [
            ['Utility', route('atasan.dashboard')],
            ['Acielana', route('logout')],
        ];
        $breadcrumb_active = 'Blank Page';

        return view('atasan.dashboard.index', compact('breadcrumbs', 'breadcrumb_active'));
    }
}
