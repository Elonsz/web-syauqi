<!-- MODAL PERINGATAN HAPUS DATA SANTRI (PREMIUM WARNING DIALOG) -->
<div id="globalDeleteModal" 
     class="fixed inset-0 z-[100] hidden items-center justify-center p-4 bg-slate-950/70 backdrop-blur-md transition-opacity duration-200"
     role="dialog" 
     aria-modal="true" 
     aria-labelledby="globalDeleteModalTitle">

    <div id="globalDeleteModalBox" 
         class="bg-white rounded-3xl max-w-md w-full p-6 sm:p-7 space-y-5 shadow-2xl border border-slate-200/90 relative overflow-hidden transform transition-all duration-200 scale-95 opacity-0">
        
        <!-- Background Decorative Glow -->
        <div class="absolute -top-24 -right-24 w-48 h-48 bg-rose-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -left-24 w-48 h-48 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <!-- Animated Warning Icon -->
        <div class="text-center pt-2 relative">
            <div class="relative inline-flex items-center justify-center">
                <span class="absolute w-20 h-20 rounded-3xl bg-rose-500/20 animate-ping"></span>
                <span class="absolute w-20 h-20 rounded-3xl bg-rose-500/15 animate-pulse"></span>
                <div class="relative w-16 h-16 rounded-2xl bg-gradient-to-tr from-rose-600 via-rose-500 to-red-600 text-white flex items-center justify-center text-2xl shadow-xl shadow-rose-600/30">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                </div>
            </div>

            <div class="mt-4">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-rose-100 text-rose-700 border border-rose-200">
                    <i class="fa-solid fa-shield-halved text-[9px]"></i> Tindakan Permanen
                </span>
                <h3 id="globalDeleteModalTitle" class="text-lg sm:text-xl font-black text-slate-900 mt-2 tracking-tight">
                    Hapus Data Santri?
                </h3>
                <p class="text-xs text-slate-500 mt-1">
                    Pastikan Anda yakin sebelum menghapus data santri di bawah ini:
                </p>
            </div>
        </div>

        <!-- Preview Kartu Santri Target -->
        <div class="bg-slate-50/90 border border-slate-200 rounded-2xl p-3.5 flex items-center gap-3.5 shadow-2xs">
            <div class="w-12 h-12 rounded-xl bg-gradient-to-tr from-slate-800 to-blue-900 text-white flex items-center justify-center text-lg font-bold shrink-0 shadow-xs">
                <i class="fa-solid fa-user-graduate"></i>
            </div>
            <div class="flex-1 min-w-0">
                <h4 id="globalDeleteSantriNama" class="text-sm font-black text-slate-900 truncate">
                    Nama Santri
                </h4>
                <div class="flex items-center gap-1.5 mt-1 flex-wrap">
                    <span id="globalDeleteSantriNo" class="font-mono text-[10px] font-bold text-slate-600 bg-white border border-slate-200 px-2 py-0.5 rounded-md">
                        No. Peserta: -
                    </span>
                    <span id="globalDeleteSantriUnit" class="text-[10px] font-extrabold px-2 py-0.5 rounded-md bg-blue-100 text-blue-900">
                        Unit
                    </span>
                </div>
            </div>
        </div>

        <!-- Dampak Penghapusan (Warning Details) -->
        <div class="bg-rose-50/80 border border-rose-200 rounded-2xl p-4 text-xs space-y-2">
            <div class="flex items-center gap-2 font-bold text-rose-900">
                <i class="fa-solid fa-circle-exclamation text-rose-600 text-sm"></i>
                <span>Data yang akan ikut terhapus permanen:</span>
            </div>
            <ul class="text-[11px] text-rose-900/90 space-y-1.5 pl-5 list-disc leading-relaxed">
                <li>Berkas biodata lengkap, foto identitas, dan NISN siswa.</li>
                <li>Transkrip nilai 9 mata uji database sekolah &amp; status kelulusan.</li>
                <li>Tautan publik cetak sertifikat &amp; QR code kelulusan wali santri.</li>
            </ul>
        </div>

        <!-- Tombol Aksi Form -->
        <form id="globalDeleteForm" method="POST" action="" onsubmit="handleGlobalDeleteSubmit(event)" class="space-y-3">
            @csrf
            @method('DELETE')

            <div class="flex items-center gap-2.5 pt-1">
                <button type="button" 
                        onclick="closeGlobalDeleteModal()" 
                        class="flex-1 py-3 px-4 rounded-xl text-xs sm:text-sm font-bold text-slate-700 bg-slate-100 hover:bg-slate-200 border border-slate-200 transition active:scale-95 flex items-center justify-center gap-1.5">
                    <i class="fa-solid fa-xmark text-slate-400"></i>
                    <span>Batalkan</span>
                </button>

                <button type="submit" 
                        id="globalDeleteSubmitBtn"
                        class="flex-1 py-3 px-4 rounded-xl text-xs sm:text-sm font-black text-white bg-gradient-to-r from-rose-600 to-red-600 hover:from-rose-700 hover:to-red-700 shadow-lg shadow-rose-600/30 transition active:scale-95 flex items-center justify-center gap-2">
                    <i class="fa-solid fa-trash-can text-rose-200"></i>
                    <span id="globalDeleteSubmitText">Ya, Hapus Data</span>
                </button>
            </div>
        </form>

    </div>
