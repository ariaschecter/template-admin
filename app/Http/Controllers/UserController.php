<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $breadcrumbs = [
            ['User', true, route('admin.user.index')],
            ['Index', false],
        ];
        $title = 'All Users';
        $users = User::latest()->get();
        return view('admin.user.index', compact('breadcrumbs', 'title', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $breadcrumbs = [
            ['User', true, route('admin.user.index')],
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'email_verified_at' => now()
        ]);

        return redirect()->route('admin.user.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $breadcrumbs = [
            ['User', true, route('admin.user.index')],
            [$user->name, false],
        ];
        $title = $user->name;
        return view('admin.user.show', compact('breadcrumbs', 'title', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $role = $user->role;
        if ($role == 'admin') {
            $new_role = 'user';
        } else {
            $new_role = 'admin';
        }

        $user->update([
            'role' => $new_role
        ]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back();
    }

    public function archive() {
        $breadcrumbs = [
            ['User', true, route('admin.user.index')],
            ['Archive', false],
        ];
        $title = 'Archive User';
        $users = User::onlyTrashed()->get();
        return view('admin.user.archive', compact('breadcrumbs', 'title', 'users'));
    }

    public function restore($id) {
        User::withTrashed()->where('id', $id)->restore();
        return redirect()->back();
    }
}
