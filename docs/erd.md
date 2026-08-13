ERD & Hak Akses User — Web Sekolah & Web Absensi SMAN 1 Banyusari

1. HAK AKSES USER
Web Sekolah (publik) — sman1banyusari.sch.id
Pengunjung  
Login: Tidak perlu  
Hak Akses: Lihat semua halaman publik (Beranda, Profil Sekolah, Berita, PPDB Info, Galeri Album, Prestasi, Kontak)

Editor (Guru TU/Humas)
Login: Ya  
Hak Akses: CRUD Berita, Galeri Album, Prestasi, edit konten Profil Sekolah (sambutan, sejarah, visi-misi, fasilitas), update info PPDB. Tidak bisa kelola akun admin lain  

Superadmin  
Login: Ya  
Hak Akses: Semua akses Editor + tambah/hapus/reset password akun Editor + akses setting sistem

Web Absensi (internal) — absensi.sman1banyusari.sch.id
Siswa  
Login: Ya (NIS + password, wajib ganti saat login pertama)  
Hak Akses: Scan absen masuk & pulang (dengan validasi GPS), lihat riwayat absensi pribadi sendiri  

Guru Piket  
Login: Ya (akun terpisah dari Admin TU)  
Hak Akses: Dashboard rekap hari ini (hadir/telat/belum absen), input absensi manual sebagai fallback (HP siswa rusak/lupa bawa)  

Admin TU  
Login: Ya (akun terpisah dari Guru Piket)  
Hak Akses: Import data siswa (Excel dari Dapodik), kelola kelas & jam cutoff per shift, kelola jadwal piket guru, kelola qr_gerbang & radius toleransi GPS, export laporan rekap harian/bulanan, lihat log notifikasi WA  

Kepala Sekolah  
Login: Ya (akun sendiri)  
Hak Akses: Read-only — lihat rekap & laporan kehadiran saja, tidak bisa mengubah data apa pun

2. ERD — DATABASE WEB SEKOLAH
Entitas: ADMIN_USER  
id           | int    | PK  
nama         | string |  
username     | string | unik  
password     | string |  
role         | enum   | superadmin, editor 

Entitas: BERITA  
id           | int      | PK  
judul        | string   |  
slug         | string   | unik  
konten       | text     |  
gambar_cover | string   | path file  
admin_id     | int      | FK → ADMIN_USER.id  
published_at | datetime |

Entitas: GALERI_ALBUM  
id           | int    | PK  
judul_album  | string |  
tanggal      | date   |  

Entitas: GALERI_FOTO  
id           | int    | PK  
album_id     | int    | FK → GALERI_ALBUM.id  
path_foto    | string |  
caption      | string | opsional  

Entitas: PRESTASI  
id           | int    | PK  
judul        | string | misal "Juara 1 OSN Matematika Tingkat Provinsi"  
nama_siswa   | string | opsional, bisa prestasi tim/sekolah  
tingkat      | enum   | sekolah, kabupaten, provinsi, nasional, internasional  
tahun        | int    |  
gambar       | string | opsional, sertifikat/foto  
admin_id     | int    | FK → ADMIN_USER.id 

Entitas: HALAMAN_STATIS  
id           | int    | PK  
slug         | string | unik — sambutan-kepsek, sejarah, visi-misi, fasilitas  
judul        | string |  
konten       | text   |  

Entitas: PPDB_INFO  
id           | int    | PK  tahun_ajaran | string |  jadwal       | text   |  syarat       | text   |  admin_id     | int    | FK → ADMIN_USER.id

Relasi Web Sekolah  
ADMIN_USER (1) — (N) BERITA : satu admin membuat banyak berita  
ADMIN_USER (1) — (N) PRESTASI : satu admin menginput banyak prestasi  
ADMIN_USER (1) — (N) PPDB_INFO : satu admin memperbarui banyak entri PPDB (per tahun ajaran)  
GALERI_ALBUM (1) — (N) GALERI_FOTO : satu album berisi banyak foto  
HALAMAN_STATIS : tidak berelasi FK ke tabel lain — murni konten per slug, diedit langsung oleh Editor/Superadmin 

3. ERD — DATABASE WEB ABSENSI PIKET
Entitas: KELAS  
id               | int    | PK  
nama_kelas       | string |  
shift            | enum   | pagi, siang  
jam_cutoff_masuk | time   | 06:30 untuk pagi, 11:30 untuk siang  
jam_mulai_kbm    | time   |  

Entitas: SISWA  
id         | int    | PK  
nis        | string | unik, sumber dari Dapodik  
nama       | string |  
password   | string | default = NIS, wajib ganti saat login pertama 
kelas_id   | int    | FK → KELAS.id  
no_wa_ortu | string | untuk notifikasi  
status     | enum   | aktif, lulus, pindah 

Entitas: GURU  
id       | int    | PK  
nama     | string |  
username | string | unik  
password | string |  
no_hp    | string |  
role     | enum   | guru_piket, admin_tu, kepsek

Entitas: JADWAL_PIKET  
id          | int    | PK  
guru_id     | int    | FK → GURU.id (role harus guru_piket)  
hari        | string |  
jam_mulai   | time   |  
jam_selesai | time   | 

Entitas: QR_GERBANG  
id           | int     | PK  
lokasi       | string  | misal "Gerbang Utama"  
latitude     | decimal |  
longitude    | decimal |  
radius_meter | int     | toleransi jarak GPS  
token        | string  | isi kode QR

Entitas: ABSENSI_LOG  
id             | int      | PK  
siswa_id       | int      | FK → SISWA.id  
tanggal        | date     |  
jam_masuk      | datetime |  
status_masuk   | enum     | hadir, terlambat  
jam_pulang     | datetime | nullable  
latitude_scan  | decimal  |  
longitude_scan | decimal  |  
qr_gerbang_id  | int      | FK → QR_GERBANG.id  
input_by_type  | enum     | siswa (self-scan), guru (manual)  
input_by_id    | int      | nullable, isi GURU.id jika input manual 

Entitas: NOTIFIKASI_WA_LOG  
id             | int      | PK  
absensi_log_id | int      | FK → ABSENSI_LOG.id  
no_tujuan      | string   |  
pesan          | text     |  
status_kirim   | enum     | terkirim, gagal  
dikirim_at     | datetime |  

Relasi Web Absensi  
KELAS (1) — (N) SISWA : satu kelas punya banyak siswa  
GURU (1) — (N) JADWAL_PIKET : satu guru punya banyak jadwal piket  
GURU (1) — (N) ABSENSI_LOG : satu guru bisa input manual banyak absensi (opsional, nullable)  
SISWA (1) — (N) ABSENSI_LOG : satu siswa punya banyak riwayat absensi (per hari)  
QR_GERBANG (1) — (N) ABSENSI_LOG : satu titik gerbang dipakai untuk banyak scan  
ABSENSI_LOG (1) — (0..1) NOTIFIKASI_WA_LOG : satu absensi memicu maksimal satu notifikasi WA per even
