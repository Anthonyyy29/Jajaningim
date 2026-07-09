# Note 3 — Halaman & Fitur yang Kurang Lengkap

Audit halaman/link/fitur yang terlihat belum selesai di seluruh aplikasi (per 2026-07-08). Diurutkan dari yang paling penting.

> **Update 2026-07-09:** #1 dan #8 sudah direalisasikan. Detail di bawah dibiarkan sebagai riwayat masalah + solusi yang dipakai.

---

## 🔴 Link/tombol mati (dead links)

User bisa klik tapi tidak terjadi apa-apa.

### 1. ~~"Profile" di dropdown navbar~~ ✅ Fixed (2026-07-09)
`resources/views/components/layouts/navigation.blade.php:39`
```html
<li><a class="dropdown-item" href="#">Profile</a></li>
```
`href="#"` — tidak ada halaman/route profile sama sekali (tidak ada `UserController`, tidak ada view, tidak ada route).

**Perbaikan:** buat halaman profile sederhana (lihat/edit nama, email, ganti password), atau sembunyikan menu ini dulu sampai fiturnya ada.

**Desain usulan:** https://claude.ai/code/artifact/4b033ab6-03f1-420d-a1cf-fb43a2e1abac — mockup halaman "Detail Akun", tema disamakan persis dengan Ocean Fresh (warna, font Saira Stencil One) yang sudah dipakai di login/register/about.

**Perbaikan (diterapkan):**
- Route baru (auth-only): `GET /account`, `PUT /account`, `PUT /account/password` (`AccountController@edit/update/updatePassword`).
- View `resources/views/pages/account.blade.php` + `resources/css/account.css` (di-import lewat `app.js`, sama seperti pola `auth.css`) — kartu profil (avatar inisial, nama, email, member since, ringkasan transaksi), form edit Informasi Akun, form ganti password (pakai rule `current_password` bawaan Laravel), tabel Riwayat Transaksi.
- Link "Profile" di navbar sekarang mengarah ke `route('account.edit')`.
- **Batasan yang disengaja (di luar scope realisasi ini):** tidak ada upload foto profil dan tidak ada hapus akun (fitur destruktif/butuh storage, sesuai keputusan scoping) — dua bagian itu dihilangkan dari mockup asli saat diimplementasikan.
- **Keterbatasan data:** tabel `transactions` belum punya kolom `user_id` (checkout masih tamu, cuma minta email opsional), jadi Riwayat Transaksi di halaman ini dicocokkan lewat `email` akun sebagai pendekatan sementara — transaksi yang dibuat tanpa isi email, atau dengan email berbeda dari akun, tidak akan muncul di sini. Perbaikan jangka panjang: tambah `user_id` nullable FK ke `transactions` dan isi otomatis kalau user sedang login saat checkout.

### 2. "Lupa password?" di halaman login
`resources/views/pages/login.blade.php:49`
```html
<a href="#" class="auth-link-muted">Lupa password?</a>
```
Tidak ada fitur reset password (tidak ada route `/forgot-password`, tidak ada mailer/notification untuk reset link).

**Perbaikan:** implementasi Laravel password reset bawaan (`Password::sendResetLink`, dll — perlu `MAIL_MAILER` yang benar-benar terkonfigurasi, saat ini `.env` masih `MAIL_MAILER=log`), atau hapus link ini sampai fiturnya ada.

**Desain usulan:** https://claude.ai/code/artifact/d950876a-ec96-4ea9-927e-c5a55d7fc9da — mockup halaman "Lupa Password", memakai ulang persis komponen `auth-wrapper`/`auth-left`/`auth-right` dari `resources/css/auth.css` yang sudah dipakai login/register (bukan gaya baru). Nunjukin 2 state: form kirim link reset (input email), dan tampilan konfirmasi "Cek email kamu" setelah link dikirim. Perlu route baru (`GET/POST /forgot-password`, `GET/POST /reset-password/{token}`) + `MAIL_MAILER` yang benar-benar terkonfigurasi supaya email reset-nya beneran terkirim.

### 3. "Lanjut dengan Google" di halaman login
`resources/views/pages/login.blade.php:57`
```html
<button type="button" class="auth-btn-google w-100">
    <i class="bi bi-google"></i> Lanjut dengan Google
</button>
```
Tombol ada, tapi tidak ada handler JS maupun integrasi OAuth (Laravel Socialite dll) di baliknya.

**Perbaikan:** implementasi Google OAuth kalau memang mau dipakai, atau hapus tombolnya dulu.

---

## 🟡 Klaim di UI yang tidak didukung fitur nyata

### 4. Promo "10% pembelian pertama" di halaman register
`resources/views/pages/register.blade.php:14-17`
```html
<div class="auth-promo-box">
    <span class="auth-promo-icon">🎁</span>
    <span>Dapatkan promo pembelian pertama <strong class="text-of-accent">10%</strong> hanya dengan register.</span>
</div>
```
Tidak ada sistem promo/kupon/diskon di aplikasi sama sekali — tidak ada tabel, tidak ada logic apply discount di `TransactionController`. User yang daftar tidak akan pernah benar-benar dapat diskon ini.

