<?php

namespace App\Http\Controllers;

use App\Helpers\HelperPublic;
use App\Models\IKU1;
use App\Models\SelectList;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class IKU1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $breadcrumbs = [
            ['IKU 1', true, route('admin.user.index')],
            ['Index', false],
        ];
        $title = 'Data Indikator Kinerja Utama 1';
        $subtitle = 'Lulusan berhasil mendapat pekerjaan yang layak, melanjutkan studi, atau menjadi wiraswasta.';
        $items = IKU1::with('select_list')->latest()->get();

        $selects = SelectList::where('type', 'iku-1')->get();

        return view('admin.iku1.index', compact('breadcrumbs', 'title', 'subtitle', 'items', 'selects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $breadcrumbs = [
            ['IKU 1', true, route('admin.user.index')],
            ['Create', false],
        ];
        $title = 'Create User';
        return view('admin.user.create', compact('breadcrumbs', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nim' => 'required|string|max:255',
            'select_id' => 'required|exists:select_lists,id',
            'description' => 'required|string',
            'file' => 'required|file',
        ]);

        $file = $request->file;
        $fileName = str_replace(' ', '', $file->getClientOriginalName());
        $filePath = HelperPublic::helpStoreFileToStorage($file, 'iku-1');

        IKU1::create([
            'name' => $request->name,
            'nim' => $request->nim,
            'select_id' => $request->select_id,
            'description' => $request->description,
            'file_name' => $fileName,
            'file_path' => $filePath,
        ]);

        try {
            DB::beginTransaction();
            DB::commit();
        } catch (Exception $e) {
            dd($e);
            DB::rollback();
        }

        return redirect()->route('admin.iku-1.index')->with(['color' => 'bg-success-500', 'message' => __('iku1.success.store')]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, IKU1 $iku1)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nim' => 'required|string|max:255',
            'select_id' => 'required|exists:select_lists,id',
            'description' => 'required|string',
            'file' => 'nullable|file|image',
        ]);

        try {
            DB::beginTransaction();
            $fileName = $iku1->file_name;
            $filePath = $iku1->file_path;
            if($request->file('file')) {
                $file = $request->file;

                // delete old file
                if ($filePath != null && Storage::exists($filePath)) {
                    Storage::delete($filePath);
                }

                $fileName = str_replace(' ', '', $file->getClientOriginalName());
                $filePath = HelperPublic::helpStoreFileToStorage($file, 'iku-1');
            }

            $iku1->update([
                'name' => $request->name,
                'nim' => $request->nim,
                'select_id' => $request->select_id,
                'description' => $request->description,
                'file_name' => $fileName,
                'file_path' => $filePath,
            ]);

            DB::commit();

            return redirect()->route('admin.iku-1.index')->with(['color' => 'bg-success-500', 'message' => __('iku1.success.update')]);
        } catch (Exception $e) {
            DB::rollback();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IKU1 $iku1)
    {
        $iku1->delete();
        return redirect()->back()->with(['color' => 'bg-success-500', 'message' => __('iku1.success.destroy')]);
    }
}
