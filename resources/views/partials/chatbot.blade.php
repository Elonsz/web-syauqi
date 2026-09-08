<!-- ===== FLOATING FAQ CHATBOT WIDGET ===== -->
<!-- Created by Hugo Putra Pratama for Yayasan Cahaya Amanah Ar-Raudhah -->
<div id="faq-chatbot-widget" class="fixed bottom-5 right-5 z-50 font-sans select-none no-print">

    <!-- Chat Trigger Button -->
    <button id="chatbot-toggle-btn"
            onclick="toggleChatbot()"
            class="group relative flex items-center justify-center w-14 h-14 sm:w-16 sm:h-16 rounded-full bg-gradient-to-tr from-slate-950 via-blue-950 to-red-600 text-white shadow-2xl hover:scale-105 active:scale-95 transition-all duration-300 focus:outline-none ring-4 ring-white/20 hover:ring-red-500/40 cursor-pointer"
            aria-label="Buka FAQ Chatbot">
        <!-- Notification Ping -->
        <span class="absolute -top-1 -right-1 flex h-4 w-4">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
            <span class="relative inline-flex rounded-full h-4 w-4 bg-red-600 text-[9px] font-bold text-white items-center justify-center">1</span>
        </span>

        <!-- Icons -->
        <i class="fa-solid fa-comments text-2xl transition-transform duration-300 group-hover:rotate-6" id="chat-icon-open"></i>
        <i class="fa-solid fa-xmark text-2xl hidden" id="chat-icon-close"></i>

        <!-- Floating Tooltip Label (Desktop) -->
        <div class="hidden lg:flex absolute right-20 bg-slate-900/90 backdrop-blur-md text-white px-3 py-1.5 rounded-xl text-xs font-semibold whitespace-nowrap shadow-xl border border-white/10 opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
            <span>Tanya Asisten Ar-Raudhah</span>
        </div>
    </button>

    <!-- Chatbot Window Panel -->
    <div id="chatbot-window"
         class="hidden fixed sm:absolute bottom-20 right-0 left-4 sm:left-auto w-auto sm:w-96 max-w-[92vw] h-[560px] max-h-[82vh] bg-white rounded-3xl shadow-2xl border border-slate-200/90 flex-col overflow-hidden transition-all duration-300 transform origin-bottom-right z-50">

        <!-- Chat Header -->
        <div class="bg-gradient-to-r from-slate-950 via-blue-950 to-red-950 p-4 text-white flex items-center justify-between border-b border-white/10 shrink-0">
            <div class="flex items-center gap-3">
                <div class="relative w-10 h-10 rounded-2xl bg-white/10 border border-white/20 flex items-center justify-center text-red-400 text-lg shadow-inner">
                    <i class="fa-solid fa-robot"></i>
                    <span class="absolute bottom-0 right-0 w-2.5 h-2.5 rounded-full bg-emerald-400 border-2 border-slate-950"></span>
                </div>
                <div>
                    <h3 class="text-xs sm:text-sm font-black tracking-tight leading-tight flex items-center gap-1.5">
                        Asisten Ar-Raudhah
                        <span class="text-[9px] px-1.5 py-0.5 rounded bg-red-600/60 font-bold uppercase">AI FAQ</span>
                    </h3>
                    <p class="text-[10px] text-slate-300 font-medium leading-tight mt-0.5">
                        Karya <strong class="text-amber-300 font-bold">Hugo Putra Pratama</strong>
                    </p>
                </div>
            </div>
            <div class="flex items-center gap-1">
                <button onclick="resetChat()" class="w-8 h-8 rounded-xl bg-white/10 hover:bg-white/20 text-slate-300 hover:text-white flex items-center justify-center text-xs transition" title="Mulai Ulang Percakapan">
                    <i class="fa-solid fa-rotate-left"></i>
                </button>
                <button onclick="toggleChatbot()" class="w-8 h-8 rounded-xl bg-white/10 hover:bg-white/20 text-slate-300 hover:text-white flex items-center justify-center text-xs transition" title="Tutup Chat">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        </div>

        <!-- Creator Mini Bar -->
        <div class="bg-gradient-to-r from-slate-900 to-blue-950 px-3.5 py-1.5 text-[11px] text-slate-300 flex items-center justify-between border-b border-slate-800">
            <span class="flex items-center gap-1.5 text-[10px] text-slate-300">
                <i class="fa-solid fa-code text-red-400 text-[10px]"></i> Pengembang: <strong class="text-white font-bold">Hugo Putra Pratama</strong>
            </span>
            <span class="text-[9px] bg-emerald-500/20 text-emerald-300 px-2 py-0.5 rounded-full font-bold">Online • 24/7</span>
        </div>

        <!-- Chat Messages Container -->
        <div id="chat-messages" class="flex-1 p-4 overflow-y-auto space-y-3 bg-slate-50 text-xs sm:text-sm select-text">

            <!-- Bot Welcome Bubble -->
            <div class="flex items-start gap-2.5">
                <div class="w-7 h-7 rounded-xl bg-gradient-to-tr from-slate-900 to-red-600 text-white flex items-center justify-center text-xs shrink-0 mt-1 shadow-xs">
                    <i class="fa-solid fa-robot"></i>
                </div>
                <div class="bg-white border border-slate-200 rounded-2xl rounded-tl-xs p-3.5 text-slate-800 shadow-xs max-w-[85%] space-y-2 leading-relaxed">
                    <p class="font-bold text-slate-900 text-xs">
                        Assalamu'alaikum! 👋
                    </p>
                    <p class="text-slate-600 text-xs leading-relaxed">
                        Saya Asisten Virtual <strong>Yayasan Cahaya Amanah Ar-Raudhah</strong>. Sistem munaqasyah ini dikembangkan oleh 
                        <strong class="text-red-600 font-bold">Hugo Putra Pratama</strong>.
                    </p>
                    <p class="text-slate-600 text-xs">
                        Ada yang bisa saya bantu terkait penilaian santri, mata uji, atau panduan sistem?
                    </p>
                </div>
            </div>

            <!-- Suggestion Chips Container -->
            <div id="chat-suggestions" class="space-y-1.5 pt-2">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider px-1">Pertanyaan Cepat:</p>
                <div class="flex flex-wrap gap-1.5">
                    <button type="button" onclick="askQuestion('Siapa pembuat sistem ini?')" class="suggestion-chip px-2.5 py-1.5 rounded-xl bg-white border border-slate-200 hover:border-red-500 hover:text-red-700 hover:bg-red-50 text-slate-700 text-[11px] font-semibold transition text-left shadow-2xs">
                        👨‍💻 Siapa pembuat sistem ini?
                    </button>
                    <button type="button" onclick="askQuestion('Apa saja 9 mata uji penilaian?')" class="suggestion-chip px-2.5 py-1.5 rounded-xl bg-white border border-slate-200 hover:border-blue-500 hover:text-blue-700 hover:bg-blue-50 text-slate-700 text-[11px] font-semibold transition text-left shadow-2xs">
                        📖 9 Mata Uji Munaqasyah
                    </button>
                    <button type="button" onclick="askQuestion('Bagaimana syarat kelulusan santri?')" class="suggestion-chip px-2.5 py-1.5 rounded-xl bg-white border border-slate-200 hover:border-amber-500 hover:text-amber-700 hover:bg-amber-50 text-slate-700 text-[11px] font-semibold transition text-left shadow-2xs">
                        🎓 Syarat Kelulusan
                    </button>
                    <button type="button" onclick="askQuestion('Bagaimana cara cetak surat kelulusan?')" class="suggestion-chip px-2.5 py-1.5 rounded-xl bg-white border border-slate-200 hover:border-red-500 hover:text-red-700 hover:bg-red-50 text-slate-700 text-[11px] font-semibold transition text-left shadow-2xs">
                        🖨️ Cara Cetak Surat Kelulusan
                    </button>
                    <button type="button" onclick="askQuestion('Bagaimana cara export Excel atau CSV?')" class="suggestion-chip px-2.5 py-1.5 rounded-xl bg-white border border-slate-200 hover:border-emerald-500 hover:text-emerald-700 hover:bg-emerald-50 text-slate-700 text-[11px] font-semibold transition text-left shadow-2xs">
                        📊 Export Data Excel
                    </button>
                    <button type="button" onclick="askQuestion('Apa perbedaan TPQ dan RTQ Ar-Raudhah?')" class="suggestion-chip px-2.5 py-1.5 rounded-xl bg-white border border-slate-200 hover:border-indigo-500 hover:text-indigo-700 hover:bg-indigo-50 text-slate-700 text-[11px] font-semibold transition text-left shadow-2xs">
                        🕌 Beda TPQ &amp; RTQ Ar-Raudhah
                    </button>
                </div>
            </div>

            <!-- Typing indicator (hidden by default) -->
            <div id="typing-indicator" class="hidden flex items-center gap-2 text-slate-400 text-xs px-2 py-1">
                <div class="w-6 h-6 rounded-lg bg-slate-200 flex items-center justify-center text-[10px] text-slate-600 shrink-0">
                    <i class="fa-solid fa-robot"></i>
                </div>
                <div class="flex gap-1 items-center bg-white border border-slate-200 px-3 py-2 rounded-2xl shadow-2xs">
                    <span class="w-1.5 h-1.5 rounded-full bg-slate-400 animate-bounce" style="animation-delay: 0s;"></span>
                    <span class="w-1.5 h-1.5 rounded-full bg-slate-400 animate-bounce" style="animation-delay: 0.2s;"></span>
                    <span class="w-1.5 h-1.5 rounded-full bg-slate-400 animate-bounce" style="animation-delay: 0.4s;"></span>
                </div>
            </div>

        </div>

        <!-- Chat Input Form -->
        <div class="p-3 bg-white border-t border-slate-200/90 shrink-0">
            <form id="chatbot-form" onsubmit="handleChatSubmit(event)" class="flex items-center gap-2">
                <input type="text"
                       id="chatbot-input"
                       placeholder="Ketik pertanyaan seputar sistem..."
                       autocomplete="off"
                       class="flex-1 px-3.5 py-2.5 rounded-2xl bg-slate-100 border border-slate-200 text-xs sm:text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-red-500/40 focus:border-red-500 transition">
                <button type="submit"
                        id="chatbot-send-btn"
                        class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-red-600 to-rose-600 text-white flex items-center justify-center shadow-md hover:scale-105 active:scale-95 transition cursor-pointer shrink-0"
                        title="Kirim Pesan">
                    <i class="fa-solid fa-paper-plane text-xs"></i>
                </button>
            </form>
            <div class="text-center mt-1.5">
                <span class="text-[9px] text-slate-400">
                    Sistem Penilaian Munaqasyah • Dibuat oleh <strong class="text-slate-600">Hugo Putra Pratama</strong>
                </span>
            </div>
        </div>

    </div>
