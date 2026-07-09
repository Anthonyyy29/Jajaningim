# Note 2 — Code Review Jajaningim

Review menyeluruh struktur & fungsi yang sudah dibuat (controller, model, migration, seeder, routes, Filament admin, blade, JS). Diurutkan dari yang paling penting.

---

## 🔴 Bug yang perlu diperbaiki

> **Update 2026-07-07:** #1, #2, #3, #4 sudah diperbaiki. Detail tiap item di bawah ini dibiarkan sebagai riwayat masalah + solusi yang dipakai.

### 1. ~~Tabel `games` tidak punya kolom `created_at`/`updated_at` → Edit Game di admin bisa error~~ ✅ Fixed
`database/migrations/2026_06_29_064126_create_games_table.php` tidak punya `$table->timestamps()`, beda dari `game_detail` dan `table_payment_method` yang punya.

Masalahnya, `App\Models\Game` **tidak** menonaktifkan timestamp (`public $timestamps = false;`), jadi Eloquent akan otomatis coba isi `updated_at` setiap kali `save()`/`update()` dipanggil. Filament `EditGame` (extends `EditRecord`) memanggil `$record->update()` di balik layar → ini akan throw SQL error `Unknown column 'games.updated_at'` saat admin coba edit game lewat `/admin`.

**Perbaikan (diterapkan):** migration baru `2026_07_07_174148_add_timestamps_to_games_table.php` menambahkan `$table->timestamps()` (nullable, tidak perlu backfill karena tidak ada default `NOT NULL`). Diverifikasi: `Game::save()` sekarang berhasil mengisi `updated_at` tanpa error.

### 2. ~~Tidak ada akun admin setelah `migrate:fresh --seed`~~ ✅ Fixed
`DatabaseSeeder` bikin "Test User" tapi tidak set `is_admin => true`. Kolom `is_admin` default `false` (migration `2026_07_02_082243_users.php`). `User::canAccessPanel()` return `$this->is_admin`.

**Akibat:** setelah seeding dari nol, **tidak ada satu pun user yang bisa login ke `/admin`**.

**Perbaikan (diterapkan):** `DatabaseSeeder` sekarang set `'is_admin' => true` untuk Test User (`test@example.com`).

### 3. ~~Tombol "BELI SEKARANG !" tidak melakukan apa-apa~~ ✅ Fixed (checkout ke Midtrans Snap, sandbox)
Di `resources/views/pages/game.blade.php`, semua input (User ID, pilih nominal, pilih payment, email) **tidak dibungkus `<form>`**, dan tombol beli adalah `type="button"` tanpa event listener JS maupun action server. Fitur inti (checkout/transaksi) belum tersambung sama sekali — baru sebatas preview invoice di client.

**Perbaikan (diterapkan):**
- `game.blade.php` — semua input dibungkus `<form method="POST" action="{{ route('transaction.store') }}">` + `@csrf`, tombol jadi `type="submit"`, error validasi ditampilkan di atas form.
- Tabel & model `Transaction` baru (`order_id`, `game_id`, `game_detail_id`, `payment_method_id`, `form_data` JSON, `email`, `amount`, `status`, `midtrans_snap_token`).
- `TransactionController@store` — validasi nominal, payment method, dan field dinamis (`game->form_fields`) wajib diisi; simpan transaksi status `pending`; panggil Midtrans Snap (`midtrans/midtrans-php`) untuk dapat `redirect_url`; redirect user ke halaman pembayaran Midtrans.
- `TransactionController@callback` (route `POST /payment/callback`, dikecualikan dari CSRF di `bootstrap/app.php`) — terima notifikasi status dari Midtrans, update `transactions.status` (paid/failed/expired/pending).
- `TransactionController@show` (route `GET /transaction/{orderId}`) + view `pages/transaction-status.blade.php` — halaman status transaksi.
- **Belum jalan penuh:** `MIDTRANS_SERVER_KEY`/`MIDTRANS_CLIENT_KEY` di `.env` masih kosong (sudah ada slot-nya, isi dari dashboard Midtrans sandbox). Tanpa key ini, `Snap::createTransaction()` akan throw exception "ServerKey/ClientKey is null" — sudah diverifikasi ini satu-satunya blocker yang tersisa (form, validasi, dan penyimpanan ke DB semua sudah teruji jalan).
- Untuk tes callback via `ngrok`/tunnel di lokal, daftarkan URL publik sebagai "Payment Notification URL" di dashboard Midtrans sandbox agar mengarah ke `/payment/callback`.

