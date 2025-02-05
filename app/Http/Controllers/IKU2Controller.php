<?php

namespace App\Http\Controllers;

use App\Helpers\HelperPublic;
use App\Models\IKU2;
use App\Models\SelectList;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class IKU2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $breadcrumbs = [
            ['IKU 2', true, route('admin.iku-2.index')],
            ['Index', false],
        ];
        $title = 'Data Indikator Kinerja Utama 2';
        $subtitle = 'Mahasiswa yang menghabiskan paling sedikit 20 (dua puluh) sks di luar kampus, atau meraih prestasi paling rendah tingkat nasional.';
        $items = IKU2::with('select_list')->latest()->get();

        $selects = SelectList::where('type', 'iku-2')->get();

        return view('admin.iku2.index', compact('breadcrumbs', 'title', 'subtitle', 'items', 'selects'));
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
                'location' => 'required|string|max:255',
                'time' => 'required|string|max:255',
                'file' => 'required|file',
            ]);

            $file = $request->file;
            $fileName = str_replace(' ', '', $file->getClientOriginalName());
            $filePath = HelperPublic::helpStoreFileToStorage($file, 'iku-2');

            IKU2::create([
                'name' => $request->name,
                'nim' => $request->nim,
                'select_id' => $request->select_id,
                'description' => $request->description,
                'location' => $request->location,
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
    public function update(Request $request, IKU2 $iku2)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nim' => 'required|string|max:255',
            'select_id' => 'required|exists:select_lists,id',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'time' => 'required|string|max:255',
            'file' => 'nullable|file',
        ]);

        try {
            DB::beginTransaction();
            $fileName = $iku2->file_name;
            $filePath = $iku2->file_path;
            if($request->file('file')) {
                $file = $request->file;

                // delete old file
                if ($filePath != null && Storage::exists($filePath)) {
                    Storage::delete($filePath);
                }

                $fileName = str_replace(' ', '', $file->getClientOriginalName());
                $filePath = HelperPublic::helpStoreFileToStorage($file, 'iku-2');
            }

            $iku2->update([
                'name' => $request->name,
                'nim' => $request->nim,
                'select_id' => $request->select_id,
                'description' => $request->description,
                'location' => $request->location,
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
    public function destroy(IKU2 $iku2)
    {
        $iku2->delete();
        return redirect()->back()->with(['color' => 'bg-success-500', 'message' => __('Berhasil menghapus data')]);
    }

    public function print()
    {
        $headers = [
            'No', 'Nama', 'NIM', 'Jenis Kegiatan', 'Tempat', 'Waktu', 'Deskripsi', 'File'
        ];

        $dataIKU = IKU2::query()->with('select_list')->get()->map(function ($item, $key) {
            return [
                $key + 1,
                $item->name,
                $item->nim,
                $item->select_list->name,
                $item->location,
                $item->time,
                $item->description,
                route('show_file', ['path' => 'iku-4', 'id' => $item->id, 'preview' => true]),
            ];
        });

        return HelperPublic::export(
            'Data Indikator Kinerja Utama 2',
            'Mahasiswa yang menghabiskan paling sedikit 20 (dua puluh) sks di luar kampus, atau meraih prestasi paling rendah tingkat nasional.',
            $headers,
            $dataIKU);
    }
}
