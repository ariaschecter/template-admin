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
            ['IKU 1', true, route('admin.iku-1.index')],
            ['Index', false],
        ];
        $title = 'Data Indikator Kinerja Utama 1';
        $subtitle = 'Lulusan berhasil mendapat pekerjaan yang layak, melanjutkan studi, atau menjadi wiraswasta.';
        $items = IKU1::with('select_list')->latest()->get();

        $selects = SelectList::where('type', 'iku-1')->get();

        return view('admin.iku1.index', compact('breadcrumbs', 'title', 'subtitle', 'items', 'selects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
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

            DB::commit();

            return redirect()->route('admin.iku-1.index')->with(['color' => 'bg-success-500', 'message' => __('Berhasil menambahkan data')]);
        } catch (Exception $e) {
            $message = $e->getMessage();
            DB::rollback();
            return redirect()->back()->with(['color' => 'bg-danger-500', 'message' => __($message)]);
            DB::rollback();
        }

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
            'file' => 'nullable|file',
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

            return redirect()->route('admin.iku-1.index')->with(['color' => 'bg-success-500', 'message' => __('Berhasil mengubah data')]);
        } catch (Exception $e) {
            $message = $e->getMessage();
            DB::rollback();
            return redirect()->back()->with(['color' => 'bg-danger-500', 'message' => __($message)]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IKU1 $iku1)
    {
        $iku1->delete();
        return redirect()->back()->with(['color' => 'bg-success-500', 'message' => __('Berhasil menghapus data')]);
    }

    public function print()
    {
        $headers = [
            'No', 'Nama', 'NIM', 'Jenis Kegiatan', 'Deskripsi', 'File'
        ];

        $dataIKU = IKU1::query()->with('select_list')->get()->map(function ($item, $key) {
            return [
                $key + 1,
                $item->name,
                $item->nim,
                $item->select_list->name,
                $item->description,
                route('show_file', ['path' => 'iku-1', 'id' => $item->id, 'preview' => true]),
            ];
        });

        return HelperPublic::export(
            'Data Indikator Kinerja Utama 1',
            'Lulusan berhasil mendapat pekerjaan yang layak, melanjutkan studi, atau menjadi wiraswasta.',
            $headers,
            $dataIKU);
    }
}
