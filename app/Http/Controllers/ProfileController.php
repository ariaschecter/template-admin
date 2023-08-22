<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(): View
    {
        $user = Auth::user();
        $breadcrumbs = [
            ['Dashboard', true, route('dashboard')],
            ['Profile', false],
        ];
        $title = 'Profile';
        return view('profile.index', compact('user', 'breadcrumbs', 'title'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required',
        ]);

        if ($request->password !== null) {
            $request->validate([
                'password' => 'min:8',
                'password_confirmation' => 'same:password',
            ]);
            $validated['password'] = bcrypt($request->password);
        }

        $user->update($validated);

        return Redirect::route('profile.edit');
    }
}
