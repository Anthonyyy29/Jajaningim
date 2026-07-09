# Note 3 — Halaman & Fitur yang Kurang Lengkap

Audit halaman/link/fitur yang terlihat belum selesai di seluruh aplikasi (per 2026-07-08). Diurutkan dari yang paling penting.

> **Update 2026-07-09:** semua item (#1–#9) sudah direalisasikan. Detail di bawah dibiarkan sebagai riwayat masalah + solusi yang dipakai.

---

## 🔴 Link/tombol mati (dead links)

User bisa klik tapi tidak terjadi apa-apa.

### 1. ~~"Profile" di dropdown navbar~~ ✅ Fixed (2026-07-09)
`resources/views/components/layouts/navigation.blade.php:39`
```html
<li><a class="dropdown-item" href="#">Profile</a></li>
```
`href="#"` — tidak ada halaman/route profile sama sekali (tidak ada `UserController`, tidak ada view, tidak ada route).

**Desain usulan:** https://claude.ai/code/artifact/4b033ab6-03f1-420d-a1cf-fb43a2e1abac — mockup halaman "Detail Akun", tema disamakan persis dengan Ocean Fresh (warna, font Saira Stencil One) yang sudah dipakai di login/register/about.

**Perbaikan (diterapkan):**
- Route baru (auth-only): `GET /account`, `PUT /account`, `PUT /account/password` (`AccountController@edit/update/updatePassword`).
- View `resources/views/pages/account.blade.php` + `resources/css/account.css` (di-import lewat `app.js`, sama seperti pola `auth.css`) — kartu profil (avatar inisial, nama, email, member since, ringkasan transaksi), form edit Informasi Akun, form ganti password (pakai rule `current_password` bawaan Laravel), tabel Riwayat Transaksi.
- Link "Profile" di navbar sekarang mengarah ke `route('account.edit')`.
- **Batasan yang disengaja (di luar scope realisasi ini):** tidak ada upload foto profil dan tidak ada hapus akun (fitur destruktif/butuh storage, sesuai keputusan scoping) — dua bagian itu dihilangkan dari mockup asli saat diimplementasikan.
- **Keterbatasan data:** tabel `transactions` belum punya kolom `user_id` (checkout masih tamu, cuma minta email opsional), jadi Riwayat Transaksi di halaman ini dicocokkan lewat `email` akun sebagai pendekatan sementara — transaksi yang dibuat tanpa isi email, atau dengan email berbeda dari akun, tidak akan muncul di sini. Perbaikan jangka panjang: tambah `user_id` nullable FK ke `transactions` dan isi otomatis kalau user sedang login saat checkout.

### 2. ~~"Lupa password?" di halaman login~~ ✅ Fixed (2026-07-09)
`resources/views/pages/login.blade.php:49`
```html
<a href="#" class="auth-link-muted">Lupa password?</a>
```
Tidak ada fitur reset password (tidak ada route `/forgot-password`, tidak ada mailer/notification untuk reset link).

**Desain usulan:** https://claude.ai/code/artifact/d950876a-ec96-4ea9-927e-c5a55d7fc9da — mockup halaman "Lupa Password", memakai ulang persis komponen `auth-wrapper`/`auth-left`/`auth-right` dari `resources/css/auth.css` yang sudah dipakai login/register.

**Perbaikan (diterapkan):**
- `AuthController` — 4 method baru: `showForgotPassword`, `sendResetLink`, `showResetPassword`, `resetPassword`, pakai `Illuminate\Support\Facades\Password` (broker bawaan Laravel, tabel `password_reset_tokens` sudah ada dari migration default).
- Route baru (nama harus persis `password.request`/`password.email`/`password.reset`/`password.update` karena notifikasi `ResetPassword` bawaan Laravel generate link pakai `route('password.reset', ...)`): `GET /forgot-password`, `POST /forgot-password`, `GET /reset-password/{token}`, `POST /reset-password`.
- View baru `pages/forgot-password.blade.php` (form kirim link) dan `pages/reset-password.blade.php` (form password baru, prefill email+token dari link).
- Link "Lupa password?" di login sekarang mengarah ke `route('password.request')`.
- **Diverifikasi end-to-end via Sail:** submit email → link reset masuk ke `storage/logs/laravel.log` (karena `.env` masih `MAIL_MAILER=log`) → buka link → submit password baru → redirect ke login dengan status sukses → login pakai password baru berhasil.
- **Batasan:** email reset **tidak terkirim ke inbox asli** selama `.env` production masih `MAIL_MAILER=log`. Supaya beneran terkirim, isi `MAIL_MAILER=smtp` + kredensial SMTP asli (mis. dari provider seperti Mailgun/SES/Gmail SMTP) di `.env` server.

### 3. ~~"Lanjut dengan Google" di halaman login~~ ✅ Fixed (2026-07-09)
`resources/views/pages/login.blade.php:57`
```html
<button type="button" class="auth-btn-google w-100">
    <i class="bi bi-google"></i> Lanjut dengan Google
</button>
```
Tombol ada, tapi tidak ada handler JS maupun integrasi OAuth (Laravel Socialite dll) di baliknya.

**Perbaikan (diterapkan):** tombol beserta divider "atau masuk dengan" **dihapus** dari `login.blade.php`. Tidak diimplementasikan jadi OAuth beneran karena butuh Google Cloud OAuth Client ID/Secret dari luar (keputusan/kredensial eksternal yang cuma bisa didapat pemilik project) — kalau nanti mau diaktifkan, tinggal tambah `laravel/socialite` + route callback, dan pasang lagi tombolnya.

---

## 🟡 Klaim di UI yang tidak didukung fitur nyata

### 4. ~~Promo "10% pembelian pertama" di halaman register~~ ✅ Fixed (2026-07-09)
`resources/views/pages/register.blade.php:14-17`
```html
<div class="auth-promo-box">
    <span class="auth-promo-icon">🎁</span>
    <span>Dapatkan promo pembelian pertama <strong class="text-of-accent">10%</strong> hanya dengan register.</span>
</div>
```
Tidak ada sistem promo/kupon/diskon di aplikasi sama sekali — tidak ada tabel, tidak ada logic apply discount di `TransactionController`. User yang daftar tidak akan pernah benar-benar dapat diskon ini.

**Perbaikan (diterapkan):** blok promo dihapus dari `register.blade.php`. Kalau nanti memang mau ada promo beneran, perlu tabel kupon/diskon + logic apply di `TransactionController@store` dulu sebelum klaim ini ditulis lagi di UI.

---

## 🟡 Halaman terlihat belum selesai / placeholder

### 5. ~~Gambar `dummy.svg` di halaman About~~ ✅ Fixed (2026-07-09)
`resources/views/pages/about.blade.php:10`
```html
<img src="{{ asset('assets/component_page/dummy.svg') }}" alt="JajaninGim" class="img-fluid rounded-4">
```
Nama file sendiri jelas placeholder ("dummy"), dan filenya **5.6MB** — SVG sebesar itu tidak wajar, bikin halaman About berat cuma buat 1 gambar.

**Perbaikan (diterapkan):** `dummy.svg` dihapus, diganti `public/assets/component_page/topup-illustration.svg` — ilustrasi baru (phone + gem/diamond, tema warna Ocean Fresh) dibuat manual pakai shape SVG dasar, ukuran **~2.3KB** (dari 5.6MB).

### 6. ~~Halaman "Discover" / All Games sangat bare~~ ✅ Fixed (2026-07-09)
`resources/views/pages/allgames.blade.php`
Cuma judul + grid game, tidak ada search/filter, tidak ada sort, tidak ada pagination.

**Perbaikan (diterapkan):** `GameController::index()` sekarang `Game::where('is_active','true')->paginate(12)`, view menambahkan `{{ $games->links('pagination::bootstrap-5') }}`. Search/filter per label/genre belum dikerjakan (di luar scope kali ini) — kalau daftar game >12 baru kelihatan paginasinya.

### 7. ~~"Populer" di homepage = section "Discover" yang sama persis~~ ✅ Fixed (2026-07-09)
*(item lama dari `note 2 - code review.md` #7)*
`GameController::populerIndex()` query-nya identik dengan `index()` — tidak ada logic popularitas nyata.

**Perbaikan (diterapkan):** `populerIndex()` sekarang urut berdasarkan jumlah transaksi berstatus `paid` per game (`withCount` join ke `transactions` lewat relasi `details`), `take(6)`. Game yang belum pernah laku tetap ikut tampil (sold_count 0) supaya section ini tidak kosong di instalasi baru. **Diverifikasi:** seed 2 transaksi paid manual untuk PUBG Mobile → langsung naik ke urutan pertama di homepage.

---

## 🔴 Fitur admin yang hilang total

### 8. ~~Tidak ada halaman admin untuk Transactions~~ ✅ Fixed (2026-07-09)
Filament (`/admin`) cuma punya resource untuk Games, GameDetails, PaymentMethods, Users. Tabel `transactions` **tidak punya resource sama sekali**.

**Perbaikan (diterapkan):** `app/Filament/Resources/Transactions/` — List + View saja (`canCreate()` di-set `false`, tidak ada Edit/Delete karena status transaksi cuma boleh berubah lewat webhook Midtrans di `TransactionController@callback`, bukan diedit manual admin). Kolom: order_id (copyable), game, item, metode bayar, jumlah (format `->money('idr')`), status (badge warna sama dengan konvensi `transaction-status.blade.php`: paid=success, pending=warning, failed/expired=danger), email (toggleable, hidden by default), waktu. Filter by status. Halaman View menampilkan detail lengkap termasuk `form_data` dan `midtrans_snap_token`.

---

## 🟢 Dead code (bukan halaman, tapi bikin kode kotor)

### 9. ~~`GameController` masih ada 7 method kosong~~ ✅ Fixed (2026-07-09)
*(item lama dari `note 2 - code review.md` #6)*
`indexAdmin()`, `showAdmin()`, dan stub kosong `create()`, `store()`, `edit()`, `update()`, `destroy()` — sisa `make:controller --resource`, tidak dipanggil dari route manapun.

**Perbaikan (diterapkan):** semua method mati dihapus, `GameController` sekarang cuma berisi `index`, `populerIndex`, `show`.

---

## Status akhir

Semua 9 item selesai per 2026-07-09. Diverifikasi jalan lewat Sail (migrate:fresh --seed, curl end-to-end untuk login/forgot-password/reset-password/checkout, cek homepage & Discover).

Yang masih jadi batasan sadar (bukan bug, keputusan scope):
- Riwayat transaksi di halaman akun dicocokkan lewat email, bukan `user_id` (lihat #1).
- Email reset password belum benar-benar terkirim ke inbox nyata selama `MAIL_MAILER=log` (lihat #2).
- Tombol Google login dihapus, bukan diimplementasikan (butuh kredensial OAuth eksternal, lihat #3).
- Search/filter/sort di halaman Discover belum ada, baru pagination (lihat #6).
