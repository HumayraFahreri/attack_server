<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserManagementController extends Controller
{
    public function index(Request $request){
        $query = User::query();
        // Jika ada input pencarian dengan nama 'search'
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            // Tambahkan kondisi where untuk mencari di kolom 'name' ATAU 'email'
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                ->orWhere('email', 'like', "%{$searchTerm}%");
            });
    }

    // Ambil hasilnya, urutkan dari yang terbaru
    $users = $query->latest()->get();

    // Kirim data ke view
    return view('users.index', compact('users'));
    }
    
    public function create()
    {
        $roles = Role::all(); 
        // REVISI 2: Sesuaikan nama view menjadi 'users.create'
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'max:255', Rule::unique('users')],
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'sometimes|array', // Ganti jadi 'sometimes' agar tidak wajib
            'roles.*' => 'exists:roles,name'
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        if (!empty($validated['roles'])) {
            $user->assignRole($validated['roles']);
        }

        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    // TAMBAHAN: Method yang dibutuhkan oleh Route::resource
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        // 1. Validasi data yang masuk
        $validated = $request->validate([
        'name' => 'required|string|max:255',
        // 'ignore($user->id)' penting agar tidak error saat email tidak diubah
        'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        // 'nullable' berarti password tidak wajib diisi
        'password' => 'nullable|string|min:8|confirmed',
        'roles' => 'sometimes|array',
        'roles.*' => 'exists:roles,name'
    ]);

    // 2. Update nama dan email
    $user->update([
        'name' => $validated['name'],
        'email' => $validated['email'],
    ]);

    // 3. Jika ada password baru, update password
    if (!empty($validated['password'])) {
        $user->update(['password' => Hash::make($validated['password'])]);
    }

    // 4. Jika ada role baru, sinkronkan role
    if (!empty($validated['roles'])) {
        $user->syncRoles($validated['roles']); // syncRoles akan menghapus role lama & menambah yg baru
    }

    return redirect()->route('users.index')->with('success', 'User updated successfully');
}

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}