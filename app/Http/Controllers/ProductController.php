<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Pharmacy;
use App\Models\Product;
use App\Models\Type;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use JetBrains\PhpStorm\NoReturn;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = [
            'products',
            'types' => Type::all(),
            'categories' => Category::all(),
        ];
        $orderBy = $request->query->get('orderBy');
        if(empty($orderBy)){
            $data['products'] = Pharmacy::find(Auth::user()->pharmacy->id)->products()->get();
        }

        if($orderBy == 'Desc') {
            $data['products'] = Pharmacy::find(Auth::user()->pharmacy->id)->products()->orderByDesc('quantity')->get();
        } else if ($orderBy == 'Asc') {
            $data['products'] = Pharmacy::find(Auth::user()->pharmacy->id)->products()->orderBy('quantity')->get();
        }
        return view('products.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create', [
            'types' => Type::all(),
            'categories' => Category::all(),
            'today' => Carbon::now()->toDateString(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|numeric|min:0',
            'importation_date' => 'required|date',
            'expiration_date' => 'required|date|after:importation_date',
        ]);

        $product = Product::create([
            "name" => $request->name,
            "type_id" => $request->type,
            "category_id" => $request->category,
            "price" => $request->price,
            "quantity" => $request->quantity,
            "importation_date" => $request->importation_date,
            "expiration_date" => $request->expiration_date,
        ]);
        $product->pharmacies()->syncWithoutDetaching(Auth::user()->pharmacy->id);

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Auth::user()->pharmacy->products()->findOrFail($id);

        return view('products.show', [
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Auth::user()->pharmacy->products()->findOrFail($id);

        return view("products.edit", [
            'product' => $product,
            'types' => Type::all(),
            'categories' => Category::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);
        $product->update($request->all());

        return redirect()->route("products.index");
    }

    static
    public function updateQuantity(string $id, int $newQuantity)
    {
        $product = Product::find($id);
        $product->quantity = $newQuantity;
        $product->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::findOrFail($id)->delete();

        return redirect()->route('products.index');
    }

    public function byType(string $type)
    {
        $products = Auth::user()->pharmacy->products()->where('type_id', $type)->get();

        return view("products.index", [
            'products' => $products,
            'types' => Type::all(),
            'categories' => Category::all(),
        ]);
    }

    public function search(Request $request)
    {
        $search = "%" . $request->search . "%";
        $products = Auth::user()->pharmacy->products()->where("name", 'like', $search)->get();

        return view("products.index", [
            'products' => $products,
            'types' => Type::all(),
            'categories' => Category::all(),
        ]);
    }

    public function byCategory(int $category)
    {
        $products = Auth::user()->pharmacy->products()->where('category_id', $category)->get();

        return view('products.index', [
            'products' => $products,
            'types' => Type::all(),
            "categories" => Category::all(),
        ]);
    }
}
