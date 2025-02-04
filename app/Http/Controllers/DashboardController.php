<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\IKU1;
use App\Models\IKU2;
use App\Models\IKU3;
use App\Models\IKU4;
use App\Models\IKU5;
use App\Models\IKU6;
use App\Models\IKU7;
use App\Models\IKU8;
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
            case 'iku-2': $file = IKU2::find($id); break;
            case 'iku-3': $file = IKU3::find($id); break;
            case 'iku-4': $file = IKU4::find($id); break;
            case 'iku-5': $file = IKU5::find($id); break;
            case 'iku-6': $file = IKU6::find($id); break;
            case 'iku-7': $file = IKU7::find($id); break;
            case 'iku-8': $file = IKU8::find($id); break;
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