</div>

<script>
    function openGlobalDeleteModal(deleteUrl, nama, noPeserta = '-', unit = 'Santri') {
        const modal = document.getElementById('globalDeleteModal');
        const box   = document.getElementById('globalDeleteModalBox');
        const form  = document.getElementById('globalDeleteForm');
        const namaEl = document.getElementById('globalDeleteSantriNama');
        const noEl   = document.getElementById('globalDeleteSantriNo');
        const unitEl = document.getElementById('globalDeleteSantriUnit');
        const submitBtn = document.getElementById('globalDeleteSubmitBtn');
        const submitText = document.getElementById('globalDeleteSubmitText');

        if (!modal || !box || !form) return;

        form.action = deleteUrl;
        namaEl.textContent = nama || 'Data Santri';
        noEl.textContent = 'No. Peserta: #' + (noPeserta || '-');
        unitEl.textContent = unit || 'Santri';

        // Reset submit button state
        submitBtn.disabled = false;
        submitText.textContent = 'Ya, Hapus Data';

        // Tampilkan modal dengan transisi mulus
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        
        requestAnimationFrame(() => {
            box.classList.remove('scale-95', 'opacity-0');
            box.classList.add('scale-100', 'opacity-100');
        });
    }

    function closeGlobalDeleteModal() {
        const modal = document.getElementById('globalDeleteModal');
        const box   = document.getElementById('globalDeleteModalBox');

        if (!modal || !box) return;

        box.classList.remove('scale-100', 'opacity-100');
        box.classList.add('scale-95', 'opacity-0');

        setTimeout(() => {
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }, 150);
    }

    function handleGlobalDeleteSubmit(e) {
        const submitBtn = document.getElementById('globalDeleteSubmitBtn');
        const submitText = document.getElementById('globalDeleteSubmitText');
        
        submitBtn.disabled = true;
        submitBtn.classList.add('opacity-75', 'cursor-not-allowed');
        submitText.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin mr-1.5"></i> Sedang Menghapus...';
    }

    // Tutup jika klik di luar box modal
    document.addEventListener('click', function(e) {
        const modal = document.getElementById('globalDeleteModal');
        if (modal && e.target === modal) {
            closeGlobalDeleteModal();
        }
    });

    // Tutup jika tekan tombol ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const modal = document.getElementById('globalDeleteModal');
            if (modal && !modal.classList.contains('hidden')) {
                closeGlobalDeleteModal();
            }
        }
    });
</script>
