<?php

namespace App\Http\Controllers;

use App\Models\EducationalPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EducationalPostController extends Controller
{
    public function public()
    {
        $posts = EducationalPost::latest()->paginate(6);
        return view('education.index', compact('posts'));
    }

    public function show($id)
    {
        $post = EducationalPost::findOrFail($id);
        return view('education.show', compact('post'));
    }

    public function manage()
    {
        $posts = EducationalPost::where('user_id', Auth::id())->get();

        return view('edukasi.manage', compact('posts'));
    }

    public function create()
    {
        return view('edukasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'konten' => 'required',
        ]);

        EducationalPost::create([
            'user_id' => Auth::id(),
            'judul' => $request->judul,
            'konten' => $request->konten,
        ]);

        return redirect()->route('education.manage')
            ->with('success', 'Konten edukasi berhasil dibuat!');
    }
}
