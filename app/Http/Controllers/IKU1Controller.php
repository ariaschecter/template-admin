<?php

namespace App\Http\Controllers;

use App\Models\IKU1;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $title = 'All IKU1';
        $users = IKU1::latest()->get();
        return view('admin.iku1.index', compact('breadcrumbs', 'title', 'users'));
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
            'file' => 'required|file|image',
        ]);

        IKU1::create([
            'name' => $request->name,
            'nim' => $request->nim,
            'description' => $request->description,
        ]);

        try {
            DB::beginTransaction();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }

        return redirect()->route('admin.iku-1.index')->with(['color' => 'bg-success-500', 'message' => __('iku1.success.store')]);
    }

    /**
     * Display the specified resource.
     */
    public function show(IKU1 $iku1)
    {
        $breadcrumbs = [
            ['IKU 1', true, route('admin.user.index')],
            [$iku1->name, false],
        ];
        $title = $iku1->name;
        $editable = false;
        return view('admin.user.edit', compact('breadcrumbs', 'title', 'user', 'editable'));
    }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(IKU1 $iku1)
    // {
    //     $breadcrumbs = [
    //         ['IKU 1', true, route('admin.user.index')],
    //         [$user->name, false],
    //     ];
    //     $title = $user->name;
    //     $editable = true;
    //     return view('admin.user.edit', compact('breadcrumbs', 'title', 'user', 'editable'));
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, IKU1 $iku1)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        try {
            DB::beginTransaction();

            $iku1->update($validated);

            DB::commit();

            return redirect()->route('admin.user.index')->with(['color' => 'bg-success-500', 'message' => __('user.success.store')]);
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
        return redirect()->back();
    }
}
