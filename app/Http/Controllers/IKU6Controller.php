<?php

namespace App\Http\Controllers;

use App\Helpers\HelperPublic;
use App\Models\IKU6;
use App\Models\SelectList;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class IKU6Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $breadcrumbs = [
            ['IKU 6', true, route('admin.iku-6.index')],
            ['Index', false],
        ];
        $title = 'Data Indikator Kinerja Utama 6';
        $subtitle = 'Program studi bekerja sama dengan mitra kelas dunia.';
        $items = IKU6::with('select_list')->latest()->get();

        $selects = SelectList::where('type', 'iku-6')->get();

        return view('admin.iku6.index', compact('breadcrumbs', 'title', 'subtitle', 'items', 'selects'));
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
                'institution_type' => 'required|string|max:255',
                'select_id' => 'required|exists:select_lists,id',
                'nomor' => 'required|string|max:255',
                'time' => 'required|string|max:255',
                'file' => 'nullable|file',
            ]);

            $file = $request->file;
            $fileName = str_replace(' ', '', $file->getClientOriginalName());
            $filePath = HelperPublic::helpStoreFileToStorage($file, 'iku-6');

            IKU6::create([
                'name' => $request->name,
                'institution_type' => $request->institution_type,
                'select_id' => $request->select_id,
                'nomor' => $request->nomor,
                'time' => $request->time,
                'file_name' => $fileName,
                'file_path' => $filePath,
            ]);

            DB::commit();

            return redirect()->back()->with(['color' => 'bg-success-500', 'message' => __('Berhasil menambahkan data')]);
        } catch (Exception $e) {
            $message = $e->getMessage();
            DB::rollback();
            return redirect()->back()->with(['color' => 'bg-danger-500', 'message' => __($message)]);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, IKU6 $iku6)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'institution_type' => 'required|string|max:255',
            'select_id' => 'required|exists:select_lists,id',
            'nomor' => 'required|string|max:255',
            'time' => 'required|string|max:255',
            'file' => 'nullable|file',
        ]);

        try {
            DB::beginTransaction();
            $fileName = $iku6->file_name;
            $filePath = $iku6->file_path;
            if($request->file('file')) {
                $file = $request->file;

                // delete old file
                if ($filePath != null && Storage::exists($filePath)) {
                    Storage::delete($filePath);
                }

                $fileName = str_replace(' ', '', $file->getClientOriginalName());
                $filePath = HelperPublic::helpStoreFileToStorage($file, 'iku-6');
            }

            $iku6->update([
                'name' => $request->name,
                'institution_type' => $request->institution_type,
                'select_id' => $request->select_id,
                'nomor' => $request->nomor,
                'time' => $request->time,
                'file_name' => $fileName,
                'file_path' => $filePath,
            ]);

            DB::commit();

            return redirect()->back()->with(['color' => 'bg-success-500', 'message' => __('Berhasil mengubah data')]);
        } catch (Exception $e) {
            $message = $e->getMessage();
            DB::rollback();
            return redirect()->back()->with(['color' => 'bg-danger-500', 'message' => __($message)]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IKU6 $iku6)
    {
        $iku6->delete();
        return redirect()->back()->with(['color' => 'bg-success-500', 'message' => __('Berhasil menghapus data')]);
    }

    public function print()
    {
        $headers = [
            'No', 'Nama Mitra', 'Jenis Lembaga', 'Jenis Berkas', 'Nomor', 'Jangka Waktu', 'File'
        ];

        $dataIKU = IKU6::query()->with('select_list')->get()->map(function ($item, $key) {
            return [
                $key + 1,
                $item->name,
                $item->institution_type,
                $item->select_list->name,
                $item->nomor,
                $item->time,
                route('show_file', ['path' => 'iku-6', 'id' => $item->id, 'preview' => true]),
            ];
        });

        return HelperPublic::export(
            'Data Indikator Kinerja Utama 6',
            'Program studi bekerja sama dengan mitra kelas dunia.',
            $headers,
            $dataIKU);
    }
}
