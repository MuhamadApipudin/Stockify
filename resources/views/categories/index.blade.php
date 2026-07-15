@extends('example.layouts.default.dashboard')

@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    .font-display { font-family: 'Space Grotesk', sans-serif; }
    .font-mono { font-family: 'JetBrains Mono', monospace; }
</style>

<div class="p-6 min-h-screen space-y-6 max-w-[1600px] mx-auto font-[Inter]">

    @if(session('success'))
    <div class="flex items-center justify-between p-4 text-emerald-800 bg-emerald-50/80 border border-emerald-200/80 rounded-2xl shadow-[0_1px_2px_rgba(0,0,0,0.04)] backdrop-blur-md" role="alert">
        <div class="flex items-center gap-3">
            <div class="p-1.5 bg-emerald-100 rounded-lg text-emerald-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <span class="text-sm font-semibold">{{ session('success') }}</span>
        </div>
        <button type="button" onclick="this.parentElement.remove()" class="p-1 text-emerald-600 hover:text-emerald-800 hover:bg-emerald-100/50 rounded-lg transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
    </div>
    @endif

    @if($errors->any() || session('error'))
    <div class="p-4 text-rose-800 bg-rose-50/80 border border-rose-200/80 rounded-2xl shadow-[0_1px_2px_rgba(0,0,0,0.04)] backdrop-blur-md" role="alert">
        <div class="flex items-center gap-3 mb-1">
            <div class="p-1.5 bg-rose-100 rounded-lg text-rose-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <span class="text-sm font-semibold">{{ session('error') ?? 'Terjadi kesalahan pada input data:' }}</span>
        </div>
        @if($errors->any())
        <ul class="list-disc list-inside text-xs space-y-1 text-rose-700 pl-9">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endif
    </div>
    @endif

    <div class="relative bg-white border border-stone-200/70 rounded-2xl shadow-[0_1px_2px_rgba(0,0,0,0.04)] overflow-hidden">

        <div class="p-6 border-b border-dashed border-stone-200 bg-stone-50/40">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">

                <div class="flex items-center gap-3.5">
                    <div class="p-3 bg-[#0B1220] text-teal-400 rounded-xl shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <h1 class="font-display text-xl font-semibold text-[#0B1220] tracking-tight">Daftar Kategori</h1>
                            <span class="px-2.5 py-0.5 text-[11px] font-mono font-semibold text-teal-800 bg-teal-50 border border-teal-200 rounded-full">
                                {{ $categories->total() ?? 0 }} TOTAL
                            </span>
                        </div>
                        <p class="text-xs text-stone-400 mt-0.5">Kelola kelompok dan klasifikasi produk Anda secara terstruktur.</p>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2.5">

                    <form action="{{ route('categories.index') }}" method="GET" class="flex items-center gap-2 flex-1 sm:w-auto">
                        <div class="relative flex-1 sm:w-56">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau deskripsi..."
                                   class="w-full pl-9 pr-8 py-2.5 bg-stone-50 border border-stone-200 rounded-xl text-xs focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition outline-none">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-stone-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            @if(request('search'))
                                <a href="{{ route('categories.index') }}" class="absolute inset-y-0 right-0 pr-2.5 flex items-center text-stone-400 hover:text-stone-600" title="Clear">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                </a>
                            @endif
                        </div>

                        <select name="sort" onchange="this.form.submit()" class="px-4 py-2.5 bg-stone-50 border border-stone-200 rounded-xl text-xs font-medium text-stone-600 focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition outline-none cursor-pointer">
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Urutkan Data</option>
                            <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Abjad A - Z</option>
                            <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Abjad Z - A</option>
                        </select>
                    </form>

                    <div class="flex items-center gap-2">
                        <button type="button" id="btn-bulk-delete" onclick="submitBulkDelete()" disabled
                                class="bulk-col hidden inline-flex items-center gap-2 px-3.5 py-2.5 bg-rose-600 hover:bg-rose-700 disabled:opacity-50 disabled:cursor-not-allowed text-white rounded-xl text-xs font-semibold transition shadow-sm hover:shadow-md">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            Hapus (<span id="selected-count" class="font-mono">0</span>)
                        </button>

                        <button type="button" id="btn-toggle-select" onclick="toggleSelectMode()"
                                class="inline-flex items-center gap-2 px-3.5 py-2.5 bg-stone-100 hover:bg-stone-200 text-stone-700 rounded-xl text-xs font-semibold transition border border-stone-200/60 shrink-0">
                            <svg class="w-4 h-4 text-stone-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                            <span id="text-toggle-select">Pilih Banyak</span>
                        </button>

                       

                        <button type="button" onclick="openCreateModal()"
                                class="inline-flex items-center gap-2 px-4 py-2.5 bg-[#0B1220] hover:bg-[#151f33] text-white rounded-xl text-xs font-semibold transition shadow-sm hover:shadow-md cursor-pointer shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            Tambah
                        </button>
                    </div>

                </div>
            </div>
        </div>

        <form id="form-bulk-delete" action="{{ route('categories.bulk-delete') }}" method="POST">
            @csrf
            @method('DELETE')

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-stone-50/80 border-b border-stone-100 text-[10px] font-mono font-bold text-stone-400 uppercase tracking-wider">
                            <th class="bulk-col hidden py-4 px-6 w-10 text-center">
                                <input type="checkbox" id="select-all" class="w-4 h-4 text-teal-600 bg-stone-100 border-stone-300 rounded focus:ring-teal-500 focus:ring-2 cursor-pointer">
                            </th>
                            <th class="py-4 px-6">Nama Kategori</th>
                            <th class="py-4 px-6">Deskripsi</th>
                            <th class="py-4 px-6 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-stone-100 bg-white text-xs">
                        @forelse($categories as $category)
                        <tr class="hover:bg-teal-50/30 transition duration-150">

                            <td class="bulk-col hidden py-4 px-6 text-center">
                                <input type="checkbox" name="ids[]" value="{{ $category->id }}" class="checkbox-item w-4 h-4 text-teal-600 bg-stone-100 border-stone-300 rounded focus:ring-teal-500 focus:ring-2 cursor-pointer">
                            </td>

                            <td class="py-4 px-6 font-semibold text-stone-900">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-[#0B1220] text-teal-400 font-mono font-bold flex items-center justify-center text-xs shrink-0">
                                        {{ strtoupper(substr($category->name, 0, 1)) }}
                                    </div>
                                    <span>{{ $category->name }}</span>
                                </div>
                            </td>

                            <td class="py-4 px-6 text-stone-500 max-w-sm truncate">
                                {{ $category->description ?? '-' }}
                            </td>

                            <td class="py-4 px-6">
                                <div class="flex items-center justify-center gap-2">
                                    <button type="button"
                                            onclick="openEditModal({{ json_encode($category) }})"
                                            class="p-1.5 bg-stone-100 hover:bg-blue-50 text-stone-600 hover:text-blue-600 rounded-lg transition"
                                            title="Edit Kategori">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </button>

                                    <button type="button"
                                            onclick="deleteSingle('{{ route('categories.destroy', $category->id) }}')"
                                            class="p-1.5 bg-stone-100 hover:bg-rose-50 text-stone-600 hover:text-rose-600 rounded-lg transition"
                                            title="Hapus Kategori">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="py-14 text-center text-xs text-stone-400">
                                @if(request('search'))
                                    Data kategori dengan pencarian "<span class="font-semibold text-stone-600">{{ request('search') }}</span>" tidak ditemukan.
                                @else
                                    Belum ada data kategori yang terdaftar.
                                @endif
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </form>

        <form id="form-single-delete" action="" method="POST" class="hidden">
            @csrf
            @method('DELETE')
        </form>

        <div class="p-4 border-t border-dashed border-stone-200 flex flex-col sm:flex-row items-center justify-between gap-4">
            <span class="text-xs text-stone-400 font-mono">
                {{ $categories->firstItem() ?? 0 }}–{{ $categories->lastItem() ?? 0 }} dari {{ $categories->total() ?? 0 }} kategori
            </span>
            <div>
                {{ $categories->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>

{{-- ============ MODAL: TAMBAH ============ --}}
<div id="modal-create-category" class="fixed inset-0 z-50 hidden bg-[#0B1220]/50 backdrop-blur-sm flex items-center justify-center p-4 overflow-y-auto">
    <div class="relative w-full max-w-lg bg-white rounded-2xl shadow-xl border border-stone-200/70 overflow-hidden transform transition-all">
        <div class="flex items-center justify-between p-5 border-b border-stone-100 bg-[#0B1220]">
            <div>
                <h3 class="font-display text-lg font-semibold text-white">Tambah Kategori Baru</h3>
                <p class="text-xs text-slate-400 mt-0.5">Isi detail di bawah untuk menambahkan kategori produk baru.</p>
            </div>
            <button type="button" onclick="closeCreateModal()" class="p-1 text-slate-400 hover:text-white hover:bg-white/10 rounded-lg transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <form action="{{ route('categories.store') }}" method="POST" class="p-6 space-y-4">
            @csrf
            <div class="space-y-1">
                <label class="text-xs font-mono font-bold text-stone-700 uppercase tracking-wider">Nama Kategori <span class="text-rose-500">*</span></label>
                <input type="text" name="name" required value="{{ old('name') }}" placeholder="Contoh: Elektronik, Pakaian, Makanan..."
                       class="w-full px-4 py-2.5 bg-stone-50 border border-stone-200 rounded-xl text-xs focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition outline-none">
            </div>

            <div class="space-y-1">
                <label class="text-xs font-mono font-bold text-stone-700 uppercase tracking-wider">Deskripsi</label>
                <textarea name="description" rows="3" placeholder="Deskripsi singkat mengenai kategori ini..."
                          class="w-full px-4 py-2.5 bg-stone-50 border border-stone-200 rounded-xl text-xs focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition outline-none">{{ old('description') }}</textarea>
            </div>

            <div class="flex items-center gap-3 pt-4 border-t border-dashed border-stone-200">
                <button type="submit" class="flex-1 px-4 py-2.5 bg-[#0B1220] hover:bg-[#151f33] text-white rounded-xl text-xs font-semibold shadow-sm transition">
                    Simpan Kategori
                </button>
                <button type="button" onclick="closeCreateModal()" class="px-4 py-2.5 bg-stone-100 hover:bg-stone-200 text-stone-600 rounded-xl text-xs font-semibold transition">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ============ MODAL: EDIT ============ --}}
<div id="modal-edit-category" class="fixed inset-0 z-50 hidden bg-[#0B1220]/50 backdrop-blur-sm flex items-center justify-center p-4 overflow-y-auto">
    <div class="relative w-full max-w-lg bg-white rounded-2xl shadow-xl border border-stone-200/70 overflow-hidden transform transition-all">
        <div class="flex items-center justify-between p-5 border-b border-stone-100 bg-[#0B1220]">
            <div>
                <h3 class="font-display text-lg font-semibold text-white">Edit Kategori</h3>
                <p class="text-xs text-slate-400 mt-0.5">Ubah rincian informasi data kategori.</p>
            </div>
            <button type="button" onclick="closeEditModal()" class="p-1 text-slate-400 hover:text-white hover:bg-white/10 rounded-lg transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <form id="form-edit-category" action="" method="POST" class="p-6 space-y-4">
            @csrf
            @method('PUT')

            <div class="space-y-1">
                <label class="text-xs font-mono font-bold text-stone-700 uppercase tracking-wider">Nama Kategori <span class="text-rose-500">*</span></label>
                <input type="text" id="edit-name" name="name" required
                       class="w-full px-4 py-2.5 bg-stone-50 border border-stone-200 rounded-xl text-xs focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition outline-none">
            </div>

            <div class="space-y-1">
                <label class="text-xs font-mono font-bold text-stone-700 uppercase tracking-wider">Deskripsi</label>
                <textarea id="edit-description" name="description" rows="3"
                          class="w-full px-4 py-2.5 bg-stone-50 border border-stone-200 rounded-xl text-xs focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition outline-none"></textarea>
            </div>

            <div class="flex items-center gap-3 pt-4 border-t border-dashed border-stone-200">
                <button type="submit" class="flex-1 px-4 py-2.5 bg-[#0B1220] hover:bg-[#151f33] text-white rounded-xl text-xs font-semibold shadow-sm transition">
                    Perbarui Kategori
                </button>
                <button type="button" onclick="closeEditModal()" class="px-4 py-2.5 bg-stone-100 hover:bg-stone-200 text-stone-600 rounded-xl text-xs font-semibold transition">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Modal Create Handlers
    function openCreateModal() {
        document.getElementById('modal-create-category').classList.remove('hidden');
    }
    function closeCreateModal() {
        document.getElementById('modal-create-category').classList.add('hidden');
    }

    // Modal Edit Handlers
    function openEditModal(category) {
        const form = document.getElementById('form-edit-category');
        form.action = `/categories/${category.id}`;

        document.getElementById('edit-name').value = category.name || '';
        document.getElementById('edit-description').value = category.description || '';

        document.getElementById('modal-edit-category').classList.remove('hidden');
    }
    function closeEditModal() {
        document.getElementById('modal-edit-category').classList.add('hidden');
    }

    // Toggle Checkbox Mode (Bulk Delete)
    let isSelectMode = false;
    function toggleSelectMode() {
        isSelectMode = !isSelectMode;
        const bulkCols = document.querySelectorAll('.bulk-col');
        const toggleBtnText = document.getElementById('text-toggle-select');
        const selectAllCheckbox = document.getElementById('select-all');

        if (isSelectMode) {
            bulkCols.forEach(col => col.classList.remove('hidden'));
            toggleBtnText.textContent = 'Batal';
        } else {
            bulkCols.forEach(col => col.classList.add('hidden'));
            toggleBtnText.textContent = 'Pilih Banyak';

            if (selectAllCheckbox) selectAllCheckbox.checked = false;
            document.querySelectorAll('.checkbox-item').forEach(cb => cb.checked = false);
            updateBulkDeleteState();
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        const selectAllCheckbox = document.getElementById('select-all');
        const itemCheckboxes = document.querySelectorAll('.checkbox-item');

        if (selectAllCheckbox) {
            selectAllCheckbox.addEventListener('change', function () {
                itemCheckboxes.forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
                updateBulkDeleteState();
            });
        }

        itemCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateBulkDeleteState);
        });
    });

    function updateBulkDeleteState() {
        const checkedBoxes = document.querySelectorAll('.checkbox-item:checked');
        const count = checkedBoxes.length;
        const bulkDeleteBtn = document.getElementById('btn-bulk-delete');
        const selectedCountSpan = document.getElementById('selected-count');

        selectedCountSpan.textContent = count;
        bulkDeleteBtn.disabled = count === 0;

        const itemCheckboxes = document.querySelectorAll('.checkbox-item');
        const selectAllCheckbox = document.getElementById('select-all');
        if (itemCheckboxes.length > 0 && selectAllCheckbox) {
            selectAllCheckbox.checked = count === itemCheckboxes.length;
        }
    }

    function submitBulkDelete() {
        const count = document.querySelectorAll('.checkbox-item:checked').length;
        if (count === 0) return;

        if (confirm(`Yakin ingin menghapus ${count} kategori yang dipilih?`)) {
            document.getElementById('form-bulk-delete').submit();
        }
    }

    function deleteSingle(url) {
        if (confirm('Yakin ingin menghapus kategori ini?')) {
            const form = document.getElementById('form-single-delete');
            form.action = url;
            form.submit();
        }
    }
</script>
@endsection