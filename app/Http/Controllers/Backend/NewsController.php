<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    public function index()
    {
        // Ambil berita terbaru beserta relasi admin yang memposting
        $news = News::with('author')->latest()->get();
        return view('backend.news.index', compact('news'));
    }

    public function create()
    {
        return view('backend.news.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Maksimal 2MB
        ]);

        // Proses Upload Gambar
        $thumbnailPath = $request->file('thumbnail')->store('news', 'public');

        News::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . time(), // Mencegah slug ganda
            'content' => $request->content,
            'thumbnail' => $thumbnailPath,
            'published_at' => now(),
        ]);

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil diterbitkan!');
    }

    public function edit(News $news)
    {
        return view('backend.news.form', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = [
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . time(),
            'content' => $request->content,
        ];

        // Jika upload thumbnail baru
        if ($request->hasFile('thumbnail')) {
            // Hapus gambar lama
            if ($news->thumbnail) {
                Storage::disk('public')->delete($news->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('news', 'public');
        }

        $news->update($data);

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy(News $news)
    {
        // Hapus gambar fisik
        if ($news->thumbnail) {
            Storage::disk('public')->delete($news->thumbnail);
        }
        $news->delete();

        return back()->with('success', 'Berita berhasil dihapus!');
    }
}