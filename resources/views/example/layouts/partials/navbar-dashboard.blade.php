<nav class="fixed z-50 w-full bg-white border-b border-stone-200/70 shadow-[0_1px_2px_rgba(0,0,0,0.02)]">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        .font-display { font-family: 'Space Grotesk', sans-serif; }
        .font-mono { font-family: 'JetBrains Mono', monospace; }
        #greeting-text { opacity: 0; animation: fadeInGreeting 0.6s ease forwards 0.2s; }
        @keyframes fadeInGreeting { from { opacity: 0; transform: translateY(2px); } to { opacity: 1; transform: translateY(0); } }
        .navbar-popover { animation: popIn 0.15s ease forwards; transform-origin: top right; }
        @keyframes popIn { from { opacity: 0; transform: scale(0.96) translateY(-4px); } to { opacity: 1; transform: scale(1) translateY(0); } }
        #funfact-text {
            transition: transform 0.2s ease, color 0.2s ease;
            cursor: default;
        }
        #funfact-text:hover {
            transform: scale(1.035);
            color: #0F766E;
        }
    </style>

    <div class="px-4 py-3 lg:px-6 flex items-center justify-between gap-4">

        {{-- ============ LOGO + GREETING ============ --}}
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3.5 w-fit shrink-0">
            @php
                $logo = \App\Models\Setting::where('key', 'app_logo')->first();
                $appName = \App\Models\Setting::where('key', 'app_name')->first();
            @endphp

            @if($logo && $logo->value)
                <img src="{{ asset('storage/' . $logo->value) }}" class="h-16 w-16 object-contain" alt="Logo Aplikasi" />
            @else
                <div class="h-11 w-11 rounded-xl bg-[#0B1220] flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
            @endif

            <div class="leading-tight">
                <span class="block font-[Space_Grotesk] text-xl font-semibold text-[#0B1220] whitespace-nowrap">
                    {{ $appName->value ?? 'Stockify' }}
                </span>
                <span id="greeting-text" class="block font-[JetBrains_Mono] text-[10px] font-medium text-teal-700 tracking-wider uppercase">
                    Halo, {{ Auth::user()->name ?? 'Pengguna' }}
                </span>
            </div>
        </a>

        {{-- ============ GIMMICK CLUSTER ============ --}}
        <div class="hidden lg:flex items-center gap-2">

            {{-- Cuaca --}}
            <div id="weather-widget" class="flex items-center gap-2 px-3 py-1.5 rounded-full border border-stone-200 bg-stone-50 text-[11px] font-mono font-semibold text-stone-500">
                <svg class="w-3.5 h-3.5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                <span id="weather-temp">--°C</span>
            </div>

            {{-- Fun Fact of the Day --}}
            <div class="relative">
                <button type="button" id="funfact-btn" class="flex items-center gap-2 px-3 py-1.5 rounded-full border border-stone-200 bg-stone-50 text-[11px] font-mono font-semibold text-stone-600 hover:bg-teal-50 hover:text-teal-700 hover:border-teal-200 transition">
                    <svg class="w-3.5 h-3.5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path></svg>
                    Fun Fact
                </button>
                <div id="funfact-popover" class="hidden navbar-popover absolute right-0 mt-2 w-72 bg-white border border-stone-200 rounded-xl shadow-lg overflow-hidden z-50">
                    <div class="px-3.5 py-2.5 border-b border-dashed border-stone-200 bg-stone-50/60 flex items-center justify-between">
                        <span class="text-[10px] font-mono font-bold text-stone-400 uppercase tracking-wider">Fun Fact of the Day</span>
                        <button type="button" id="funfact-shuffle" class="p-1 text-stone-400 hover:text-teal-600 transition" title="Fakta lain">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                        </button>
                    </div>
                    <p id="funfact-text" class="p-4 text-xs text-stone-600 leading-relaxed">Memuat fakta...</p>
                </div>
            </div>

            {{-- Focus Mode --}}
            <button type="button" id="focus-btn" class="flex items-center gap-1.5 px-3 py-1.5 rounded-full border border-stone-200 bg-stone-50 text-[11px] font-mono font-semibold text-stone-600 hover:bg-teal-50 hover:text-teal-700 hover:border-teal-200 transition">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span id="focus-label">Fokus Mode</span>
            </button>

            {{-- Quick Notes --}}
            <div class="relative">
                <button type="button" id="notes-btn" class="flex items-center gap-1.5 px-3 py-1.5 rounded-full border border-stone-200 bg-stone-50 text-[11px] font-mono font-semibold text-stone-600 hover:bg-stone-100 transition">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    Notes
                </button>
                <div id="notes-popover" class="hidden navbar-popover absolute right-0 mt-2 w-64 bg-white border border-stone-200 rounded-xl shadow-lg overflow-hidden z-50">
                    <div class="px-3.5 py-2.5 border-b border-dashed border-stone-200 bg-stone-50/60">
                        <span class="text-[10px] font-mono font-bold text-stone-400 uppercase tracking-wider">Catatan Cepat</span>
                    </div>
                    <textarea id="notes-textarea" rows="4" placeholder="Tulis catatan..." class="w-full p-3 text-xs text-stone-700 outline-none resize-none"></textarea>
                    <div class="px-3.5 py-2 border-t border-dashed border-stone-200 flex items-center justify-between gap-2">
                        <span id="notes-saved-indicator" class="text-[10px] font-mono text-stone-300">Belum disimpan</span>
                        <button type="button" id="notes-save-btn" class="px-3 py-1.5 bg-[#0B1220] hover:bg-[#151f33] text-white rounded-lg text-[11px] font-mono font-semibold transition shrink-0">
                            Simpan
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- ============ STATUS ONLINE + JAM/POMODORO ============ --}}
        <div class="hidden sm:flex items-center gap-4 shrink-0">
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[11px] font-[JetBrains_Mono] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                SYSTEM ONLINE
            </span>

            <div class="h-8 w-[1px] bg-stone-200"></div>

            <div class="text-right leading-tight min-w-[104px]">
                <div id="navbar-clock" class="font-[JetBrains_Mono] text-sm font-bold text-[#0B1220] tabular-nums">--:--:--</div>
                <div id="navbar-date" class="font-[JetBrains_Mono] text-[10px] text-stone-400 tracking-wide">—</div>
            </div>
        </div>

    </div>
