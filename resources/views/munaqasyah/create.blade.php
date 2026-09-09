@extends('layouts.sidebar')

@section('title', 'Tambah Santri ' . ($jenis == 'TPQ' ? "Taman Pendidikan Qur'an Ar-Raudhah" : "Rumah Tahfidz Qur'an Ar-Raudhah"))

@section('breadcrumb')
    <a href="{{ route('munaqasyah.index', ['jenis' => $jenis]) }}" class="hover:text-blue-900 transition">Penilaian {{ $jenis == 'TPQ' ? "TPQ Ar-Raudhah" : "RTQ Ar-Raudhah" }}</a>
    <i class="fa-solid fa-chevron-right text-[9px]"></i>
    <span class="text-blue-950 font-bold">Tambah Santri</span>
@endsection

@section('content')
<div class="max-w-4xl mx-auto space-y-5 sm:space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 bg-white p-4 sm:p-5 rounded-2xl border border-slate-200 shadow-xs">
        <div>
            <div class="flex items-center gap-2">
                <span class="text-xs font-bold px-2.5 py-0.5 rounded-full {{ $jenis == 'TPQ' ? 'bg-amber-100 text-amber-900 border border-amber-300' : 'bg-blue-100 text-blue-950 border border-blue-300' }}">
                    {{ $jenis == 'TPQ' ? "Taman Pendidikan Qur'an Ar-Raudhah" : "Rumah Tahfidz Qur'an Ar-Raudhah" }}
                </span>
                <h2 class="text-base sm:text-lg font-extrabold text-slate-900">Tambah Data Santri & Penilaian</h2>
            </div>
            <p class="text-xs text-slate-500 mt-1">Input biodata peserta munaqasyah, upload pas foto kelulusan, dan nilai 9 mata uji.</p>
        </div>
        <a href="{{ route('munaqasyah.index', ['jenis' => $jenis]) }}" 
           class="inline-flex items-center justify-center gap-2 text-xs font-semibold text-slate-600 hover:text-slate-900 bg-slate-100 hover:bg-slate-200 border border-slate-200 px-3.5 py-2 rounded-xl transition self-start sm:self-auto shrink-0">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar
        </a>
    </div>

    @if ($errors->any())
        <div class="bg-rose-50 border-l-4 border-rose-500 p-4 rounded-r-xl text-rose-800 text-xs shadow-xs">
            <div class="flex items-center gap-2 font-bold mb-1.5">
                <i class="fa-solid fa-circle-exclamation text-rose-600 text-sm"></i>
                <span>Terdapat kesalahan input:</span>
            </div>
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('munaqasyah.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5 sm:space-y-6">
        @csrf

        <!-- CARD 1: BIODATA SANTRI & FOTO KELULUSAN -->
        <div class="bg-white p-4 sm:p-6 rounded-2xl border border-slate-200 shadow-xs space-y-5">
            <div class="border-b border-slate-100 pb-3 flex items-center justify-between">
                <h3 class="text-sm font-bold text-slate-800 flex items-center gap-2">
                    <span class="w-6 h-6 rounded-lg bg-blue-100 text-blue-950 flex items-center justify-center text-xs font-black">1</span>
                    Identitas Santri & Pas Foto Kelulusan
                </h3>
                <span class="text-[11px] text-blue-950 bg-blue-50 border border-blue-200 px-2.5 py-0.5 rounded-full font-bold">
                    {{ $jenis }}
                </span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 sm:gap-6">
                <!-- Upload Pas Foto -->
                <div class="md:col-span-1 flex flex-col items-center justify-center p-4 bg-slate-50 border-2 border-dashed border-slate-300 hover:border-blue-500 rounded-2xl transition">
                    <div class="w-28 h-36 sm:w-32 sm:h-40 bg-slate-200 rounded-xl overflow-hidden border border-slate-300 shadow-inner flex items-center justify-center relative mb-3">
                        <img id="photo-preview" src="https://ui-avatars.com/api/?name=Foto+Santri&background=e2e8f0&color=64748b&size=200" 
                             alt="Preview Pas Foto" class="w-full h-full object-cover">
                    </div>
                    <label class="cursor-pointer bg-blue-950 hover:bg-slate-900 text-white text-xs font-bold px-3.5 py-2 rounded-xl shadow-xs transition inline-flex items-center gap-1.5 active:scale-95">
                        <i class="fa-solid fa-camera"></i> Pilih Pas Foto
                        <input type="file" name="foto" id="foto-input" accept="image/*" class="hidden" onchange="previewImage(this)">
                    </label>
                    <p class="text-[10px] text-slate-400 mt-2 text-center leading-tight">Format JPG/PNG/WEBP (Maks 2MB). Foto akan tercetak pada surat kelulusan.</p>
                </div>

                <!-- Input Identitas -->
                <div class="md:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-3.5 sm:gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Jenis Lembaga <span class="text-rose-500">*</span></label>
                        <select name="jenis" class="w-full text-xs p-2.5 bg-slate-50 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-600 focus:border-blue-600 focus:bg-white focus:outline-none transition font-semibold">
                            <option value="TPQ" {{ $jenis == 'TPQ' ? 'selected' : '' }}>TPQ - Taman Pendidikan Qur'an Ar-Raudhah</option>
                            <option value="RTQ" {{ $jenis == 'RTQ' ? 'selected' : '' }}>RTQ - Rumah Tahfidz Qur'an Ar-Raudhah</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Nama Unit / Lembaga <span class="text-rose-500">*</span></label>
                        <input type="text" name="nama_unit" value="{{ old('nama_unit', 'AL-FALAH') }}" required placeholder="cth: AL-FALAH"
                               class="w-full text-xs p-2.5 bg-slate-50 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-600 focus:border-blue-600 focus:bg-white focus:outline-none transition">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">No. Peserta</label>
                        <input type="text" name="no_peserta" value="{{ old('no_peserta') }}" placeholder="cth: 1 atau 001"
                               class="w-full text-xs p-2.5 bg-slate-50 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-600 focus:border-blue-600 focus:bg-white focus:outline-none transition font-mono">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">No. Unit</label>
                        <input type="text" name="no_unit" value="{{ old('no_unit') }}" placeholder="cth: 1"
                               class="w-full text-xs p-2.5 bg-slate-50 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-600 focus:border-blue-600 focus:bg-white focus:outline-none transition font-mono">
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-xs font-bold text-slate-700 mb-1">Nama Santri / Siswa <span class="text-rose-500">*</span></label>
                        <input type="text" name="nama" value="{{ old('nama') }}" required placeholder="cth: MUHAMMAD AL-FATIH"
                               class="w-full text-xs p-2.5 bg-slate-50 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-600 focus:border-blue-600 focus:bg-white focus:outline-none transition uppercase font-bold text-slate-800">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="w-full text-xs p-2.5 bg-slate-50 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-600 focus:border-blue-600 focus:bg-white focus:outline-none transition">
                            <option value="">Pilih...</option>
                            <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki (L)</option>
                            <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan (P)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Status Kelulusan</label>
                        <select name="status_kelulusan" class="w-full text-xs p-2.5 bg-slate-50 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-600 focus:border-blue-600 focus:bg-white focus:outline-none transition font-bold text-blue-900">
                            <option value="LULUS" {{ old('status_kelulusan', 'LULUS') == 'LULUS' ? 'selected' : '' }}>LULUS</option>
                            <option value="TIDAK LULUS" {{ old('status_kelulusan') == 'TIDAK LULUS' ? 'selected' : '' }}>TIDAK LULUS</option>
                            <option value="PENDING" {{ old('status_kelulusan') == 'PENDING' ? 'selected' : '' }}>PENDING / TERTUNDA</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- CARD 2: NILAI MUNAQASYAH (9 KOMPONEN PENILAIAN) -->
        <div class="bg-white p-4 sm:p-6 rounded-2xl border border-slate-200 shadow-xs space-y-5">
            <div class="border-b border-slate-100 pb-3 flex items-center justify-between">
                <h3 class="text-sm font-bold text-slate-800 flex items-center gap-2">
                    <span class="w-6 h-6 rounded-lg bg-blue-100 text-blue-800 flex items-center justify-center text-xs font-black">2</span>
                    Nilai Ujian Munaqasyah (9 Komponen Penilaian)
                </h3>
                <span class="text-[11px] text-slate-500 font-medium">Rentang: 0 - 100</span>
            </div>

            <!-- BAGIAN A: MUNAQASYAH BACAAN -->
            <div>
                <h4 class="text-xs font-extrabold text-blue-950 uppercase tracking-wider bg-blue-50 border border-blue-200/80 px-3 py-1.5 rounded-xl mb-3 flex items-center gap-2">
                    <i class="fa-solid fa-book-open text-blue-700"></i> A. Munaqasyah Bacaan (4 Materi)
                </h4>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                    <div>
                        <label class="block text-[11px] font-semibold text-slate-700 mb-1">Fashohah</label>
                        <input type="number" step="any" name="fashohah" id="fashohah" value="{{ old('fashohah', 90) }}" 
                               class="score-input w-full text-xs p-2.5 bg-slate-50 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-600 focus:border-blue-600 focus:bg-white font-mono font-bold">
                    </div>
                    <div>
                        <label class="block text-[11px] font-semibold text-slate-700 mb-1">Tajwid</label>
                        <input type="number" step="any" name="tajwid" id="tajwid" value="{{ old('tajwid', 88) }}" 
                               class="score-input w-full text-xs p-2.5 bg-slate-50 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-600 focus:border-blue-600 focus:bg-white font-mono font-bold">
                    </div>
                    <div>
                        <label class="block text-[11px] font-semibold text-slate-700 mb-1">Gharib Musykilat</label>
                        <input type="number" step="any" name="gharib_musykilat" id="gharib_musykilat" value="{{ old('gharib_musykilat', 90) }}" 
                               class="score-input w-full text-xs p-2.5 bg-slate-50 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-600 focus:border-blue-600 focus:bg-white font-mono font-bold">
                    </div>
                    <div>
                        <label class="block text-[11px] font-semibold text-slate-700 mb-1">Suara & Lagu</label>
                        <input type="number" step="any" name="suara_lagu" id="suara_lagu" value="{{ old('suara_lagu', 85) }}" 
                               class="score-input w-full text-xs p-2.5 bg-slate-50 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-600 focus:border-blue-600 focus:bg-white font-mono font-bold">
                    </div>
                </div>
            </div>

            <!-- BAGIAN B: MUNAQASYAH HAFALAN -->
            <div>
                <h4 class="text-xs font-extrabold text-amber-950 uppercase tracking-wider bg-amber-50 border border-amber-200/80 px-3 py-1.5 rounded-xl mb-3 flex items-center gap-2">
                    <i class="fa-solid fa-brain text-amber-600"></i> B. Munaqasyah Hafalan (4 Materi)
                </h4>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                    <div>
                        <label class="block text-[11px] font-semibold text-slate-700 mb-1">Ayat Pilihan</label>
                        <input type="number" step="any" name="ayat_pilihan" id="ayat_pilihan" value="{{ old('ayat_pilihan', 95) }}" 
                               class="score-input w-full text-xs p-2.5 bg-slate-50 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-600 focus:border-blue-600 focus:bg-white font-mono font-bold">
                    </div>
                    <div>
                        <label class="block text-[11px] font-semibold text-slate-700 mb-1">Surah Pendek</label>
                        <input type="number" step="any" name="surah_pendek" id="surah_pendek" value="{{ old('surah_pendek', 95) }}" 
                               class="score-input w-full text-xs p-2.5 bg-slate-50 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-600 focus:border-blue-600 focus:bg-white font-mono font-bold">
                    </div>
                    <div>
                        <label class="block text-[11px] font-semibold text-slate-700 mb-1">Doa Harian</label>
                        <input type="number" step="any" name="doa_harian" id="doa_harian" value="{{ old('doa_harian', 90) }}" 
                               class="score-input w-full text-xs p-2.5 bg-slate-50 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-600 focus:border-blue-600 focus:bg-white font-mono font-bold">
                    </div>
                    <div>
                        <label class="block text-[11px] font-semibold text-slate-700 mb-1">Bacaan Shalat</label>
                        <input type="number" step="any" name="bacaan_shalat" id="bacaan_shalat" value="{{ old('bacaan_shalat', 95) }}" 
                               class="score-input w-full text-xs p-2.5 bg-slate-50 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-600 focus:border-blue-600 focus:bg-white font-mono font-bold">
                    </div>
                </div>
            </div>

            <!-- BAGIAN C: UJIAN TERTULIS -->
            <div>
                <h4 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider bg-slate-100 border border-slate-200 px-3 py-1.5 rounded-xl mb-3 flex items-center gap-2">
                    <i class="fa-solid fa-pen-nib text-slate-700"></i> C. Ujian Tertulis
                </h4>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3">
                    <div>
                        <label class="block text-[11px] font-semibold text-slate-700 mb-1">Ujian Tertulis (Teori)</label>
                        <input type="number" step="any" name="ujian_tertulis" id="ujian_tertulis" value="{{ old('ujian_tertulis', 90) }}" 
                               class="score-input w-full text-xs p-2.5 bg-slate-50 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-600 focus:border-blue-600 focus:bg-white font-mono font-bold">
                    </div>
                </div>
            </div>

            <!-- KALKULASI OTOMATIS LIVE -->
            <div class="bg-gradient-to-br from-slate-50 to-blue-50/50 border border-slate-200 rounded-2xl p-4 sm:p-5 flex flex-col md:flex-row md:items-center justify-between gap-4 shadow-xs">
                <div>
                    <span class="text-[10px] uppercase font-bold text-blue-950 tracking-wider flex items-center gap-1.5 mb-2">
                        <i class="fa-solid fa-calculator text-blue-600"></i>
                        Kalkulasi Otomatis Sistem:
                    </span>
                    <div class="grid grid-cols-3 sm:flex sm:items-center gap-3 sm:gap-6">
                        <div class="bg-white p-2 sm:p-0 rounded-xl sm:bg-transparent shadow-xs sm:shadow-none border border-slate-200 sm:border-none">
                            <span class="text-[10px] sm:text-xs text-slate-500 block sm:inline">Total:</span>
                            <span id="display-total" class="font-mono font-black text-base sm:text-lg text-slate-900 block sm:inline sm:ml-1">0</span>
                        </div>
                        <div class="bg-white p-2 sm:p-0 rounded-xl sm:bg-transparent shadow-xs sm:shadow-none border border-slate-200 sm:border-none">
                            <span class="text-[10px] sm:text-xs text-slate-500 block sm:inline">Rata-rata:</span>
                            <span id="display-avg" class="font-mono font-black text-base sm:text-lg text-blue-950 block sm:inline sm:ml-1">0.00</span>
                        </div>
                        <div class="bg-white p-2 sm:p-0 rounded-xl sm:bg-transparent col-span-3 sm:col-span-1 shadow-xs sm:shadow-none border border-slate-200 sm:border-none">
                            <span class="text-[10px] sm:text-xs text-slate-500 block sm:inline">Predikat:</span>
                            <span id="display-predikat" class="font-bold text-xs text-slate-900 bg-amber-200 px-2 py-0.5 rounded-lg inline-block sm:ml-1 mt-0.5 sm:mt-0">-</span>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-3 pt-2 md:pt-0 border-t md:border-t-0 border-slate-200">
                    <button type="submit" class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs px-6 py-3 rounded-xl shadow-xs transition flex items-center justify-center gap-2 active:scale-95">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan Data Santri
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('photo-preview').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function calculateScores() {
        const inputs = document.querySelectorAll('.score-input');
        let total = 0;
        let count = 0;

        inputs.forEach(input => {
            const val = parseFloat(input.value) || 0;
            total += val;
            count++;
        });

        const avg = count > 0 ? (total / count) : 0;
        document.getElementById('display-total').textContent = total.toFixed(0);
        document.getElementById('display-avg').textContent = avg.toFixed(2);

        let predikat = 'Rasib (Kurang)';
        if (avg >= 90) predikat = 'Mumtaz (Istimewa)';
        else if (avg >= 80) predikat = 'Jayyid Jiddan (Sangat Baik)';
        else if (avg >= 70) predikat = 'Jayyid (Baik)';
        else if (avg >= 60) predikat = 'Maqbul (Cukup)';

        document.getElementById('display-predikat').textContent = predikat;
    }

    document.querySelectorAll('.score-input').forEach(input => {
        input.addEventListener('input', calculateScores);
    });

    // Run on init
    calculateScores();
</script>
@endsection
