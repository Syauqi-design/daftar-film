@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-900 via-black to-gray-900 text-white py-12 px-4">
    <div class="max-w-3xl mx-auto bg-white text-gray-800 p-10 rounded-2xl shadow-2xl border border-gray-300">
        <h1 class="text-3xl font-bold mb-8 text-center tracking-wide">🎬 Tambah Film Baru</h1>

        @if ($errors->any())
            <div class="mb-6 bg-red-100 border border-red-400 text-red-700 p-4 rounded-lg">
                <strong class="block text-lg mb-2">⚠️ Terjadi kesalahan:</strong>
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('films.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="judul" class="block text-sm font-semibold mb-1">🎞️ Judul Film</label>
                    <input type="text" name="judul" id="judul"
                        class="w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Contoh: Interstellar" required>
                </div>

                <div>
                    <label for="genre" class="block text-sm font-semibold mb-1">🎭 Genre</label>
                    <input type="text" name="genre" id="genre"
                        class="w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                        placeholder="Contoh: Sci-fi, Drama" required>
                </div>

                <div>
                    <label for="tahun" class="block text-sm font-semibold mb-1">📅 Tahun Rilis</label>
                    <input type="number" name="tahun" id="tahun"
                        class="w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500"
                        placeholder="Contoh: 2014" required>
                </div>

                <div>
                    <label for="poster" class="block text-sm font-semibold mb-1">🖼️ Poster Film</label>
                    <input type="file" name="poster" id="poster"
                        class="w-full file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0
                               file:text-sm file:font-semibold file:bg-indigo-600 file:text-white
                               hover:file:bg-indigo-700 transition duration-200 bg-white text-gray-800" required>
                </div>
            </div>

            <div>
                <label for="deskripsi" class="block text-sm font-semibold mb-1">📝 Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="4"
                    class="w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500"
                    placeholder="Tulis sinopsis film..." required></textarea>
            </div>

            <div class="text-center pt-4">
                <button type="submit"
                    class="bg-gradient-to-r from-indigo-500 to-purple-600 text-black font-bold py-3 px-8 rounded-full shadow-md hover:shadow-lg transition duration-300 transform hover:-translate-y-1">
                    🚀 Simpan Film
                </button>
            </div>
        </form>
    </div>
</div>
@endsection