</nav>

<script>
    (function () {
        /* ===================== JAM & TANGGAL + GREETING ===================== */
        const clockEl = document.getElementById('navbar-clock');
        const dateEl = document.getElementById('navbar-date');
        const greetingEl = document.getElementById('greeting-text');
        const hariList = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', "Jum'at", 'Sabtu'];
        const bulanList = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        const userName = greetingEl ? greetingEl.textContent.replace('Halo, ', '').trim() : 'Pengguna';

        function greetingWord(hour) {
            if (hour >= 4 && hour < 11) return 'Selamat Pagi';
            if (hour >= 11 && hour < 15) return 'Selamat Siang';
            if (hour >= 15 && hour < 18) return 'Selamat Sore';
            return 'Selamat Malam';
        }

        function updateClock() {
            const now = new Date();

            if (!focusActive) {
                const hh = String(now.getHours()).padStart(2, '0');
                const mm = String(now.getMinutes()).padStart(2, '0');
                const ss = String(now.getSeconds()).padStart(2, '0');
                if (clockEl) clockEl.textContent = `${hh}:${mm}:${ss}`;
            }

            if (dateEl) {
                const hari = hariList[now.getDay()];
                const tanggal = now.getDate();
                const bulan = bulanList[now.getMonth()];
                const tahun = now.getFullYear();
                dateEl.textContent = `${hari}, ${tanggal} ${bulan} ${tahun}`;
            }

            if (greetingEl) {
                greetingEl.textContent = `${greetingWord(now.getHours())}, ${userName}`;
            }
        }

        /* ===================== CUACA (Open-Meteo, tanpa API key) ===================== */
        const weatherTempEl = document.getElementById('weather-temp');

        function loadWeather(lat, lon) {
            fetch(`https://api.open-meteo.com/v1/forecast?latitude=${lat}&longitude=${lon}&current_weather=true`)
                .then(res => res.json())
                .then(data => {
                    if (data && data.current_weather && weatherTempEl) {
                        weatherTempEl.textContent = Math.round(data.current_weather.temperature) + '°C';
                    }
                })
                .catch(() => { if (weatherTempEl) weatherTempEl.textContent = '—'; });
        }

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (pos) => loadWeather(pos.coords.latitude, pos.coords.longitude),
                () => loadWeather(-6.9175, 107.6191) // fallback: Bandung
            );
        } else {
            loadWeather(-6.9175, 107.6191);
        }

       /* ===================== FUN FACT OF THE DAY ===================== */
const funfactBtn = document.getElementById('funfact-btn');
const funfactPopover = document.getElementById('funfact-popover');
const funfactText = document.getElementById('funfact-text');
const funfactShuffle = document.getElementById('funfact-shuffle');

