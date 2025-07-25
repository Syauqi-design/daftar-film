@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-6">
    <h1 class="text-2xl font-bold mb-4">Edit Film: {{ $film->judul }}</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('films.update', $film) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label class="block">Judul</label>
            <input type="text" name="judul" value="{{ $film->judul }}" class="w-full border px-3 py-2 rounded" required>
        </div>
        <div>
            <label class="block">Genre</label>
            <input type="text" name="genre" value="{{ $film->genre }}" class="w-full border px-3 py-2 rounded" required>
        </div>
        <div>
            <label class="block">Tahun Rilis</label>
            <input type="number" name="tahun" value="{{ $film->tahun }}" class="w-full border px-3 py-2 rounded" required>
        </div>
        <div>
            <label class="block">Deskripsi</label>
            <textarea name="deskripsi" class="w-full border px-3 py-2 rounded" required>{{ $film->deskripsi }}</textarea>
        </div>
        <div>
            <label class="block mb-1">Poster Baru (opsional)</label>
            <input type="file" name="poster" class="border rounded px-2 py-1 w-full">
        </div>

        @if($film->poster)
            <div>
                <p class="text-sm text-gray-600 mb-1">Poster Saat Ini:</p>
                <img src="{{ asset('storage/' . $film->poster) }}" alt="Poster {{ $film->judul }}" class="w-32 h-auto rounded shadow">
            </div>
        @endif

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Perbarui</button>
        <a href="{{ route('films.index') }}" class="ml-2 text-gray-600">Batal</a>
    </form>
</div>
@endsection
