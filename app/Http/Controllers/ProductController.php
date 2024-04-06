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
use Illuminate\Support\Facades\Storage;
use JetBrains\PhpStorm\NoReturn;
use function Webmozart\Assert\Tests\StaticAnalysis\null;

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
        switch ($orderBy) {
            case 'Asc':
                $data['products'] = Pharmacy::find(Auth::user()->pharmacy->id)
                    ->products()
                    ->orderBy('quantity')
                    ->paginate(4);
                break;
            case 'Desc':
                $data['products'] = Pharmacy::find(Auth::user()->pharmacy->id)
                    ->products()
                    ->orderByDesc('quantity')
                    ->paginate(4);
                break;
            default:
                $data['products'] = Pharmacy::find(Auth::user()->pharmacy->id)
                    ->products()
                    ->paginate(4);
                break;
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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $productsExist = Product::where('name', $request->name)->first();

        //Check if the product exists or not
        if (!$productsExist) {
            $imageName = time() . "." . $request->file('image')->getClientOriginalExtension();
            // Ensure directory exists
            $imagePath = $request->file('image')->store('images/products');

            $product = Product::create([
                "name" => $request->name,
                "type_id" => $request->type,
                "category_id" => $request->category,
                "price" => $request->price,
                'image' => $imagePath,
                "importation_date" => $request->importation_date,
                "expiration_date" => $request->expiration_date,
            ]);
            $product->pharmacies()->attach(
                Auth::user()->pharmacy->id,
                ['quantity' => $request->quantity]
            );
        } else {
            $productsExist->pharmacies()->syncWithoutDetaching(
                Auth::user()->pharmacy->id,
                ['quantity' => $request->quantity]
            );
        }

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
    public static function updateQuantity(string $id, int $newQuantity)
    {
        $product = Product::find($id);
        $pharmacy = Auth::user()
                    ->pharmacy
                    ->id;
        $product->pharmacies()
                ->updateExistingPivot($pharmacy, ['quantity' => $newQuantity]);
        $product->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Auth::user()->pharmacy
            ->products()
            ->detach($id);

        return redirect()->back();
    }
    /**
     * Display list of products by type
     */
    public function byType(Request $request,string $type)
    {
        $order = $request->query('orderBy');
        switch ($order) {
            case 'Desc' :
                $products = Auth::user()
                    ->pharmacy
                    ->products()
                    ->where('type_id', $type)
                    ->orderByDesc('quantity')
                    ->paginate(4);
                break;
            case 'Asc' :
                $products = Auth::user()
                    ->pharmacy
                    ->products()
                    ->where('type_id', $type)
                    ->orderBy('quantity')
                    ->paginate(4);
                break;
            default:
                $products = Auth::user()
                    ->pharmacy
                    ->products()
                    ->where('type_id', $type)
                    ->paginate(4);
                break;
        }

        return view("products.index", [
            'products' => $products,
            'types' => Type::all(),
            'categories' => Category::all(),
        ]);
    }
    /**
     * Display list of products by searching
     */
    public function search(Request $request)
    {
        if(empty($request->search)) {
            return redirect()->route("products.index");
        }
        $search = "%" . $request->search . "%";
        $products = Auth::user()->pharmacy->products()->where("name", 'like', $search)->paginate(4);

        return view("products.index", [
            'products' => $products,
            'types' => Type::all(),
            'categories' => Category::all(),
        ]);
    }
    /**
     * Display list of products by category
     */
    public function byCategory(Request $request ,int $category)
    {
        $order = $request->query('orderBy');
        switch ($order) {
            case 'Desc' :
                $products = Auth::user()
                    ->pharmacy
                    ->products()
                    ->where('category_id', $category)
                    ->orderByDesc('quantity')
                    ->paginate(4);
                break;
            case 'Asc' :
                $products = Auth::user()
                    ->pharmacy
                    ->products()
                    ->where('category_id', $category)
                    ->orderBy('quantity')
                    ->paginate(4);
                break;
            default:
                $products = Auth::user()
                    ->pharmacy
                    ->products()
                    ->where('category_id', $category)
                    ->paginate(4);
                break;
        }

        return view("products.index", [
            'products' => $products,
            'types' => Type::all(),
            'categories' => Category::all(),
        ]);
    }
}
