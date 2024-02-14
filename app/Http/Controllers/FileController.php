<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pharmacy;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function downloadUsers()
    {
        $users = User::where('pharmacy_id',Auth::user()->pharmacy->id)->get();
        $file = 'users_' . date('Ymdhisa') . '.csv';
        $content = "Id;Name;Email;Role \n";
        foreach ($users as $user) :
            $content .= $user->id . ";" . $user->name . ';' . $user->email . ';' . $user->role->name . "\n" ;
        endforeach;
        Storage::put($file, $content);
        $filePath = storage_path('app/' . $file);

        return response()->download($filePath)->deleteFileAfterSend(true);
    }

    public function downloadProducts() {
        $products = Auth::user()->pharmacy->products()->get();
        $file = 'products_' . date('Ymdhisa') . '.csv';
        $content = "Id;Name;Price;Quantity;Type;Category;Date Importation;Date Expiration\n";

        foreach ($products as $product) :
            $content .= $product->id . ";" . $product->name . ";" . $product->price . ";" . $product->quantity . ";" . $product->type->name . ";"  . $product->category->name . ';' . $product->importation_date . ";" . $product->expiration_date . "\n"  ;
        endforeach;

        Storage::put($file, $content);
        $filePath = storage_path('app/' . $file);

        return response()->download($filePath)->deleteFileAfterSend(true);
    }
}