### 4. ~~`app/View/Components/layouts.games_populer.php` — file rusak & tidak terpakai~~ ✅ Fixed
```php
class layouts.games_populer extends Component   // ❌ nama class tidak valid (ada titik)
```
File ini tidak dipakai di mana pun (component yang benar-benar dipakai adalah `App\View\Components\games_populer`, bukan yang di dalam folder `Layouts`), dan view target-nya (`components.layouts.games_populer.blade.php`) juga tidak ada.

**Perbaikan (diterapkan):** file dihapus.

### 12. ~~Pilihan payment method di web tidak pernah dikirim ke Midtrans~~ ✅ Fixed (2026-07-09)
`TransactionController@store` — customer pilih payment method (QRIS/GoPay/ShopeePay/DANA/OVO) di `game.blade.php`, tersimpan ke `transactions.payment_method_id`, tapi payload `Snap::createTransaction()` tidak pernah menyertakan `enabled_payments`. Akibatnya Snap selalu nunjukin SEMUA metode aktif, customer bisa bayar pakai metode lain dari yang dipilih di web, dan `payment_method_id` di database jadi tidak akurat (tidak mencerminkan metode yang beneran dipakai).

**Perbaikan (diterapkan):**
- Migration `2026_07_09_100000_add_midtrans_code_to_payment_methods.php` — tambah kolom `table_payment_method.midtrans_code` (backfill otomatis untuk 5 metode seeded: QRIS→`other_qris`, GoPay→`gopay`, ShopeePay→`shopeepay`, DANA→`dana`, OVO→`ovo`, sesuai dokumentasi resmi Midtrans).
- `TransactionController@store` sekarang set `enabled_payments => [$paymentMethod->midtrans_code]` supaya Snap langsung dibatasi ke metode yang dipilih. Kalau `midtrans_code` kosong (belum diisi admin untuk metode baru), key `enabled_payments` sengaja tidak disertakan sama sekali (fallback semua metode aktif) daripada checkout gagal total — dicatat lewat `Log::warning`.
- Filament `PaymentMethodForm`/`PaymentMethodsTable` — field `midtrans_code` wajib diisi admin lewat dropdown kode yang valid.
- **Diverifikasi end-to-end via Sail:** checkout dengan kelima payment method, semuanya dapat redirect Snap valid tanpa error.

---

## 🟡 Struktur & kualitas kode

### 5. String `'true'`/`'false'` untuk kolom boolean, diulang di banyak tempat
Kolom `is_active` di `games` dan `table_payment_method` adalah `enum('true','false')`, bukan boolean asli. Perbandingan `where('is_active', 'true')` diulang di banyak tempat:
- `GameController::index()` & `populerIndex()`
- `components/layouts/app.blade.php` (query `$allGames` untuk search)
- `GamesTable` Filament (badge color check)

Kalau suatu saat ada yang salah ketik `'True'`/`true` (boolean asli) alih-alih string `'true'`, query akan diam-diam mengembalikan hasil kosong — bug yang susah dilacak.

**Perbaikan:** ubah kolom jadi `boolean` asli (`$table->boolean('is_active')->default(true)`) + cast di model, lalu query pakai `where('is_active', true)`. Tambahkan juga query scope `Game::active()` / `PaymentMethod::active()` supaya logic-nya tidak diulang di 4+ tempat.

