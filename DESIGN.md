# DESIGN.md — Yayasan Cahaya Amanah Ar-Raudhah

Pedoman desain visual, identitas merek, tipografi, dan antarmuka untuk Sistem Database Sekolah & Penilaian Santri TPQ & RTQ Ar-Raudhah Banjarbaru.

---

## 1. Identitas & Karakter Desain
- **Konteks:** Sistem informasi akademik dan penilaian munaqasyah santri lembaga pendidikan Al-Qur'an (TPQ & RTQ).
- **Karakter:** Bersih, terpercaya, islami bernuansa modern, profesional, dan nyaman digunakan dalam jangka panjang.
- **Prinsip Anti-Slop:**
  - Hindari gradien ungu-biru generik ala template AI.
  - Hindari kartu bento tanpa struktur hierarki yang logis.
  - Hindari headline kosong tanpa substansi ("Unlock the power of..."). Gunakan bahasa Indonesia yang jelas, sopan, dan to the point.
  - Setiap visual memiliki fungsi: badge status kelulusan, nomor peserta santri, nilai rata-rata, dan pembedaan unit TPQ vs RTQ.

---

## 2. Palet Warna (Color System)
- **Warna Utama (Brand / Navigation):**
  - Navy Gelap: `#081026` / `#16285a` (Sidebar, teks tebal, struktur utama)
- **Warna Identitas Lembaga:**
  - **TPQ Ar-Raudhah (Taman Pendidikan Al-Qur'an):** Amber / Emas (`#f59e0b`, `#d97706`, aksen latar `#fffbeb`).
  - **RTQ Ar-Raudhah (Rumah Tahfidz Al-Qur'an):** Deep Blue (`#1e3a8a`, `#2563eb`, aksen latar `#eff6ff`).
- **Warna Status & Penilaian (Munaqasyah):**
  - **Lulus / Mumtaz:** Emerald (`#10b981`, `#059669`)
  - **Jayyid Jiddan / Baik:** Biru (`#3b82f6`)
  - **Jayyid:** Amber (`#f59e0b`)
  - **Maqbul / Cukup:** Ungu lembut (`#a855f7`)
  - **Rasib / Tidak Lulus:** Rose (`#f43f5e`, `#e11d48`)
- **Mode Tampilan:**
  - **Light Mode:** Background `#f8fafc` (slate-50), cards `#ffffff`, border `#e2e8f0` (slate-200), text `#0f172a` (slate-900).
  - **Dark Mode:** Background `#0b1120`, cards `#111b33`, border `#1e2d4d`, secondary cards `#0c1427`, text `#f8fafc`.

---

## 3. Tipografi
- **Primary Font (Antarmuka):** `Plus Jakarta Sans`, sans-serif (bobot 400, 500, 600, 700, 800).
- **Secondary Font (Ayat / Kaligrafi):** `Amiri`, serif (bobot 400, 700).
- **Data & Angka:** Font mono (`monospace`, `font-mono`) untuk nomor ujian/peserta santri, persentase nilai, dan jam digital.

---

## 4. Komponen & Tata Letak
- **Border Radius:** `rounded-xl` (12px) untuk input & tombol, `rounded-2xl` (16px) untuk card & panel. Hindari sudut membulat berlebihan yang merusak ruang baca data.
- **Bayangan (Elevation):** Bayangan tipis halus (`shadow-sm` dan `shadow-md`), tidak menggunakan blur glow yang menyilaukan mata.
- **Tabel:** Border bersih (`table-custom`), zebra striping halus pada hover, kontras teks terbaca tinggi, dan responsive horizontal scroll untuk mobile.
- **Navigasi:** Sidebar collapsible desktop + drawer overlay mobile, topbar dengan breadcrumb, indikator TPQ/RTQ, profil admin, dan sakelar cepat Mode Terang/Gelap.
