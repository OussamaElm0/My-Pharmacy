<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pharmacy;
use App\Models\Vente;
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
        return view('ventes.cancel');
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
            Vente::create([
                'pharmacy_id' => $pharmacy->id,
                'product_id' => $product->id,
            ]);
            return redirect()->route('ventes.index')->with('success', 'This sale has been passed successfully');
        }
        return redirect()->back()->with('error', 'This product doesn\'t exist. Please check the code');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $pharmacy = Auth::user()->pharmacy;
        $id = $request->id;

        $product = $pharmacy->products()->find($id);

        if (!is_null($product)){
            $vente = Vente::where('pharmacy_id',$pharmacy->id)
                            ->where('product_id',$product->id)
                            ->first();
            if ($vente){
                $product->pivot->quantity++;
                $product->pivot->save();
                $vente->delete();
                return redirect()->route('ventes.index')->with('success', 'The sale has been canceled successfully.');
            } else {
                return redirect()->back()->with('error', 'This sale doesn\'t exist. Please check the code');
            }

        }
        return redirect()->back()->with('error', 'This product doesn\'t exist. Please check the code');
    }
}