### 6. `GameController` punya banyak method mati (dead code)
`indexAdmin()`, `showAdmin()`, dan stub kosong `create()`, `store()`, `edit()`, `update()`, `destroy()` tidak pernah dipanggil dari `routes/web.php` — sekarang CRUD admin sudah diambil alih Filament. Method-method ini peninggalan `make:controller --resource` yang belum dibersihkan.

**Perbaikan:** hapus semua method yang tidak dipakai, sisakan `index`, `populerIndex`, `show` untuk public.

### 7. "Populer" sebenarnya sama persis dengan "All Games"
`populerIndex()` query-nya identik dengan `index()` (`Game::where('is_active','true')->get()`, tanpa sorting/limit apa pun). Section "POPULER" di homepage jadi menampilkan seluruh game yang sama dengan halaman "Discover". Tidak ada konsep popularitas nyata (tidak ada kolom `is_popular`, `sold_count`, atau `->take(n)`).

Markup `games_populer.blade.php` dan `allgames.blade.php` juga nyaris identik (grid card yang sama, copy-paste).

**Perbaikan:** kalau memang belum butuh logic popularitas, minimal batasi jumlahnya (`->take(6)`) supaya beda dari "All Games". Lalu extract markup grid game jadi 1 partial/component yang dipakai ulang di kedua halaman.

### 8. Query game aktif untuk search dijalankan di layout, bukan lewat controller
`components/layouts/app.blade.php` menjalankan `Game::where('is_active','true')->get(['id','name'])` langsung di Blade, di layout utama yang di-include di **setiap halaman** (termasuk halaman login, about, dll yang tidak butuh data ini). Query logic sebaiknya tidak ada di view.

**Perbaikan:** pindahkan ke View Composer (`View::composer('components.layouts.navigation', ...)`) supaya controller-controller tidak perlu tahu soal ini dan query-nya jelas dari satu tempat.

### 9. Penamaan tidak konsisten
- Route `/Games` (huruf besar) — route lain semua lowercase (`/game`, `/about`, `/login`). Browser/URL konvensional lowercase.
- Seeder `payment_method_seeder` (snake_case, file & class) — seeder lain pakai PascalCase (`GameSeeder`, `GameDetailsSeeder`). Laravel/PSR-4 konvensinya PascalCase.

**Perbaikan:** samakan casing supaya konsisten dan sesuai konvensi Laravel.

---

## 🟢 Keamanan & housekeeping

### 10. Tidak ada rate limiting di route login
`routes/web.php` tidak menambahkan `throttle` middleware di `/login`. Karena auth dibuat manual (bukan Breeze), Laravel tidak otomatis kasih proteksi brute-force di sini.

**Perbaikan:** tambahkan `->middleware('throttle:5,1')` pada route POST `/login`.

### 11. Asset build Filament ikut ter-commit ke git
37 file di `public/js/filament/*`, `public/css/filament/*`, `public/fonts/filament/*` (termasuk file `.woff2` binary) ter-track di git. Ini adalah hasil generate `php artisan filament:assets`, seharusnya tidak perlu disimpan di repo (bisa di-generate ulang tiap deploy/install).

**Perbaikan:** tambahkan `public/css/filament`, `public/js/filament`, `public/fonts/filament` ke `.gitignore`, hapus dari tracking (`git rm -r --cached ...`), lalu jalankan `php artisan filament:assets` sebagai bagian dari proses deploy/setup.

---

## Ringkasan Prioritas

1. ~~**Fix dulu:** #1 (timestamps `games`) dan #2 (tidak ada akun admin)~~ ✅ selesai 2026-07-07.
2. ~~**Sebelum lanjut fitur checkout:** #3~~ ✅ selesai 2026-07-07 — tinggal isi `MIDTRANS_SERVER_KEY`/`MIDTRANS_CLIENT_KEY` sandbox di `.env` untuk tes end-to-end.
3. **Bersih-bersih cepat:** ~~#4~~ ✅ selesai, sisa #6, #11 — hapus kode mati, rapikan `.gitignore`.
4. **Kalau ada waktu:** #5, #7, #8, #9, #10 — perbaikan kualitas & keamanan jangka menengah.
