<?php

namespace App\Http\Controllers;

use App\Http\Requests\KonsumenApplicationStoreRequest;
use App\Models\Application;
use App\Models\ApplicationDetail;
use App\Models\ApplicationDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            ['User', true, route('admin.user.index')],
            ['Index', false],
        ];
        $title = 'All Applications';
        $applications = Application::latest()->get();
        return view('admin.application.index', compact('breadcrumbs', 'title', 'applications'));
    }



    public function konsumenIndex()
    {
        $breadcrumbs = [
            ['User', true, route('konsumen.application.index')],
            ['Index', false],
        ];
        $title = 'All Applications';
        $applications = Application::where('user_id', Auth::id())->get();

        return view('konsumen.application.index', compact('breadcrumbs', 'title', 'applications'));
    }

    public function konsumenCreate()
    {
        $breadcrumbs = [
            ['User', true, route('konsumen.application.index')],
            ['Index', false],
        ];
        $title = 'All Applications';
        $applications = Application::latest()->get();
        return view('konsumen.application.create', compact('breadcrumbs', 'title', 'applications'));
    }
    public function konsumenStore(KonsumenApplicationStoreRequest $request)
    {
        $validated = $request->validated();

        $user = auth()->user();

        $application = Application::create([
            'user_id' => $user->id,
        ]);

        $bukti_bayar = $validated['bukti_bayar'];
        $form_aplikasi = $validated['form_aplikasi'];
        $kartu_keluarga = $validated['kartu_keluarga'];

        $validated['application_id'] = $application->id;

        unset($validated['bukti_bayar']);
        unset($validated['form_aplikasi']);
        unset($validated['kartu_keluarga']);

        $bukti_bayar = $bukti_bayar->store();
        $form_aplikasi = $form_aplikasi->store();
        $kartu_keluarga = $kartu_keluarga->store();

        ApplicationDetail::create($validated);

        ApplicationDocument::create([
            'file_path'      => $bukti_bayar,
            'document_type'  => 'bukti_bayar',
            'application_id' => $application->id
        ]);
        ApplicationDocument::create([
            'file_path'      => $form_aplikasi,
            'document_type'  => 'form_aplikasi',
            'application_id' => $application->id
        ]);
        ApplicationDocument::create([
            'file_path'      => $kartu_keluarga,
            'document_type'  => 'kartu_keluarga',
            'application_id' => $application->id
        ]);

        return redirect()->back()->with(['color' => 'bg-success-500', 'message' => __('Berhasil Submit Application')]);
    }
}
