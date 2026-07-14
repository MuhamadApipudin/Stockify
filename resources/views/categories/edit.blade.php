@extends('example.layouts.default.dashboard')

@section('content')
<div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200">
    <h1 class="text-xl font-semibold text-gray-900">Edit Kategori: {{ $category->name }}</h1>
</div>

<div class="p-4">
    <form action="{{ route('categories.update', $category->id) }}" method="POST" class="bg-white p-6 shadow rounded-lg">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Nama Kategori</label>
            <input type="text" name="name" value="{{ old('name', $category->name) }}" 
                   class="w-full mt-1 border border-gray-300 rounded-lg p-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
            <textarea name="description" class="w-full mt-1 border border-gray-300 rounded-lg p-2">{{ old('description', $category->description) }}</textarea>
        </div>

        <div class="flex gap-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Simpan Perubahan</button>
            <a href="{{ route('categories.index') }}" class="bg-gray-200 px-4 py-2 rounded-lg hover:bg-gray-300">Batal</a>
        </div>
    </form>
</div>
@endsection