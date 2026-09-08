<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Tampilkan daftar user pengelola sistem
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $roleFilter = $request->query('role');

        $query = User::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($roleFilter) {
            $query->where('role', $roleFilter);
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        $stats = [
            'total'         => User::count(),
            'admin'         => User::where('role', 'Administrator')->count(),
            'penguji_tpq'   => User::where('role', 'Penguji TPQ')->count(),
            'penguji_rtq'   => User::where('role', 'Penguji RTQ')->count(),
            'panitia'       => User::where('role', 'Panitia')->count(),
        ];

        return view('users.index', compact('users', 'stats', 'search', 'roleFilter'));
    }

    /**
     * Form tambah user baru
     */
    public function create()
    {
        $roles = ['Administrator', 'Penguji TPQ', 'Penguji RTQ', 'Panitia'];
        return view('users.create', compact('roles'));
    }

    /**
     * Simpan user baru ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:users,username|regex:/^[a-zA-Z0-9_.-]+$/',
            'email'    => 'required|email|max:255|unique:users,email',
            'role'     => 'required|string|in:Administrator,Penguji TPQ,Penguji RTQ,Panitia',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'username.regex'     => 'Username hanya boleh berisi huruf, angka, garis bawah (_), titik (.), atau tanda hubung (-).',
            'username.unique'    => 'Username ini sudah digunakan, silakan pilih yang lain.',
            'email.unique'       => 'Email ini sudah terdaftar di sistem.',
            'password.min'       => 'Password minimal harus 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        User::create([
            'name'     => $request->name,
            'username' => $request->username,
            'email'    => $request->email,
            'role'     => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index')->with('success', "User '{$request->name}' berhasil ditambahkan ke sistem.");
    }

    /**
     * Form edit data user
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = ['Administrator', 'Penguji TPQ', 'Penguji RTQ', 'Panitia'];
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Perbarui data user
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'     => 'required|string|max:255',
            'username' => [
                'required', 'string', 'max:50',
                Rule::unique('users', 'username')->ignore($user->id),
                'regex:/^[a-zA-Z0-9_.-]+$/',
            ],
            'email'    => [
                'required', 'email', 'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'role'     => 'required|string|in:Administrator,Penguji TPQ,Penguji RTQ,Panitia',
            'password' => 'nullable|string|min:6|confirmed',
        ], [
            'username.regex'     => 'Username hanya boleh berisi huruf, angka, garis bawah (_), titik (.), atau tanda hubung (-).',
            'username.unique'    => 'Username ini sudah digunakan.',
            'email.unique'       => 'Email ini sudah terdaftar.',
            'password.min'       => 'Password baru minimal harus 6 karakter.',
            'password.confirmed' => 'Konfirmasi password baru tidak cocok.',
        ]);

        $data = [
            'name'     => $request->name,
            'username' => $request->username,
            'email'    => $request->email,
            'role'     => $request->role,
        ];

        // Ganti password hanya jika diisi
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        // Update nama di session jika user mengedit profilnya sendiri
        if (session('user_id') == $user->id) {
            session(['user_name' => $user->name]);
        }

        return redirect()->route('users.index')->with('success', "Data user '{$user->name}' berhasil diperbarui.");
    }

    /**
     * Hapus user dari sistem
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Jangan izinkan user menghapus akunnya sendiri yang sedang aktif login
        if (session('user_id') == $user->id) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri yang sedang aktif digunakan.');
        }

        // Jangan izinkan menghapus jika user adalah satu-satunya administrator
        if ($user->role === 'Administrator' && User::where('role', 'Administrator')->count() <= 1) {
            return back()->with('error', 'Tidak dapat menghapus Administrator terakhir di sistem.');
        }

        $name = $user->name;
        $user->delete();

        return redirect()->route('users.index')->with('success', "User '{$name}' telah berhasil dihapus dari sistem.");
    }
}
