<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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

    }
}
