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

    @if($errors->any())
    <div class="p-4 text-rose-800 bg-rose-50/80 border border-rose-200/80 rounded-2xl shadow-[0_1px_2px_rgba(0,0,0,0.04)] backdrop-blur-md" role="alert">
        <div class="flex items-center gap-3 mb-2">
            <div class="p-1.5 bg-rose-100 rounded-lg text-rose-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <span class="text-sm font-semibold">Terjadi kesalahan pada input data:</span>
        </div>
        <ul class="list-disc list-inside text-xs space-y-1 text-rose-700 pl-8">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="bg-white border border-stone-200/70 rounded-2xl shadow-[0_1px_2px_rgba(0,0,0,0.04)] overflow-hidden">

        <div class="p-6 pb-5 border-b border-dashed border-stone-200 bg-stone-50/40">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                <div class="flex items-center gap-3.5">
                    <div class="p-3 bg-[#0B1220] text-teal-400 rounded-xl shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="font-display text-2xl font-semibold text-[#0B1220] tracking-tight">Daftar Supplier</h1>
                        <p class="text-xs text-stone-400 mt-1">Kelola data vendor dan rekanan bisnis Anda di satu tempat secara terpusat.</p>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2.5">

                    <form action="{{ route('suppliers.index') }}" method="GET" class="relative flex-1 sm:w-64">
                        <div class="relative">
                            <input type="text"
                                   name="search"
                                   value="{{ request('search') }}"
                                   placeholder="Cari supplier, HP, alamat..."
                                   class="w-full pl-9 pr-8 py-2 bg-stone-50 border border-stone-200/80 rounded-xl text-xs focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition outline-none placeholder:text-stone-400">

                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-stone-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>

                            @if(request('search'))
                                <a href="{{ route('suppliers.index') }}" class="absolute inset-y-0 right-0 pr-2.5 flex items-center text-stone-400 hover:text-stone-600 transition" title="Hapus Pencarian">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                </a>
                            @endif
                        </div>
                    </form>

                    <div class="flex items-center gap-2">
                        <button type="button"
                                id="btn-bulk-delete"
                                onclick="submitBulkDelete()"
                                disabled
                                class="bulk-col hidden inline-flex items-center gap-2 px-3.5 py-2 bg-rose-600 hover:bg-rose-700 disabled:opacity-50 disabled:cursor-not-allowed text-white rounded-xl text-xs font-semibold transition shadow-sm hover:shadow-md">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            Hapus (<span id="selected-count" class="font-mono">0</span>)
                        </button>

                        <button type="button"
                                id="btn-toggle-select"
                                onclick="toggleSelectMode()"
                                class="inline-flex items-center gap-2 px-3.5 py-2 bg-stone-100 hover:bg-stone-200 text-stone-700 rounded-xl text-xs font-semibold transition border border-stone-200/60 shrink-0">
                            <svg class="w-4 h-4 text-stone-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                            <span id="text-toggle-select">Pilih Banyak</span>
                        </button>

                       

                        <button type="button"
                                onclick="openCreateModal()"
                                class="inline-flex items-center gap-2 px-4 py-2 bg-[#0B1220] hover:bg-[#151f33] text-white rounded-xl text-xs font-semibold transition shadow-sm hover:shadow-md cursor-pointer shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            Tambah
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <form id="form-bulk-delete" action="{{ route('suppliers.bulk-delete') }}" method="POST">
            @csrf
            @method('DELETE')

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-stone-50/80 border-b border-stone-100 text-[10px] font-mono font-bold text-stone-400 uppercase tracking-wider">
                            <th class="bulk-col hidden py-4 px-6 w-10 text-center">
                                <input type="checkbox" id="select-all" class="w-4 h-4 text-teal-600 bg-stone-100 border-stone-300 rounded focus:ring-teal-500 focus:ring-2 cursor-pointer">
                            </th>
                            <th class="py-4 px-6">Nama Supplier</th>
                            <th class="py-4 px-6">Nomor HP</th>
                            <th class="py-4 px-6">Alamat</th>
                            <th class="py-4 px-6">Status</th>
                            <th class="py-4 px-6 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-stone-100 bg-white text-xs">
                        @forelse($suppliers as $supplier)
                        <tr class="hover:bg-teal-50/30 transition duration-150">
                            <td class="bulk-col hidden py-4 px-6 text-center">
                                <input type="checkbox" name="ids[]" value="{{ $supplier->id }}" class="checkbox-item w-4 h-4 text-teal-600 bg-stone-100 border-stone-300 rounded focus:ring-teal-500 focus:ring-2 cursor-pointer">
                            </td>

                            <td class="py-4 px-6 font-semibold text-stone-900">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-[#0B1220] text-teal-400 font-mono font-bold flex items-center justify-center text-xs shrink-0">
                                        {{ strtoupper(substr($supplier->name, 0, 1)) }}
                                    </div>
                                    <span>{{ $supplier->name }}</span>
                                </div>
                            </td>

                            <td class="py-4 px-6 text-stone-600 font-mono font-medium">
                                {{ $supplier->phone ?? '-' }}
                            </td>

                            <td class="py-4 px-6 text-stone-500 max-w-xs truncate">
                                {{ $supplier->address ?? '-' }}
                            </td>

                            <td class="py-4 px-6">
                                @php
                                    $status = strtolower($supplier->status ?? 'aktif');
                                @endphp
                                @if($status === 'aktif')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-mono font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200/60">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        AKTIF
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-mono font-semibold bg-teal-50 text-teal-700 border border-teal-200/60">
                                        <span class="w-1.5 h-1.5 rounded-full bg-teal-500"></span>
                                        PENDING
                                    </span>
                                @endif
                            </td>

                            <td class="py-4 px-6">
                                <div class="flex items-center justify-center gap-2">
                                    <button type="button"
                                            onclick="openEditModal({{ json_encode($supplier) }})"
                                            class="p-1.5 bg-stone-100 hover:bg-blue-50 text-stone-600 hover:text-blue-600 rounded-lg transition" title="Edit Supplier">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </button>

                                    <button type="button"
                                            onclick="deleteSingle('{{ route('suppliers.destroy', $supplier->id) }}')"
                                            class="p-1.5 bg-stone-100 hover:bg-rose-50 text-stone-600 hover:text-rose-600 rounded-lg transition"
                                            title="Hapus Supplier">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="py-14 text-center text-xs text-stone-400">
                                @if(request('search'))
                                    Data supplier dengan kata kunci "<span class="font-semibold text-stone-600">{{ request('search') }}</span>" tidak ditemukan.
                                @else
                                    Belum ada data supplier yang terdaftar.
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
                {{ $suppliers->firstItem() ?? 0 }}–{{ $suppliers->lastItem() ?? 0 }} dari {{ $suppliers->total() ?? 0 }} supplier
            </span>
            <div>
                {{ $suppliers->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>

{{-- ============ MODAL: TAMBAH SUPPLIER ============ --}}
<div id="modal-create-supplier" class="fixed inset-0 z-50 hidden bg-[#0B1220]/50 backdrop-blur-sm flex items-center justify-center p-4 overflow-y-auto">
    <div class="relative w-full max-w-lg bg-white rounded-2xl shadow-xl border border-stone-200/70 overflow-hidden transform transition-all">
        <div class="flex items-center justify-between p-5 border-b border-stone-100 bg-[#0B1220]">
            <div>
                <h3 class="font-display text-lg font-semibold text-white">Tambah Supplier Baru</h3>
                <p class="text-xs text-slate-400 mt-0.5">Lengkapi formulir di bawah ini untuk menambah vendor baru.</p>
            </div>
            <button type="button" onclick="closeCreateModal()" class="p-1 text-slate-400 hover:text-white hover:bg-white/10 rounded-lg transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <form action="{{ route('suppliers.store') }}" method="POST" class="p-6 space-y-4">
            @csrf
            <div class="space-y-1">
                <label class="text-xs font-mono font-bold text-stone-700 uppercase tracking-wider">Nama Supplier <span class="text-rose-500">*</span></label>
                <input type="text" name="name" required value="{{ old('name') }}" placeholder="Contoh: PT. Logistik Nusantara"
                       class="w-full px-4 py-2.5 bg-stone-50 border border-stone-200 rounded-xl text-xs focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition outline-none">
            </div>
            <div class="space-y-1">
    <label class="text-xs font-mono font-bold text-stone-700 uppercase tracking-wider">Nomor HP / WhatsApp <span class="text-rose-500">*</span></label>
    <input type="text" 
           name="phone" 
           value="{{ old('phone') }}" 
           placeholder="0812xxxxxxx"
           oninput="this.value = this.value.replace(/[^0-9]/g, '')" 
           maxlength="15"
           required
           class="w-full px-4 py-2.5 bg-stone-50 border border-stone-200 rounded-xl text-xs focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition outline-none">
</div>

            <div class="space-y-1">
                <label class="text-xs font-mono font-bold text-stone-700 uppercase tracking-wider">Alamat Lengkap</label>
                <textarea name="address" rows="3" placeholder="Jl. Sudirman No. 123, Jakarta"
                          class="w-full px-4 py-2.5 bg-stone-50 border border-stone-200 rounded-xl text-xs focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition outline-none">{{ old('address') }}</textarea>
            </div>

            <div class="space-y-1">
                <label class="text-xs font-mono font-bold text-stone-700 uppercase tracking-wider">Status</label>
                <select name="status" class="w-full px-4 py-2.5 bg-stone-50 border border-stone-200 rounded-xl text-xs focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition outline-none cursor-pointer">
                    <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                </select>
            </div>

            <div class="flex items-center gap-3 pt-4 border-t border-dashed border-stone-200">
                <button type="submit" class="flex-1 px-4 py-2.5 bg-[#0B1220] hover:bg-[#151f33] text-white rounded-xl text-xs font-semibold shadow-sm transition">
                    Simpan Supplier
                </button>
                <button type="button" onclick="closeCreateModal()" class="px-4 py-2.5 bg-stone-100 hover:bg-stone-200 text-stone-600 rounded-xl text-xs font-semibold transition">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ============ MODAL: EDIT SUPPLIER ============ --}}
<div id="modal-edit-supplier" class="fixed inset-0 z-50 hidden bg-[#0B1220]/50 backdrop-blur-sm flex items-center justify-center p-4 overflow-y-auto">
    <div class="relative w-full max-w-lg bg-white rounded-2xl shadow-xl border border-stone-200/70 overflow-hidden transform transition-all">
        <div class="flex items-center justify-between p-5 border-b border-stone-100 bg-[#0B1220]">
            <div>
                <h3 class="font-display text-lg font-semibold text-white">Edit Supplier</h3>
                <p class="text-xs text-slate-400 mt-0.5" id="edit-supplier-subtitle">Ubah data vendor di bawah ini.</p>
            </div>
            <button type="button" onclick="closeEditModal()" class="p-1 text-slate-400 hover:text-white hover:bg-white/10 rounded-lg transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <form id="form-edit-supplier" action="" method="POST" class="p-6 space-y-4">
            @csrf
            @method('PUT')
            <div class="space-y-1">
                <label class="text-xs font-mono font-bold text-stone-700 uppercase tracking-wider">Nama Supplier <span class="text-rose-500">*</span></label>
                <input type="text" id="edit-name" name="name" required placeholder="Contoh: PT. Logistik Nusantara"
                       class="w-full px-4 py-2.5 bg-stone-50 border border-stone-200 rounded-xl text-xs focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition outline-none">
            </div>

            <div class="space-y-1">
                <label class="text-xs font-mono font-bold text-stone-700 uppercase tracking-wider">Nomor HP / WhatsApp</label>
                <input type="text" id="edit-phone" name="phone" placeholder="0812xxxxxxx"
                       class="w-full px-4 py-2.5 bg-stone-50 border border-stone-200 rounded-xl text-xs focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition outline-none">
            </div>

            <div class="space-y-1">
                <label class="text-xs font-mono font-bold text-stone-700 uppercase tracking-wider">Alamat Lengkap</label>
                <textarea id="edit-address" name="address" rows="3" placeholder="Jl. Sudirman No. 123, Jakarta"
                          class="w-full px-4 py-2.5 bg-stone-50 border border-stone-200 rounded-xl text-xs focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition outline-none"></textarea>
            </div>

            <div class="space-y-1">
                <label class="text-xs font-mono font-bold text-stone-700 uppercase tracking-wider">Status</label>
                <select id="edit-status" name="status" class="w-full px-4 py-2.5 bg-stone-50 border border-stone-200 rounded-xl text-xs focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition outline-none cursor-pointer">
                    <option value="aktif">Aktif</option>
                    <option value="pending">Pending</option>
                </select>
            </div>

            <div class="flex items-center gap-3 pt-4 border-t border-dashed border-stone-200">
                <button type="submit" class="flex-1 px-4 py-2.5 bg-[#0B1220] hover:bg-[#151f33] text-white rounded-xl text-xs font-semibold shadow-sm transition">
                    Simpan Perubahan
                </button>
                <button type="button" onclick="closeEditModal()" class="px-4 py-2.5 bg-stone-100 hover:bg-stone-200 text-stone-600 rounded-xl text-xs font-semibold transition">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openCreateModal() {
        document.getElementById('modal-create-supplier').classList.remove('hidden');
    }

    function closeCreateModal() {
        document.getElementById('modal-create-supplier').classList.add('hidden');
    }

    function openEditModal(supplier) {
        document.getElementById('edit-name').value = supplier.name || '';
        document.getElementById('edit-phone').value = supplier.phone || '';
        document.getElementById('edit-address').value = supplier.address || '';
        document.getElementById('edit-status').value = supplier.status || 'aktif';
        document.getElementById('edit-supplier-subtitle').textContent = supplier.name;
        document.getElementById('form-edit-supplier').action = `/suppliers/${supplier.id}`;
        document.getElementById('modal-edit-supplier').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('modal-edit-supplier').classList.add('hidden');
    }

    @if ($errors->any())
        document.addEventListener('DOMContentLoaded', function() {
            openCreateModal();
        });
    @endif

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

        if (confirm(`Yakin ingin menghapus ${count} supplier yang dipilih?`)) {
            document.getElementById('form-bulk-delete').submit();
        }
    }

    function deleteSingle(url) {
        if (confirm('Yakin ingin menghapus supplier ini?')) {
            const form = document.getElementById('form-single-delete');
            form.action = url;
            form.submit();
        }
    }
</script>
@endsection