<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\IKU1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
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

    public function show_file(Request $request, $path, $id) {
        $file = null;
        switch ($path) {
            case 'iku-1': $file = IKU1::find($id); break;
            default: return abort(404);
        }

        if($file) {

            $path = storage_path('app/' . $file->file_path);
            $fileName = $file->file_name;

            if(File::exists($path)) {
                if($request->filled('preview')) {
                    if(filter_var($request->preview, FILTER_VALIDATE_BOOLEAN) == true) {
                        return response()->file($path);
                    }
                    else {
                        return response()->download($path, $fileName);
                    }
                }
                else {
                    return response()->download($path, $fileName);
                }
            }
        }

        return abort(404);

    }
}
