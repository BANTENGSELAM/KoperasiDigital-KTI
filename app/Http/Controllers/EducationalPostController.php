<?php

namespace App\Http\Controllers;

use App\Models\EducationalPost;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class EducationalPostController extends Controller
{
    // Tampilkan semua artikel (publik)
    public function index()
    {
        $posts = EducationalPost::latest()->paginate(6);
        return view('education.index', compact('posts'));
    }

    // Tampilkan satu artikel
    public function show($id)
    {
        $post = EducationalPost::findOrFail($id);
        return view('education.show', compact('post'));
    }

    // Dashboard edukator (khusus role edukator)
    public function manage()
    {
        $posts = EducationalPost::where('user_id', Auth::id())->get();
        return view('education.manage', compact('posts'));
    }

    // Form buat artikel
    public function create()
    {
        return view('education.create');
    }

    // Simpan artikel
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $path = $request->file('thumbnail') ? $request->file('thumbnail')->store('thumbnails', 'public') : null;

        EducationalPost::create([
            'user_id' => Auth::id(),
            'judul' => $request->judul,
            'konten' => $request->konten,
            'thumbnail' => $path,
        ]);

        return redirect()->route('education.manage')->with('success', 'Artikel berhasil dibuat.');
    }
}
