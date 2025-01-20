<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users-management.user-management', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string|in:Admin,Creator,Member',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $filename = time() . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('public/photos', $filename);
            $user->photo = 'photos/' . $filename;
        }

        $user->save();

        return redirect()->route('user-management')->with('success', 'User created successfully');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'role' => 'required|string|in:Admin,Creator,Member',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($user->photo) {
                Storage::delete('public/' . $user->photo);
            }

            $photo = $request->file('photo');
            $filename = time() . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('public/photos', $filename);
            $user->photo = 'photos/' . $filename;
        }

        if ($request->filled('password')) {
            $request->validate([
                'password' => 'string|min:8'
            ]);
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('user-management')->with('success', 'User updated successfully');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Delete user photo if exists
        if ($user->photo) {
            Storage::delete('public/' . $user->photo);
        }

        $user->delete();

        return redirect()->route('user-management')->with('success', 'User deleted successfully');
    }

    public function show($id)
    {
    $user = User::findOrFail($id);
    return view('users.show', compact('user'));
    }
}
