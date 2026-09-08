@extends('layouts.app')

@section('title', 'Edit Santri - ' . $santri->nama)

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-extrabold text-slate-800">Edit Data Santri & Penilaian</h2>
            <p class="text-xs text-slate-500">Ubah biodata peserta, update foto kelulusan, atau perbarui nilai ujian munaqasyah.</p>
        </div>
        <a href="{{ route('munaqasyah.index', ['jenis' => $santri->jenis]) }}" class="text-xs text-slate-600 hover:text-slate-900 bg-white border border-slate-200 px-3 py-1.5 rounded-lg shadow-xs">
            <i class="fa-solid fa-arrow-left mr-1"></i> Kembali
        </a>
    </div>

    @if ($errors->any())
        <div class="bg-rose-50 border-l-4 border-rose-500 p-4 rounded-r-lg text-rose-800 text-xs">
            <p class="font-bold mb-1">Terjadi kesalahan input:</p>
            <ul class="list-disc pl-4 space-y-1">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('munaqasyah.update', $santri->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        @php $p = $santri->penilaian; @endphp

        <!-- CARD 1: BIODATA & FOTO -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-4">
            <div class="border-b border-slate-100 pb-3 flex items-center justify-between">
                <h3 class="text-sm font-bold text-slate-800 flex items-center gap-2">
                    <i class="fa-solid fa-id-badge text-emerald-600"></i>
                    1. Identitas Santri & Pas Foto Kelulusan
                </h3>
                <span class="text-xs text-amber-600 bg-amber-50 px-2 py-0.5 rounded-full font-semibold">
                    Kategori {{ $santri->jenis }}
                </span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Upload Pas Foto -->
                <div class="md:col-span-1 flex flex-col items-center justify-center p-4 bg-slate-50 border-2 border-dashed border-slate-300 rounded-xl">
                    <div class="w-32 h-40 bg-slate-200 rounded-lg overflow-hidden border border-slate-300 shadow-inner flex items-center justify-center relative mb-3">
                        <img id="photo-preview" src="{{ $santri->foto_url }}" 
                             alt="Pas Foto {{ $santri->nama }}" class="w-full h-full object-cover">
                    </div>
                    <label class="cursor-pointer bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-semibold px-3 py-1.5 rounded-lg shadow-xs transition">
                        <i class="fa-solid fa-camera mr-1"></i> Ganti Foto Siswa
                        <input type="file" name="foto" id="foto-input" accept="image/*" class="hidden" onchange="previewImage(this)">
                    </label>
                    <p class="text-[10px] text-slate-400 mt-1.5 text-center">Kosongkan jika tidak ingin mengubah foto.</p>
                </div>

                <!-- Input Identitas -->
                <div class="md:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Jenis Lembaga <span class="text-rose-500">*</span></label>
                        <select name="jenis" class="w-full text-xs p-2.5 bg-slate-50 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                            <option value="TPQ" {{ $santri->jenis == 'TPQ' ? 'selected' : '' }}>TPQ (Taman Pendidikan Al-Qur'an)</option>
                            <option value="RTQ" {{ $santri->jenis == 'RTQ' ? 'selected' : '' }}>RTQ (Rumah Tahfidz Al-Qur'an)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Nama Unit / Lembaga <span class="text-rose-500">*</span></label>
                        <input type="text" name="nama_unit" value="{{ old('nama_unit', $santri->nama_unit) }}" required
                               class="w-full text-xs p-2.5 bg-slate-50 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">No. Peserta</label>
                        <input type="text" name="no_peserta" value="{{ old('no_peserta', $santri->no_peserta) }}"
                               class="w-full text-xs p-2.5 bg-slate-50 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">No. Unit</label>
                        <input type="text" name="no_unit" value="{{ old('no_unit', $santri->no_unit) }}"
                               class="w-full text-xs p-2.5 bg-slate-50 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-xs font-bold text-slate-700 mb-1">Nama Santri / Siswa <span class="text-rose-500">*</span></label>
                        <input type="text" name="nama" value="{{ old('nama', $santri->nama) }}" required
                               class="w-full text-xs p-2.5 bg-slate-50 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:outline-none uppercase">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="w-full text-xs p-2.5 bg-slate-50 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                            <option value="">Pilih...</option>
                            <option value="L" {{ $santri->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki (L)</option>
                            <option value="P" {{ $santri->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan (P)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Status Kelulusan</label>
                        <select name="status_kelulusan" class="w-full text-xs p-2.5 bg-slate-50 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:outline-none font-semibold text-emerald-700">
                            <option value="LULUS" {{ $santri->status_kelulusan == 'LULUS' ? 'selected' : '' }}>LULUS</option>
                            <option value="TIDAK LULUS" {{ $santri->status_kelulusan == 'TIDAK LULUS' ? 'selected' : '' }}>TIDAK LULUS</option>
                            <option value="PENDING" {{ $santri->status_kelulusan == 'PENDING' ? 'selected' : '' }}>PENDING / TERTUNDA</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- CARD 2: NILAI MUNAQASYAH -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-5">
            <div class="border-b border-slate-100 pb-3 flex items-center justify-between">
                <h3 class="text-sm font-bold text-slate-800 flex items-center gap-2">
                    <i class="fa-solid fa-list-check text-amber-500"></i>
                    2. Nilai Ujian Munaqasyah
                </h3>
                <span class="text-xs text-slate-500">Rentang nilai: 0 - 100</span>
            </div>

            <!-- BAGIAN A: MUNAQASYAH BACAAN -->
            <div>
                <h4 class="text-xs font-extrabold text-emerald-800 uppercase tracking-wider bg-emerald-50 px-3 py-1.5 rounded-lg mb-3 flex items-center gap-2">
                    <i class="fa-solid fa-book-open"></i> A. Munaqasyah Bacaan
                </h4>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                    <div>
                        <label class="block text-[11px] font-semibold text-slate-700 mb-1">Fashohah</label>
                        <input type="number" step="any" name="fashohah" id="fashohah" value="{{ old('fashohah', $p ? $p->fashohah : 0) }}" 
                               class="score-input w-full text-xs p-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 font-mono">
                    </div>
                    <div>
                        <label class="block text-[11px] font-semibold text-slate-700 mb-1">Tajwid</label>
                        <input type="number" step="any" name="tajwid" id="tajwid" value="{{ old('tajwid', $p ? $p->tajwid : 0) }}" 
                               class="score-input w-full text-xs p-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 font-mono">
                    </div>
                    <div>
                        <label class="block text-[11px] font-semibold text-slate-700 mb-1">Gharib Musykilat</label>
                        <input type="number" step="any" name="gharib_musykilat" id="gharib_musykilat" value="{{ old('gharib_musykilat', $p ? $p->gharib_musykilat : 0) }}" 
                               class="score-input w-full text-xs p-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 font-mono">
                    </div>
                    <div>
                        <label class="block text-[11px] font-semibold text-slate-700 mb-1">Suara & Lagu</label>
                        <input type="number" step="any" name="suara_lagu" id="suara_lagu" value="{{ old('suara_lagu', $p ? $p->suara_lagu : 0) }}" 
                               class="score-input w-full text-xs p-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 font-mono">
                    </div>
                </div>
            </div>

            <!-- BAGIAN B: MUNAQASYAH HAFALAN -->
            <div>
                <h4 class="text-xs font-extrabold text-amber-800 uppercase tracking-wider bg-amber-50 px-3 py-1.5 rounded-lg mb-3 flex items-center gap-2">
                    <i class="fa-solid fa-brain"></i> B. Munaqasyah Hafalan
                </h4>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                    <div>
                        <label class="block text-[11px] font-semibold text-slate-700 mb-1">Ayat Pilihan</label>
                        <input type="number" step="any" name="ayat_pilihan" id="ayat_pilihan" value="{{ old('ayat_pilihan', $p ? $p->ayat_pilihan : 0) }}" 
                               class="score-input w-full text-xs p-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 font-mono">
                    </div>
                    <div>
                        <label class="block text-[11px] font-semibold text-slate-700 mb-1">Surah Pendek</label>
                        <input type="number" step="any" name="surah_pendek" id="surah_pendek" value="{{ old('surah_pendek', $p ? $p->surah_pendek : 0) }}" 
                               class="score-input w-full text-xs p-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 font-mono">
                    </div>
                    <div>
                        <label class="block text-[11px] font-semibold text-slate-700 mb-1">Doa Harian</label>
                        <input type="number" step="any" name="doa_harian" id="doa_harian" value="{{ old('doa_harian', $p ? $p->doa_harian : 0) }}" 
                               class="score-input w-full text-xs p-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 font-mono">
                    </div>
                    <div>
                        <label class="block text-[11px] font-semibold text-slate-700 mb-1">Bacaan Shalat</label>
                        <input type="number" step="any" name="bacaan_shalat" id="bacaan_shalat" value="{{ old('bacaan_shalat', $p ? $p->bacaan_shalat : 0) }}" 
                               class="score-input w-full text-xs p-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 font-mono">
                    </div>
                </div>
            </div>

            <!-- BAGIAN C: UJIAN TERTULIS -->
            <div>
                <h4 class="text-xs font-extrabold text-blue-800 uppercase tracking-wider bg-blue-50 px-3 py-1.5 rounded-lg mb-3 flex items-center gap-2">
                    <i class="fa-solid fa-pen-nib"></i> C. Ujian Tertulis
                </h4>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                    <div>
                        <label class="block text-[11px] font-semibold text-slate-700 mb-1">Ujian Tertulis</label>
                        <input type="number" step="any" name="ujian_tertulis" id="ujian_tertulis" value="{{ old('ujian_tertulis', $p ? $p->ujian_tertulis : 0) }}" 
                               class="score-input w-full text-xs p-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 font-mono font-bold">
                    </div>
                </div>
            </div>

            <!-- KALKULASI OTOMATIS -->
            <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <span class="text-[10px] uppercase font-bold text-amber-800 tracking-wider">Perhitungan Otomatis:</span>
                    <div class="flex items-center gap-6 mt-1">
                        <div>
                            <span class="text-xs text-slate-500">Jumlah Nilai:</span>
                            <span id="display-total" class="font-mono font-black text-lg text-slate-900 ml-1">0</span>
                        </div>
                        <div>
                            <span class="text-xs text-slate-500">Rata-rata:</span>
                            <span id="display-avg" class="font-mono font-black text-lg text-emerald-700 ml-1">0.00</span>
                        </div>
                        <div>
                            <span class="text-xs text-slate-500">Predikat:</span>
                            <span id="display-predikat" class="font-semibold text-xs text-amber-900 bg-yellow-200 px-2 py-0.5 rounded ml-1">-</span>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs px-6 py-2.5 rounded-xl shadow transition flex items-center gap-2">
                        <i class="fa-solid fa-check"></i> Simpan Perubahan
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

    calculateScores();
</script>
@endsection
