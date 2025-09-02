<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Ppat;

class UserController extends Controller
{
   public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $ppats = \App\Models\Ppat::all();
         return view('admin.users.create', compact('ppats'));
    }

    public function store(Request $request)
    {
        $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
        'role' => 'required',
    ]);
    // Validasi manual id_ppat jika role notaris
    if ($request->role === 'notaris' && !empty($request->id_ppat)) {
    $exists = DB::table('public.ppat')->where('id', $request->id_ppat)->exists();
    if (! $exists) {
        return back()->withErrors(['id_ppat' => 'PPAT tidak ditemukan'])->withInput();
    }
}

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'role' => $request->role,
        'id_ppat' => $request->role === 'notaris' ? $request->id_ppat : null,
    ]);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function edit(User $user)
{
    $ppats = Ppat::all();
    return view('admin.users.edit', compact('user', 'ppats'));
}

public function update(Request $request, User $user)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
        'role' => 'required|in:admin,notaris,user', // sesuaikan jika ada role lain
        'id_ppat' => 'nullable|integer',
    ]);

    // Validasi manual id_ppat jika role notaris
    if ($request->role === 'notaris') {
        if (empty($request->id_ppat)) {
            return back()->withErrors(['id_ppat' => 'PPAT harus dipilih jika role adalah notaris'])->withInput();
        }

        $exists = DB::table('public.ppat')->where('id', $request->id_ppat)->exists();
        if (! $exists) {
            return back()->withErrors(['id_ppat' => 'PPAT tidak ditemukan'])->withInput();
        }
    }

    // Update data user
    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'role' => $request->role,
        'id_ppat' => $request->role === 'notaris' ? $request->id_ppat : null,
    ]);

    return redirect()->route('admin.users.index')->with('success', 'User berhasil diubah.');
}

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
    }
}
