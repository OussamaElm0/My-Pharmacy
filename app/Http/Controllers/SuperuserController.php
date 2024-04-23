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
    public function users_store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role_id' => ['required'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'cni' => $request->cni,
            'pharmacy_id' => $request->pharmacy_id,
            'role_id' => $request->role_id,
        ]);

        event(new UserCreatedEvent($user));

        return redirect()->route('superuser.users.index')->with('success', 'User created succefully');
    }
}
