<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PartnerController extends Controller
{
    public function index()
    {
        $partners = Partner::with('items')->latest()->paginate(10);
        return view('partner.index', compact('partners'));
    }

    public function create()
    {
        return view('partner.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'logo' => 'nullable|image',
            'tagline' => 'nullable|string',
            'description' => 'nullable|string',
            'website_url' => 'nullable|url',
            'country' => 'nullable|string',
            'sponsorship_level' => 'required|in:basic,featured,premium'
        ]);

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('partners', 'public');
        }

        $partner = Partner::create($data);

        return redirect()->route('partners.show', $partner)->with('success', 'Partner created!');
    }

    public function show(Partner $partner)
    {
        $partner->load('items');
        return view('partner.show', compact('partner'));
    }

    public function edit(Partner $partner)
    {
        return view('partner.create', compact('partner'));
    }

    public function update(Request $request, Partner $partner)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'logo' => 'nullable|image',
            'tagline' => 'nullable|string',
            'description' => 'nullable|string',
            'website_url' => 'nullable|url',
            'country' => 'nullable|string',
            'sponsorship_level' => 'required|in:basic,featured,premium'
        ]);

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('partners', 'public');
        }

        $partner->update($data);

        return redirect()->route('partners.show', $partner)->with('success', 'Partner updated!');
    }

    public function destroy(Partner $partner)
    {
        $partner->delete();
        return redirect()->route('partner.index')->with('success', 'Partner deleted!');
    }
}

