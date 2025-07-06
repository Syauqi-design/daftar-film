@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-6">
    <h1 class="text-2xl font-bold mb-4">Daftar Film</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('films.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Film</a>

    <table class="w-full border border-gray-300 mt-4">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2">Judul</th>
                <th class="p-2">Genre</th>
                <th class="p-2">Tahun</th>
                <th class="p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($films as $film)
                <tr>
                    <td class="p-2">{{ $film->judul }}</td>
                    <td class="p-2">{{ $film->genre }}</td>
                    <td class="p-2">{{ $film->tahun }}</td>
                    <td class="p-2">
                        <a href="{{ route('films.edit', $film) }}" class="text-blue-600">Edit</a> |
                        <form action="{{ route('films.destroy', $film) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
