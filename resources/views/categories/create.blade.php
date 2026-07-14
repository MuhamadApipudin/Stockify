@extends('example.layouts.default.dashboard')

@section('content')
<div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5">
    <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl">Tambah Kategori Baru</h1>
</div>

<div class="p-6 space-y-6">
    <form action="{{ route('categories.store') }}" method="POST" class="bg-gray-50 p-6 rounded-lg border">
        @csrf

        <div class="space-y-6">
            <div>
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nama Kategori</label>
                <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Contoh: Elektronik, Pakaian" required>
            </div>

            <div>
                <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Deskripsi</label>
                <textarea name="description" id="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Keterangan singkat mengenai kategori..."></textarea>
            </div>
        </div>

        <div class="mt-6">
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">Simpan Kategori</button>
            <a href="{{ route('categories.index') }}" class="ml-2 text-gray-500 bg-white hover:bg-gray-100 border border-gray-200 rounded-lg text-sm font-medium px-5 py-2.5">Batal</a>
        </div>
    </form>
</div>
@endsection