</div>

<script>
    // FAQ Knowledge Base
    const FAQ_KNOWLEDGE = [
        {
            keywords: ['pembuat', 'hugo', 'putra', 'pratama', 'developer', 'creator', 'pembuatnya', 'siapa yang bikin', 'author', 'programmer', 'bikin', 'dibuat'],
            answer: `
                <div class="space-y-2">
                    <div class="p-2.5 rounded-xl bg-gradient-to-r from-red-50 via-rose-50 to-blue-50 border border-red-200">
                        <p class="font-black text-slate-900 text-xs sm:text-sm flex items-center gap-1.5">
                            👨‍💻 <span>Hugo Putra Pratama</span>
                        </p>
                        <p class="text-[11px] text-red-700 font-semibold mt-0.5">Software Engineer &amp; Full-Stack Developer</p>
                    </div>
                    <p class="text-slate-700 leading-relaxed text-xs">
                        Sistem Penilaian &amp; Kelulusan Munaqasyah ini <strong>dibuat dan dirancang secara eksklusif oleh Hugo Putra Pratama</strong> untuk <strong>Yayasan Cahaya Amanah Ar-Raudhah Banjarbaru</strong>.
                    </p>
                    <div class="text-[11px] text-slate-600 space-y-1">
                        <p>✨ <strong>Sorotan Teknologi:</strong></p>
                        <ul class="list-disc list-inside space-y-0.5 text-slate-500 pl-1">
                            <li>Laravel 12 &amp; Modern PHP 8.2+ Architecture</li>
                            <li>Palet Warna Resmi Ar-Raudhah (Navy Blue &amp; Crimson Red)</li>
                            <li>Kalkulasi Otomatis 9 Mata Uji &amp; Export Dokumen</li>
                            <li>Tampilan Responsif Mobile &amp; Desktop</li>
                        </ul>
                    </div>
                </div>
            `
        },
        {
            keywords: ['9', 'mata uji', 'indikator', 'komponen', 'aspek', 'ujian', 'fashohah', 'tajwid', 'gharib'],
            answer: `
                <div class="space-y-1.5">
                    <p class="font-bold text-slate-900">📖 9 Mata Uji Standar Munaqasyah:</p>
                    <ol class="list-decimal list-inside space-y-1 text-slate-700 pl-1">
                        <li><strong>Fashohah</strong> (Maks: 100) — Kelancaran membaca</li>
                        <li><strong>Tajwid</strong> (Maks: 100) — Ketepatan hukum tajwid</li>
                        <li><strong>Gharib &amp; Musykilat</strong> (Maks: 100) — Ayat-ayat asing/khusus</li>
                        <li><strong>Suara &amp; Lagu</strong> (Maks: 100) — Irama tartil santri</li>
                        <li><strong>Ayat Pilihan</strong> (Maks: 100) — Ujian tilawah acak</li>
                        <li><strong>Surah Pendek</strong> (Maks: 100) — Hafalan Juz 'Amma</li>
                        <li><strong>Doa Harian</strong> (Maks: 100) — Doa-doa harian praktis</li>
                        <li><strong>Bacaan Shalat</strong> (Maks: 100) — Doa &amp; gerakan sholat</li>
                        <li><strong>Ujian Tertulis</strong> (Maks: 100) — Dinul Islam &amp; tajwid teori</li>
                    </ol>
                    <p class="text-[11px] text-slate-500 pt-1">Seluruh nilai dihitung rata-rata dan totalnya secara otomatis oleh sistem!</p>
                </div>
            `
        },
        {
            keywords: ['syarat', 'kelulusan', 'lulus', 'tidak lulus', 'nilai minimum', 'standar', 'kkm', 'predikat'],
            answer: `
                <div class="space-y-1.5">
                    <p class="font-bold text-slate-900">🎓 Standar Kelulusan Santri:</p>
                    <p class="text-slate-700 leading-relaxed">
                        Santri dinyatakan <strong>LULUS</strong> jika memenuhi seluruh kriteria kelayakan pada 9 mata uji dengan predikat penilaian:
                    </p>
                    <ul class="space-y-1 text-slate-700 pl-1 text-[11px]">
                        <li>🌟 <strong>Istimewa (A)</strong>: Rata-rata 90 – 100</li>
                        <li>👍 <strong>Amat Baik (B)</strong>: Rata-rata 80 – 89</li>
                        <li>👌 <strong>Baik (C)</strong>: Rata-rata 70 – 79</li>
                        <li>⚠️ <strong>Cukup / Perbaikan</strong>: Rata-rata &lt; 70</li>
                    </ul>
                    <p class="text-[11px] text-slate-500 pt-1">Surat Keterangan Kelulusan resmi dapat langsung diterbitkan bagi santri yang berstatus Lulus.</p>
                </div>
            `
        },
        {
            keywords: ['cetak', 'surat', 'kelulusan', 'sertifikat', 'ijazah', 'rapor', 'print', 'pdf'],
            answer: `
                <div class="space-y-1.5">
                    <p class="font-bold text-slate-900">🖨️ Cara Cetak Surat Kelulusan:</p>
                    <ol class="list-decimal list-inside space-y-1 text-slate-700 pl-1">
                        <li>Buka menu <strong>TPQ Ar-Raudhah</strong> atau <strong>RTQ Ar-Raudhah</strong>.</li>
                        <li>Cari nama santri yang ingin dicetak surat kelulusannya.</li>
                        <li>Klik tombol <strong>"Sertifikat / Kelulusan"</strong> (ikon dokumen/print).</li>
                        <li>Halaman surat kelulusan berkop resmi Yayasan akan terbuka.</li>
                        <li>Klik tombol merah <strong>"Cetak Surat Kelulusan"</strong> di pojok kanan atas (otomatis memunculkan dialog print/simpan ke PDF).</li>
                    </ol>
                </div>
            `
        },
        {
            keywords: ['export', 'excel', 'csv', 'unduh', 'spreadsheet', 'download data', 'laporan'],
            answer: `
                <div class="space-y-1.5">
                    <p class="font-bold text-slate-900">📊 Cara Export Data ke Excel / CSV:</p>
                    <p class="text-slate-700">
                        Tersedia 2 format export resmi di menu sidebar:
                    </p>
                    <ul class="space-y-1 text-slate-700 pl-1 text-[11px]">
                        <li>🟢 <strong>Export Excel (.xls)</strong>: Rapi dengan header warna, tabel formal, dan formula nilai.</li>
                        <li>🔵 <strong>Export Spreadsheet (.csv)</strong>: Ringan dan kompatibel dengan Google Sheets &amp; aplikasi data lainnya.</li>
                    </ul>
                    <p class="text-[11px] text-slate-500">Anda juga dapat memfilter berdasarkan unit tertentu sebelum melakukan export.</p>
                </div>
            `
        },
        {
            keywords: ['beda', 'tpq', 'rtq', 'perbedaan', 'taman pendidikan', 'rumah tahfidz'],
            answer: `
                <div class="space-y-2">
                    <p class="font-bold text-slate-900">🕌 Dua Lembaga Naungan Yayasan Ar-Raudhah:</p>
                    <div class="p-2.5 rounded-xl bg-blue-50 border border-blue-200">
                        <p class="font-bold text-blue-950">1. TPQ Ar-Raudhah (Taman Pendidikan Qur'an)</p>
                        <p class="text-[11px] text-slate-600 mt-0.5">Fokus pada pembinaan tartil dasar membaca Al-Qur'an, tajwid praktis, makharijul huruf, gharib, adab harian, dan doa-doa pendek.</p>
                    </div>
                    <div class="p-2.5 rounded-xl bg-red-50 border border-red-200">
                        <p class="font-bold text-red-950">2. RTQ Ar-Raudhah (Rumah Tahfidz Qur'an)</p>
                        <p class="text-[11px] text-slate-600 mt-0.5">Program intensif penghafalan Al-Qur'an berjenjang (Juz 'Amma &amp; surah tematik), muraja'ah berkala, dan penguatan mutqin hafalan santri.</p>
                    </div>
                </div>
            `
        },
        {
            keywords: ['user', 'pengguna', 'admin', 'tambah akun', 'kelola pengguna', 'password', 'login'],
            answer: `
                <div class="space-y-1.5">
                    <p class="font-bold text-slate-900">👥 Kelola Pengguna Sistem:</p>
                    <p class="text-slate-700">
                        Anda dapat menambah dan mengatur akun pengelola melalui menu <strong>Kelola Pengguna</strong> di sidebar:
                    </p>
                    <ul class="space-y-1 text-slate-700 pl-1 text-[11px]">
                        <li>🛡️ <strong>Administrator</strong>: Memiliki hak akses penuh ke seluruh pengaturan.</li>
                        <li>📖 <strong>Penguji TPQ</strong>: Diberikan akses input &amp; penilaian santri TPQ.</li>
                        <li>🕌 <strong>Penguji RTQ</strong>: Diberikan akses input &amp; penilaian santri RTQ.</li>
                        <li>📋 <strong>Panitia</strong>: Membantu administrasi &amp; rekapitulasi data.</li>
                    </ul>
                    <p class="text-[11px] text-slate-500">Kredensial username dan password disimpan secara aman dengan hashing di database.</p>
                </div>
            `
        },
        {
            keywords: ['alamat', 'lokasi', 'yayasan', 'banjarbaru', 'kontak', 'telepon', 'cahaya amanah'],
            answer: `
                <div class="space-y-1.5">
                    <p class="font-bold text-slate-900">📍 Yayasan Cahaya Amanah Ar-Raudhah:</p>
                    <p class="text-slate-700 text-xs leading-relaxed">
                        Lembaga pendidikan Al-Qur'an terpadu yang berkedudukan di <strong>Banjarbaru, Kalimantan Selatan</strong>, membina santri Taman Pendidikan Qur'an (TPQ) dan Rumah Tahfidz Qur'an (RTQ).
                    </p>
                    <p class="text-[11px] text-slate-500">Platform munaqasyah ini menjamin transparansi, objektivitas, dan standarisasi kelulusan santri generasi Qur'ani.</p>
                </div>
            `
        }
    ];

    // Toggle Chat Window
    function toggleChatbot() {
        const win = document.getElementById('chatbot-window');
        const iconOpen = document.getElementById('chat-icon-open');
        const iconClose = document.getElementById('chat-icon-close');

        if (win.classList.contains('hidden')) {
            win.classList.remove('hidden');
            win.classList.add('flex');
            iconOpen.classList.add('hidden');
            iconClose.classList.remove('hidden');
            setTimeout(() => document.getElementById('chatbot-input').focus(), 150);
            scrollChatBottom();
        } else {
            win.classList.add('hidden');
            win.classList.remove('flex');
            iconOpen.classList.remove('hidden');
            iconClose.classList.add('hidden');
        }
    }

    // Scroll to bottom
    function scrollChatBottom() {
        const container = document.getElementById('chat-messages');
        container.scrollTop = container.scrollHeight;
    }

    // Handle Form Submit
    function handleChatSubmit(e) {
        e.preventDefault();
        const input = document.getElementById('chatbot-input');
        const text = input.value.trim();
        if (!text) return;

        askQuestion(text);
        input.value = '';
    }

    // Ask Question function
    function askQuestion(query) {
        const messages = document.getElementById('chat-messages');
        const typing = document.getElementById('typing-indicator');

        // Add user bubble
        const userHtml = `
            <div class="flex items-start justify-end gap-2.5">
                <div class="bg-gradient-to-r from-red-600 to-rose-600 text-white rounded-2xl rounded-tr-xs p-3 shadow-xs max-w-[85%] font-medium leading-relaxed">
                    ${escapeHtml(query)}
                </div>
            </div>
        `;
        messages.insertAdjacentHTML('beforeend', userHtml);
        scrollChatBottom();

        // Show typing indicator
        typing.classList.remove('hidden');
        scrollChatBottom();

        // Simulate thinking delay
        setTimeout(() => {
            typing.classList.add('hidden');
            const botAnswer = findAnswer(query);

            const botHtml = `
                <div class="flex items-start gap-2.5">
                    <div class="w-7 h-7 rounded-xl bg-gradient-to-tr from-slate-900 to-red-600 text-white flex items-center justify-center text-xs shrink-0 mt-1 shadow-xs">
                        <i class="fa-solid fa-robot"></i>
                    </div>
                    <div class="bg-white border border-slate-200 rounded-2xl rounded-tl-xs p-3.5 text-slate-800 shadow-xs max-w-[88%] space-y-2 leading-relaxed">
                        ${botAnswer}
                    </div>
                </div>
            `;
            messages.insertAdjacentHTML('beforeend', botHtml);
            scrollChatBottom();
        }, 450);
    }

    // Find Answer with fuzzy keyword matching
    function findAnswer(query) {
        const q = query.toLowerCase();

        for (const item of FAQ_KNOWLEDGE) {
            for (const key of item.keywords) {
                if (q.includes(key)) {
                    return item.answer;
                }
            }
        }

        // Default Fallback
        return `
            <div class="space-y-2">
                <p class="font-bold text-slate-800">Terima kasih atas pertanyaannya! 😊</p>
                <p class="text-slate-600 text-xs leading-relaxed">
                    Saya dapat membantu Anda memberikan informasi seputar:
                </p>
                <ul class="list-disc list-inside space-y-1 text-slate-600 text-[11px] pl-1">
                    <li><strong>Pembuat Sistem</strong> (Karya <strong>Hugo Putra Pratama</strong>)</li>
                    <li><strong>9 Mata Uji Munaqasyah</strong> (Fashohah, Tajwid, dll.)</li>
                    <li><strong>Standar &amp; Syarat Kelulusan Santri</strong></li>
                    <li><strong>Cara Cetak Surat Kelulusan</strong></li>
                    <li><strong>Export Data Excel &amp; Spreadsheet</strong></li>
                    <li><strong>Perbedaan TPQ &amp; RTQ Ar-Raudhah</strong></li>
                </ul>
                <p class="text-[11px] text-slate-500">Silakan klik salah satu topik di atas atau tanyakan dengan kata kunci yang lebih spesifik.</p>
            </div>
        `;
    }

    // Reset Chat
    function resetChat() {
        const messages = document.getElementById('chat-messages');
        messages.innerHTML = `
            <div class="flex items-start gap-2.5">
                <div class="w-7 h-7 rounded-xl bg-gradient-to-tr from-slate-900 to-red-600 text-white flex items-center justify-center text-xs shrink-0 mt-1 shadow-xs">
                    <i class="fa-solid fa-robot"></i>
                </div>
                <div class="bg-white border border-slate-200 rounded-2xl rounded-tl-xs p-3.5 text-slate-800 shadow-xs max-w-[85%] space-y-2 leading-relaxed">
                    <p class="font-bold text-slate-900 text-xs">
                        Percakapan telah dimulai ulang. 👋
                    </p>
                    <p class="text-slate-600 text-xs leading-relaxed">
                        Sistem munaqasyah ini dikembangkan oleh <strong class="text-red-600 font-bold">Hugo Putra Pratama</strong>.
                    </p>
                    <p class="text-slate-600 text-xs">
                        Silakan tanyakan hal apa pun yang ingin Anda ketahui!
                    </p>
                </div>
            </div>

            <div id="chat-suggestions" class="space-y-1.5 pt-2">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider px-1">Pertanyaan Cepat:</p>
                <div class="flex flex-wrap gap-1.5">
                    <button type="button" onclick="askQuestion('Siapa pembuat sistem ini?')" class="suggestion-chip px-2.5 py-1.5 rounded-xl bg-white border border-slate-200 hover:border-red-500 hover:text-red-700 hover:bg-red-50 text-slate-700 text-[11px] font-semibold transition text-left shadow-2xs">
                        👨‍💻 Siapa pembuat sistem ini?
                    </button>
                    <button type="button" onclick="askQuestion('Apa saja 9 mata uji penilaian?')" class="suggestion-chip px-2.5 py-1.5 rounded-xl bg-white border border-slate-200 hover:border-blue-500 hover:text-blue-700 hover:bg-blue-50 text-slate-700 text-[11px] font-semibold transition text-left shadow-2xs">
                        📖 9 Mata Uji Munaqasyah
                    </button>
                    <button type="button" onclick="askQuestion('Bagaimana syarat kelulusan santri?')" class="suggestion-chip px-2.5 py-1.5 rounded-xl bg-white border border-slate-200 hover:border-amber-500 hover:text-amber-700 hover:bg-amber-50 text-slate-700 text-[11px] font-semibold transition text-left shadow-2xs">
                        🎓 Syarat Kelulusan
                    </button>
                    <button type="button" onclick="askQuestion('Bagaimana cara cetak surat kelulusan?')" class="suggestion-chip px-2.5 py-1.5 rounded-xl bg-white border border-slate-200 hover:border-red-500 hover:text-red-700 hover:bg-red-50 text-slate-700 text-[11px] font-semibold transition text-left shadow-2xs">
                        🖨️ Cara Cetak Surat Kelulusan
                    </button>
                </div>
            </div>

            <div id="typing-indicator" class="hidden flex items-center gap-2 text-slate-400 text-xs px-2 py-1">
                <div class="w-6 h-6 rounded-lg bg-slate-200 flex items-center justify-center text-[10px] text-slate-600 shrink-0">
                    <i class="fa-solid fa-robot"></i>
                </div>
                <div class="flex gap-1 items-center bg-white border border-slate-200 px-3 py-2 rounded-2xl shadow-2xs">
                    <span class="w-1.5 h-1.5 rounded-full bg-slate-400 animate-bounce" style="animation-delay: 0s;"></span>
                    <span class="w-1.5 h-1.5 rounded-full bg-slate-400 animate-bounce" style="animation-delay: 0.2s;"></span>
                    <span class="w-1.5 h-1.5 rounded-full bg-slate-400 animate-bounce" style="animation-delay: 0.4s;"></span>
                </div>
            </div>
        `;
    }

    function escapeHtml(str) {
        return str.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
    }
</script>
