<?php

namespace App\Http\Controllers;

use App\Models\Signature;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GuestBookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $signatures = Signature::all();
        return Inertia::render('GuestBook/IndexGuestBook', ['signatures' => $signatures]);
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
        $request->validate([
            'name' => 'required|string|max:255',
            'message' => 'string|nullable|max:255',
        ]);

        Signature::create($request->all());

        return redirect()->route('guestbook.index')->with('message', 'You are welcome ' . $request->name . '! It\'s great to have you here.');
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
