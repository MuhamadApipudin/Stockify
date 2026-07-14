@extends('example.layouts.default.dashboard')

@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    .font-display { font-family: 'Space Grotesk', sans-serif; }
    .font-mono { font-family: 'JetBrains Mono', monospace; }
</style>

<div class="p-6 space-y-6 max-w-[700px] mx-auto font-[Inter]">

    <div class="flex items-center gap-3.5 pb-4 border-b border-dashed border-stone-200">
        <div class="p-2.5 bg-[#0B1220] text-teal-400 rounded-xl shrink-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg>
        </div>
        <div>
            <h2 class="font-display text-2xl font-semibold text-[#0B1220] tracking-tight">Edit Pengguna</h2>
            <p class="text-xs text-stone-400 mt-1">Perbarui informasi akun {{ $user->name }}.</p>
        </div>
    </div>

    @if ($errors->any())
        <div class="p-4 bg-rose-50 border border-rose-200 rounded-xl text-xs text-rose-700 space-y-1">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <div class="bg-white border border-stone-200/70 rounded-2xl shadow-[0_1px_2px_rgba(0,0,0,0.04)] p-6">
        <form method="POST" action="{{ route('users.update', $user->id) }}" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-[11px] font-mono font-bold text-stone-500 uppercase tracking-wider mb-1.5">Nama</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                       class="w-full px-3.5 py-2.5 bg-stone-50 border border-stone-200 rounded-xl text-sm focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition outline-none">
            </div>

            <div>
                <label class="block text-[11px] font-mono font-bold text-stone-500 uppercase tracking-wider mb-1.5">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                       class="w-full px-3.5 py-2.5 bg-stone-50 border border-stone-200 rounded-xl text-sm focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition outline-none">
            </div>

            <div>
                <label class="block text-[11px] font-mono font-bold text-stone-500 uppercase tracking-wider mb-1.5">Role</label>
                <select name="role" required
                        class="w-full px-3.5 py-2.5 bg-stone-50 border border-stone-200 rounded-xl text-sm focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition outline-none">
                    @foreach (['admin', 'Staff Gudang', 'Manajer Gudang'] as $roleOption)
                        <option value="{{ $roleOption }}" {{ old('role', $user->role) === $roleOption ? 'selected' : '' }}>
                            {{ $roleOption }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-[11px] font-mono font-bold text-stone-500 uppercase tracking-wider mb-1.5">Password Baru</label>
                <input type="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah password"
                       class="w-full px-3.5 py-2.5 bg-stone-50 border border-stone-200 rounded-xl text-sm focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition outline-none">
                <p class="text-[11px] text-stone-400 mt-1.5">Minimal 8 karakter, biarkan kosong jika password tidak diubah.</p>
            </div>

            <div class="flex items-center gap-2.5 pt-2">
                <button type="submit"
                        class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-[#0B1220] hover:bg-[#151f33] text-white rounded-xl text-xs font-semibold transition shadow-sm">
                    Simpan Perubahan
                </button>
                <a href="{{ route('users.index') }}"
                   class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-stone-100 hover:bg-stone-200 text-stone-600 rounded-xl text-xs font-semibold transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection