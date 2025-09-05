<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ItemController extends Controller
{
    /**
     * Show form for creating a new item for a partner
     */
    public function create(Partner $partner)
    {
        return view('items.create', compact('partner'));
    }

    /**
     * Store a newly created item
     */
    public function store(Request $request, Partner $partner)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('items', 'public');
        }

        $partner->items()->create($data);

        return redirect()->route('partners.show', $partner)->with('success', 'Item added successfully!');
    }

    /**
     * Show form for editing an existing item
     */
    public function edit(Partner $partner, Item $item)
    {
        return view('items.edit', compact('partner', 'item'));
    }

    /**
     * Update an existing item
     */
    public function update(Request $request, Partner $partner, Item $item)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('items', 'public');
        }

        $item->update($data);

        return redirect()->route('partners.show', $partner)->with('success', 'Item updated successfully!');
    }

    /**
     * Delete an item
     */
    public function destroy(Partner $partner, Item $item)
    {
        $item->delete();

        return redirect()->route('partners.show', $partner)->with('success', 'Item deleted successfully!');
    }
}
