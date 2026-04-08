<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{

    public function update(Request $request, $id)
    {
        $item = Item::findOrFail($id);

        $request->validate([
            'price' => 'required|numeric|min:0',
            'serving' => 'required|integer|min:1',
            'description' => 'required|string|max:500'
        ]);

        $item->price = $request->price;
        $item->serving = $request->serving;
        $item->description = $request->description;

        $item->save();

        return back()->with('success','Item updated successfully');
    }

    public function index()
    {
        return view('admin.items',[
            'foods' => Item::where('category','food')->get(),
            'drinks' => Item::where('category','drink')->get(),
            'desserts' => Item::where('category','dessert')->get(),
        ]);
    }

}