**Perbaikan:** implementasi sistem promo/kupon beneran, atau hapus klaim ini dari UI sampai fiturnya ada (klaim marketing palsu bisa jadi masalah kepercayaan user).

---

## 🟡 Halaman terlihat belum selesai / placeholder

### 5. Gambar `dummy.svg` di halaman About
`resources/views/pages/about.blade.php:10`
```html
<img src="{{ asset('assets/component_page/dummy.svg') }}" alt="JajaninGim" class="img-fluid rounded-4">
```
Nama file sendiri jelas placeholder ("dummy"), dan filenya **5.6MB** — SVG sebesar itu tidak wajar (kemungkinan hasil export mentah, belum dioptimasi/di-minify), bikin halaman About berat cuma buat 1 gambar.

**Perbaikan:** ganti dengan ilustrasi/gambar asli yang sudah dioptimasi (idealnya di bawah beberapa ratus KB).

### 6. Halaman "Discover" / All Games sangat bare
`resources/views/pages/allgames.blade.php`
Cuma judul + grid game, tidak ada search/filter (misal per label/genre), tidak ada sort, tidak ada pagination. Kalau daftar game bertambah banyak, halaman ini akan berat & sulit dinavigasi.

**Perbaikan:** minimal tambahkan pagination (`Game::paginate()`), idealnya juga filter/sort.

### 7. "Populer" di homepage = section "Discover" yang sama persis
*(item lama dari `note 2 - code review.md` #7, masih belum diperbaiki)*
`GameController::populerIndex()` query-nya identik dengan `index()` — tidak ada logic popularitas nyata (tidak ada kolom `is_popular`/`sold_count`, tidak ada `->take(n)`).

**Perbaikan:** minimal `->take(6)` supaya beda dari "All Games", idealnya berdasarkan data penjualan nyata dari tabel `transactions` yang sekarang sudah ada.

---

## 🔴 Fitur admin yang hilang total

### 8. ~~Tidak ada halaman admin untuk Transactions~~ ✅ Fixed (2026-07-09)
Filament (`/admin`) cuma punya resource untuk Games, GameDetails, PaymentMethods, Users. Tabel `transactions` (order top-up + status pembayaran) **tidak punya resource sama sekali** — admin tidak bisa lihat siapa yang sudah bayar, status `pending`/`paid`/`failed`/`expired`, atau riwayat order dari panel admin. Satu-satunya cara cek sekarang: buka database manual / `php artisan tinker`.

Untuk aplikasi top-up seperti ini, ini gap fungsional yang cukup besar — admin butuh cara pantau & follow-up transaksi tanpa akses DB langsung.

**Perbaikan:** buat `app/Filament/Resources/Transactions/` (read-heavy: list + view detail, mungkin tidak perlu create/delete dari admin) menampilkan order_id, game, item, payment method, amount, status, created_at — idealnya dengan filter by status.

**Perbaikan (diterapkan):** `app/Filament/Resources/Transactions/` — List + View saja (`canCreate()` di-set `false`, tidak ada Edit/Delete karena status transaksi cuma boleh berubah lewat webhook Midtrans di `TransactionController@callback`, bukan diedit manual admin). Kolom: order_id (copyable), game, item, metode bayar, jumlah (format `->money('idr')`), status (badge warna sama dengan konvensi `transaction-status.blade.php`: paid=success, pending=warning, failed/expired=danger), email (toggleable, hidden by default), waktu. Filter by status. Halaman View menampilkan detail lengkap termasuk `form_data` (isian dinamis user) dan `midtrans_snap_token`.

---

## 🟢 Dead code (bukan halaman, tapi bikin kode kotor)

### 9. `GameController` masih ada 7 method kosong
*(item lama dari `note 2 - code review.md` #6, masih belum diperbaiki)*
`indexAdmin()`, `showAdmin()`, dan stub kosong `create()`, `store()`, `edit()`, `update()`, `destroy()` — sisa `make:controller --resource`, tidak dipanggil dari route manapun (CRUD admin sudah diambil alih Filament).

**Perbaikan:** hapus semua method yang tidak dipakai, sisakan `index`, `populerIndex`, `show`.

---

## Rekomendasi urutan pengerjaan

1. ~~**#8 (admin Transactions)** — paling penting secara fungsional, admin butuh ini untuk operasional harian.~~ ✅ selesai 2026-07-09.
2. ~~**#1 (halaman Detail Akun)**~~ ✅ selesai 2026-07-09 — sisa #2, #3 (dead link lain di login) belum.
3. **#1–#3 (dead links)** — sisa #2 (lupa password) dan #3 (Google login), cepat & murah untuk dibereskan: sembunyikan dulu atau arahkan ke halaman "coming soon" sampai fiturnya benar-benar ada.
4. **#4 (klaim promo palsu)** — sebaiknya cepat dihapus dari UI kalau memang belum ada rencana implementasi promo, supaya tidak menyesatkan user.
5. **#5, #6, #7, #9** — kalau ada waktu, perbaikan kualitas & UX jangka menengah.
