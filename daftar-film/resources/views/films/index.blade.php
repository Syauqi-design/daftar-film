@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6 bg-black min-h-screen text-white">
    <h1 class="text-2xl font-bold mb-6">🎬 Daftar Film</h1>

    {{-- Tombol Tambah Film (hanya untuk admin) --}}
    @if(Auth::check() && Auth::user()->role === 'admin')
        <a href="{{ route('films.create') }}" class="bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white px-5 py-2 rounded-lg font-semibold mb-6 inline-block transition duration-300">➕ Tambah Film</a>
    @endif

    {{-- Daftar Film dalam Tabel --}}
    <div class="overflow-x-auto">
        <table class="w-full table-auto border-collapse border border-gray-600 text-sm">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="border border-gray-600 px-4 py-2">Poster</th>
                    <th class="border border-gray-600 px-4 py-2">Judul</th>
                    <th class="border border-gray-600 px-4 py-2">Genre</th>
                    <th class="border border-gray-600 px-4 py-2">Tahun</th>
                    <th class="border border-gray-600 px-4 py-2">Deskripsi</th>
                    @if(Auth::check() && Auth::user()->role === 'admin')
                        <th class="border border-gray-600 px-4 py-2">Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($films as $film)
                    <tr class="bg-gray-900 hover:bg-gray-800">
                        <td class="border border-gray-600 px-4 py-2 text-center">
                            @if($film->poster)
                                <img src="{{ asset('storage/' . $film->poster) }}" alt="Poster {{ $film->judul }}" class="w-24 h-auto rounded shadow">
                            @else
                                <span class="text-gray-500 italic">Tidak ada</span>
                            @endif
                        </td>
                        <td class="border border-gray-600 px-4 py-2">{{ $film->judul }}</td>
                        <td class="border border-gray-600 px-4 py-2">{{ $film->genre }}</td>
                        <td class="border border-gray-600 px-4 py-2">{{ $film->tahun }}</td>
                        <td class="border border-gray-600 px-4 py-2">{{ $film->deskripsi }}</td>
                        @if(Auth::check() && Auth::user()->role === 'admin')
                            <td class="border border-gray-600 px-4 py-2 space-x-2">
                                <a href="{{ route('films.edit', $film) }}" class="text-indigo-400 hover:text-indigo-500">✏️ Edit</a>
                                <form action="{{ route('films.destroy', $film) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus film ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-600">🗑️ Hapus</button>
                                </form>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
