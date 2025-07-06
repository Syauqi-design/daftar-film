<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FilmController extends Controller
{
    public function index()
    {
        $films = Film::all();
        return view('films.index', compact('films'));
    }

    public function create()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Akses ditolak. Anda bukan admin.');
        }

        return view('films.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'tahun' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'deskripsi' => 'required|string',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['judul', 'genre', 'tahun', 'deskripsi']);

        // Simpan file poster jika ada
        if ($request->hasFile('poster')) {
            $file = $request->file('poster');
            $path = $file->store('posters', 'public');
            $data['poster'] = $path;
        }

        // Simpan ke database
        Film::create($data);

        return redirect()->route('films.index')->with('success', 'Film berhasil ditambahkan.');
    }

    public function edit(Film $film)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Akses ditolak. Anda bukan admin.');
        }

        return view('films.edit', compact('film'));
    }

    public function update(Request $request, Film $film)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Akses ditolak. Anda bukan admin.');
        }

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'tahun' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'deskripsi' => 'required|string',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('poster')) {
            $validated['poster'] = $request->file('poster')->store('posters', 'public');
        }

        $film->update($validated);

        return redirect()->route('films.index')->with('success', 'Film berhasil diperbarui.');
    }

    public function destroy(Film $film)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Akses ditolak. Anda bukan admin.');
        }

        $film->delete();
        return redirect()->route('films.index')->with('success', 'Film berhasil dihapus.');
    }
}
