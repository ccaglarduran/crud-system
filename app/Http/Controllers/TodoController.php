<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    // Tüm Görevleri Listele
    public function index()
    {
        // with('user') diyerek N+1 problemine girmeden görevi hazırlayanları da tek sorguda çekiyoruz
        $todos = Todo::with('user')->latest()->get();
        return view('todos.index', compact('todos'));
    }

    // Yeni Görev Ekle
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'position' => 'nullable|string|max:100', // Pozisyon alanı zorunlu değil
        ]);

        // Giriş yapmış kullanıcının ID'sini otomatik ekliyoruz
        $validated['user_id'] = auth()->id();

        Todo::create($validated);
        return redirect()->back();
    }

    // Görevi Düzenle/Güncelle (Inline veya Form Post için)
    public function update(Request $request, Todo $todo)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'position' => 'nullable|string|max:100',
        ]);

        $todo->update($validated);
        return redirect()->back();
    }

    // Görev Sil
    public function destroy(Todo $todo)
    {
        $todo->delete();
        return redirect()->back();
    }

    // Durum Değiştir (Tamamlandı / Bekliyor)
    public function toggle(Todo $todo)
    {
        $todo->update([
            'is_completed' => !$todo->is_completed
        ]);
        return redirect()->back();
    }
}