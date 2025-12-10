<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Item;
use Inertia\Inertia;

class ItemsController extends Controller
{
    public function index()
    {
        $items = Item::all();

        return Inertia::render('Items/IndexItems', ['items' => $items]);
    }

    public function create()
    {
        return Inertia::render('Items/CreateItem');

    }

    public function store(Request $request)
    {

        // I failed to make this Unique on storing the data

        $request->validate([
            'name' => 'required|unique:items',
            'price' => 'required|numeric',
        ]);
        Item::create($request->all());
        return redirect()->route('items.create')->with('message', 'Item created successfully.');

    }
}
