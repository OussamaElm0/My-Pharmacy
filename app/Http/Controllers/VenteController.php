<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pharmacy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('ventes.index');
    }

    /**
     * Display a form to cancel an sale
     */
    public function cancel()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ventes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pharmacy = Auth::user()->pharmacy;
        $id = $request->id;

        $product = $pharmacy->products()->find($id);

        if(!is_null($product)) {
            $product->pivot->quantity--;
            $product->pivot->save();
            return redirect()->route('ventes.index')->with('success', 'This sale was passed successfully');
        }
        return redirect()->back()->with('error', 'This product doesn\'t exist. Please check the code');
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