const funFacts = [
    'Tahun 1995, internet baru punya sekitar 18.000 website di seluruh dunia. Sekarang? Miliaran.',
    'Madu nggak pernah basi. Arkeolog pernah nemuin madu berusia 3.000 tahun di makam Mesir yang masih bisa dimakan.',
    'Bintang laut nggak punya otak sama sekali, tapi tetap bisa "berpikir" pakai jaringan saraf di seluruh tubuhnya.',
    'Oktopus punya tiga jantung dan darahnya berwarna biru.',
    'Nama asli Google waktu masih jadi proyek kuliah di Stanford adalah "BackRub".',
    'Kentang adalah sayuran pertama yang pernah ditanam di luar angkasa, tahun 1995 di pesawat ulang-alik Columbia.',
    'Suara dengungan lebah madu itu sebenarnya adalah sayapnya yang mengepak 230 kali per detik.',
    'Menara Eiffel bisa "bertambah tinggi" sampai 15 cm di musim panas karena logamnya memuai kena panas.',
    'Bahasa "hai" dan "halo" dalam bahasa Inggris (hello) baru populer setelah telepon ditemukan, dulu orang lebih sering bilang "ahoy".',
    'Rata-rata orang menghabiskan sekitar 6 bulan dari hidupnya cuma buat nunggu lampu merah.',
    'Wortel aslinya berwarna ungu, bukan oranye. Warna oranye baru populer sekitar abad ke-17 di Belanda.',
    'Satu hari di planet Venus lebih lama daripada satu tahunnya (rotasinya lebih lambat dari revolusinya mengelilingi matahari).',
    'Bank pertama di dunia yang tercatat berdiri tahun 1472 di Siena, Italia, dan masih beroperasi sampai sekarang.',
    'Suara "klik" tombol keyboard mekanikal awalnya cuma efek samping, bukan fitur yang disengaja.',
    'Manusia lebih dekat secara genetik ke pisang daripada yang dikira banyak orang — sekitar 60% DNA-nya mirip.',
    'Emoji pertama kali dibuat tahun 1999 oleh Shigetaka Kurita, terinspirasi dari ramalan cuaca dan rambu jalan.',
    'Ada lebih banyak kemungkinan susunan kartu remi (52 kartu) daripada jumlah atom di planet Bumi.',
    'Ayam adalah kerabat terdekat dinosaurus T-Rex yang masih hidup sampai sekarang.',
    'Pisang sebenarnya termasuk jenis buah buni (berry), sedangkan stroberi secara botanis bukan buah berry.',
    'Awan akumulonimbus rata-rata punya berat sekitar 500.000 kg, alias setara dengan 100 gajah dewasa.',
    'Kucing nggak bisa merasakan rasa manis karena tidak punya reseptor rasa manis di lidahnya.',
    'Lagu "Happy Birthday to You" dulu punya hak cipta dan baru masuk ke ranah publik (bebas dipakai) pada tahun 2016.',
    'Sidik lidah setiap manusia itu unik dan beda-beda, sama seperti sidik jari.',
    'Air mineral yang kamu minum hari ini pernah diminum atau dilewati oleh dinosaurus jutaan tahun yang lalu.',
    'Siput bisa tidur sampai 3 tahun berturut-turut kalau kondisi lingkungannya terlalu kering atau dingin.',
    'Ikan hiu sudah ada di Bumi lebih dulu daripada pohon. Hiu ada sejak 400 juta tahun lalu, sedangkan pohon baru ada 350 juta tahun lalu.',
    'Gajah adalah satu-satunya mamalia darat yang tidak bisa melompat.',
    'Satu-satunya huruf yang tidak pernah muncul di tabel periodik unsur kimia adalah huruf J.',
    'Nutella awalnya diciptakan saat Perang Dunia II karena terjadi kelangkaan cokelat, jadi pembuatnya mencampur hazelnut agar persediaan cokelat cukup.',
    'Ubur-ubur jenis Turritopsis dohrnii dikenal secara biologis sebagai makhluk abadi karena bisa memutar balik siklus hidupnya ke tahap muda saat terancam.',
    'Gunung Olympus Mons di planet Mars adalah gunung tertinggi di tata surya, tingginya sekitar 3 kali lipat Gunung Everest.',
    'Kangaroo tidak bisa berjalan mundur karena bentuk kaki dan ekornya yang dirancang khusus untuk melompat ke depan.',
    'Di Swiss, memelihara satu ekor babi guinea (guinea pig) melanggar hukum karena mereka dianggap hewan sosial yang gampang kesepian—minimal harus punya dua.',
    'Suara petir berasal dari udara yang memanas secara mendadak hingga sekitar 30.000°C (lebih panas dari permukaan matahari) hingga memicu gelombang kejutan.',
    'Tetris adalah game pertama yang pernah dimainkan di luar angkasa, dibawa oleh kosmonot Rusia pada tahun 1993.',
    'Mata burung unta ukurannya lebih besar daripada otaknya sendiri.',
    'Bumi sebenarnya tidak benar-benar bulat sempurna, melainkan sedikit pepat di bagian kutub dan menggelembung di bagian khatulistiwa (oblate spheroid).'
];

let lastFactIdx = -1;

