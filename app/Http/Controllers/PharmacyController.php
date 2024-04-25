<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pharmacy;
use Illuminate\Http\Request;

class PharmacyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pharmacies.index',[
            'pharmacies' => Pharmacy::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pharmacies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'inpe' => 'required'
        ]);
        Pharmacy::create($request->all());

        return redirect()->route('pharmacies.index')->with('success', 'Pharmacy created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('pharmacies.show', [
            'pharmacy' => Pharmacy::find($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('pharmacies.edit', [
            'pharmacy' => Pharmacy::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'inpe' => 'required'
        ]);
        Pharmacy::find($id)->update($request->all());

        return redirect()->route('pharmacies.index')->with('success', 'Pharmacy updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Pharmacy::destroy($id);

        return redirect()->route('pharmacies.index');
    }
}
