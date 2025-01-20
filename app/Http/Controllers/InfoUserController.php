<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class InfoUserController extends Controller
{
    public function create()
    {
        return view('users.user-profile');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore(Auth::user()->id)],
            'phone' => ['nullable', 'max:50'],
            'location' => ['nullable', 'max:70'],
            'about_me' => ['nullable', 'max:150'],
            'password' => ['nullable', 'string', 'min:8'], // Optional untuk password baru
            'role' => ['required', 'string', 'in:Admin,Creator,Member'], // Wajib diisi
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'], // Foto opsional
        ]);

        $user = Auth::user();

        // Update data user
        $user->name = $attributes['name'];
        $user->email = $attributes['email'];
        $user->phone = $attributes['phone'] ?? $user->phone;
        $user->location = $attributes['location'] ?? $user->location;
        $user->about_me = $attributes['about_me'] ?? $user->about_me;
        $user->role = $attributes['role'];

        // Update password jika diisi
        if (!empty($attributes['password'])) {
            $user->password = Hash::make($attributes['password']);
        }

        // Update photo jika ada file
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($user->photo) {
                Storage::delete('public/' . $user->photo);
            }

            $photo = $request->file('photo');
            $filename = time() . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('public/photos', $filename);
            $user->photo = 'photos/' . $filename;
        }

        $user->save();

        return redirect('/user-profile')->with('success', 'Profile updated successfully');
    }
}