function pickRandomFact() {
    if (!funfactText) return;
    
    let idx;
    // Mencegah fakta yang sama muncul 2x berturut-turut saat diklik/di-shuffle
    do {
        idx = Math.floor(Math.random() * funFacts.length);
    } while (idx === lastFactIdx && funFacts.length > 1);

    lastFactIdx = idx;
    funfactText.textContent = funFacts[idx];
}

function showFunFactToast() {
    pickRandomFact();
    if (funfactPopover) {
        funfactPopover.classList.remove('hidden');
        setTimeout(() => {
            funfactPopover.classList.add('hidden');
        }, 6000);
    }
}

// Fakta baru setiap kali halaman dibuka/refresh
pickRandomFact();

// Fakta baru muncul otomatis tiap 30 menit
setInterval(showFunFactToast, 30 * 60 * 1000);

if (funfactBtn) {
    funfactBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        if (funfactPopover) funfactPopover.classList.toggle('hidden');
        if (notesPopover) notesPopover.classList.add('hidden');
    });
}

if (funfactShuffle) {
    funfactShuffle.addEventListener('click', (e) => {
        e.stopPropagation();
        pickRandomFact();
    });
}

if (funfactPopover) {
    funfactPopover.addEventListener('click', (e) => e.stopPropagation());
}


/* ===================== QUICK NOTES ===================== */
const notesBtn = document.getElementById('notes-btn');
const notesPopover = document.getElementById('notes-popover');
const notesTextarea = document.getElementById('notes-textarea');
const notesSavedIndicator = document.getElementById('notes-saved-indicator');
const notesSaveBtn = document.getElementById('notes-save-btn');

if (notesTextarea) {
    notesTextarea.value = localStorage.getItem('stockify_quick_notes') || '';
    if (notesTextarea.value.trim() !== '' && notesSavedIndicator) {
        notesSavedIndicator.textContent = 'Tersimpan';
        notesSavedIndicator.classList.remove('text-stone-300');
        notesSavedIndicator.classList.add('text-emerald-600');
    }

    notesTextarea.addEventListener('input', () => {
        if (notesSavedIndicator) {
            notesSavedIndicator.textContent = 'Belum disimpan';
            notesSavedIndicator.classList.remove('text-emerald-600');
            notesSavedIndicator.classList.add('text-stone-300');
        }
    });
}

if (notesBtn) {
    notesBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        if (notesPopover) notesPopover.classList.toggle('hidden');
        if (funfactPopover) funfactPopover.classList.add('hidden');
    });
}

if (notesSaveBtn) {
    notesSaveBtn.addEventListener('click', () => {
        if (notesTextarea) {
            localStorage.setItem('stockify_quick_notes', notesTextarea.value);
        }
        if (notesSavedIndicator) {
            notesSavedIndicator.textContent = 'Tersimpan';
            notesSavedIndicator.classList.remove('text-stone-300');
            notesSavedIndicator.classList.add('text-emerald-600');
        }
    });
}

if (notesPopover) {
    notesPopover.addEventListener('click', (e) => e.stopPropagation());
}

document.addEventListener('click', () => {
    if (funfactPopover) funfactPopover.classList.add('hidden');
    if (notesPopover) notesPopover.classList.add('hidden');
}); 

        /* ===================== FOKUS MODE (POMODORO 25 MENIT) ===================== */
        const focusBtn = document.getElementById('focus-btn');
        const focusLabel = document.getElementById('focus-label');
        let focusActive = false;
        let focusInterval = null;
        let focusRemaining = 25 * 60;

        function renderFocusCountdown() {
            const mm = String(Math.floor(focusRemaining / 60)).padStart(2, '0');
            const ss = String(focusRemaining % 60).padStart(2, '0');
            if (clockEl) clockEl.textContent = `${mm}:${ss}`;
        }

        focusBtn.addEventListener('click', () => {
            focusActive = !focusActive;

            if (focusActive) {
                focusRemaining = 25 * 60;
                focusLabel.textContent = 'Batalkan';
                focusBtn.classList.add('bg-teal-50', 'text-teal-700', 'border-teal-200');
                renderFocusCountdown();

                focusInterval = setInterval(() => {
                    focusRemaining--;
                    if (focusRemaining <= 0) {
                        clearInterval(focusInterval);
                        focusActive = false;
                        focusLabel.textContent = 'Fokus Mode';
                        focusBtn.classList.remove('bg-teal-50', 'text-teal-700', 'border-teal-200');
                        if (clockEl) clockEl.textContent = '00:00:00';
                        return;
                    }
                    renderFocusCountdown();
                }, 1000);
            } else {
                clearInterval(focusInterval);
                focusLabel.textContent = 'Fokus Mode';
                focusBtn.classList.remove('bg-teal-50', 'text-teal-700', 'border-teal-200');
            }
        });

        updateClock();
        setInterval(updateClock, 1000);
    })();
</script>