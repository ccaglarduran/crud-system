<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    // 1. Listeleme: Herkes (user ve admin) görebilir
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('users.index', compact('users'));
    }

    // 2. Yeni Kullanıcı Formu: Sadece Admin
    public function create()
    {
        Gate::authorize('admin-only');
        return view('users.create');
    }

    // 3. Veritabanına Kaydetme: Sadece Admin
    public function store(Request $request)
    {
        Gate::authorize('admin-only');

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'in:user,admin'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'Kullanıcı başarıyla oluşturuldu.');
    }

    // 4. Düzenleme Formu: Sadece Admin
    public function edit(User $user)
    {
        Gate::authorize('admin-only');
        return view('users.edit', compact('user'));
    }

    // 5. Güncelleme İşlemi: Sadece Admin
    public function update(Request $request, User $user)
    {
        Gate::authorize('admin-only');

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'in:user,admin'],
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'Kullanıcı başarıyla güncellendi.');
    }

    // 6. Silme İşlemi: Sadece Admin
    public function destroy(User $user)
    {
        Gate::authorize('admin-only');

        // Güvenlik: Adminin kendi kendini silmesini engelliyoruz
        if (auth()->id() === $user->id) {
            return redirect()->route('users.index')->with('error', 'Kendi hesabınızı silemezsiniz!');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Kullanıcı silindi.');
    }
}
