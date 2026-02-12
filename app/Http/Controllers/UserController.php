<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Usertype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(20);
        return view('user.index', compact('users'));
    }

    public function create()
    {
        $usertypes = Usertype::all();
        return view('user.create', compact('usertypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'dni' => 'required|string|max:60|unique:users,dni',
            'name' => 'required|string|max:60',
            'dob' => 'required|date',
            'sex' => 'required|string|max:10',
            'email' => 'required|email|max:40|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'jod' => 'required|date',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'usertypeID' => 'required|exists:usertypes,usertypeID',
            'username' => 'required|string|min:4|max:40|unique:users,username',
            'password' => 'required|string|min:4',
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        $data['active'] = 1;
        $data['create_date'] = now();
        $data['modify_date'] = now();
        $data['create_userID'] = Auth::id();
        $data['create_username'] = Auth::user()->name;
        $data['create_usertype'] = 'Admin';

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('images', 'public');
            $data['photo'] = basename($path);
        }

        User::create($data);

        return redirect()->route('user.index')->with('success', 'Usuario creado correctamente.');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('user.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $usertypes = Usertype::all();
        return view('user.edit', compact('user', 'usertypes'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'dni' => 'required|string|max:60|unique:users,dni,' . $id . ',userID',
            'name' => 'required|string|max:60',
            'dob' => 'required|date',
            'sex' => 'required|string|max:10',
            'email' => 'required|email|max:40|unique:users,email,' . $id . ',userID',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'jod' => 'required|date',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'usertypeID' => 'required|exists:usertypes,usertypeID',
            'username' => 'required|string|min:4|max:40|unique:users,username,' . $id . ',userID',
            'password' => 'nullable|string|min:4',
        ]);

        $data = $request->all();
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }

        if ($request->hasFile('photo')) {
            if ($user->photo && $user->photo != 'default.png') {
                Storage::disk('public')->delete('images/' . $user->photo);
            }
            $path = $request->file('photo')->store('images', 'public');
            $data['photo'] = basename($path);
        }

        $data['modify_date'] = now();
        $user->update($data);

        return redirect()->route('user.index')->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user->photo && $user->photo != 'default.png') {
            Storage::disk('public')->delete('images/' . $user->photo);
        }
        $user->delete();

        return redirect()->route('user.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
