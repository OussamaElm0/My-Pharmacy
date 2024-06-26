<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\UserCreated;
use App\Models\Role;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use App\Events\UserCreatedEvent;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('pharmacy_id',Auth::user()->pharmacy->id)->paginate(5);

        return view('admin.usersList', [
            'users' => $users,
            'roles' => Role::all(),
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.createUser', [
            'roles' => Role::all(),
        ]);
    }
    public function byRole(int $role)
    {
        $users = User::where('role_id',$role)
                ->where('pharmacy_id', Auth::user()->pharmacy_id)
                ->paginate(5);

        return view('admin.usersList', [
            'users' => $users,
            'roles' => Role::all(),
        ]);
    }
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
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
            'pharmacy_id' => $request->pharmacy_id ?? Auth::user()->pharmacy->id,
            'role_id' => $request->role_id,
        ]);

        event(new UserCreatedEvent($user));

        if (Auth::user()->role->name == "Superuser"){
            return redirect()->route('superuser.users.index')->with('success', 'User created successfully');
        }

        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function search(Request $request)
    {
        if(empty($request->search)) {
            return redirect()->route("users.index");
        }
        $pharmacy_id = Auth::user()->pharmacy->id;
        $search = '%' . $request->search . '%';
        $users = User::where('name','like',$search)
                        ->where('pharmacy_id',$pharmacy_id)
                        ->paginate(5);
        return view('admin.usersList', [
            'users' => $users,
            'roles' => Role::all(),
            'search' => $request->search,
        ]);
    }
    public function show(string $id)
    {
        return view('admin.showUser', [
            'user' => User::find($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view("admin.edit", [
            'user' => User::find($id),
            'roles' => Role::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;

        $user->save();

        if (Auth::user()->role->name == "Superuser"){
            return redirect()->route('superuser.users.index')->with('success', 'User created successfully');
        }

        return redirect()->route('users.show', ['user' => $user->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::destroy($id);

        return redirect()->back();
    }
}
