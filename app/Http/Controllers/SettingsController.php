<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        dd();
        $user = User::find(1);
        Auth::login($user);
        if ($user->avatar) {
            $user->avatar = asset('storage/' . $user->avatar);
        }
        return Inertia::render('Settings/IndexSettings', ['users' => $user]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request)

    {
        $request->validate([
            'avatar' => 'nullable|image|max:2048'
        ]);

        $user = User::first();


        if ($request->hasFile('avatar')) {
            $user->update([
                'avatar' => $request->file('avatar')->store('avatars', 'public')
            ]);
        }
        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
