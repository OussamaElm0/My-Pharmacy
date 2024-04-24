<?php

namespace App\Http\Controllers;

use App\Events\UserCreatedEvent;
use App\Http\Controllers\Controller;
use App\Models\Pharmacy;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class SuperuserController extends Controller
{
    public function users_index()
    {
        return view('superuser.users.index', [
            'users' => User::all(),
        ]);
    }
    public function users_create(){
        return view('superuser.users.create',[
            'pharmacies' => Pharmacy::all(),
            'roles' => Role::all()
        ]);
    }
}
