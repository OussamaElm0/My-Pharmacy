<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class SuperuserController extends Controller
{
    public function users_index()
    {
        return view('superuser.users.index', [
            'users' => User::all(),
        ]);
    }
}
