# Jajaningim

Aplikasi Laravel untuk top-up voucher/diamond game (mirip situs top-up Mobile Legends, Free Fire, PUBG, dll). User memilih game → nominal → metode pembayaran → invoice tampil live sebelum checkout.

## Tech Stack

- **Backend:** Laravel 13 (PHP 8.5), dijalankan via Laravel Sail (Docker)
- **Database:** MySQL 8.4 (branch `new_db` sedang eksplorasi migrasi ke PostgreSQL, tapi **belum selesai** — lihat commit "belum sampe PG")
- **Admin panel:** Filament v4 (`/admin`) — resource untuk Games, GameDetails, PaymentMethods, Users
- **Frontend:** Blade + Vite + vanilla JS (tidak pakai framework JS, ada `resources/js/app.js` dan `search.js`)
- **Auth:** Manual (bukan Breeze/Jetstream) — `AuthController` custom
- **Payment gateway:** Midtrans Snap (`midtrans/midtrans-php`), mode sandbox — lihat `config/midtrans.php` + `MIDTRANS_SERVER_KEY`/`MIDTRANS_CLIENT_KEY` di `.env` (masih kosong, isi dari dashboard Midtrans sandbox untuk tes end-to-end)
- **Dev tools:** phpMyAdmin (login root, lihat compose.yaml) untuk kelola semua database di container mysql

## Struktur Data

**`games`** — id, name, description, image, `form_fields` (JSON, contoh: `['user_id','server_id']`), is_active
**`game_detail`** (nominal per game, nama tabel singular meski migration file & seeder-nya "GameDetails") — game_id (FK), name (mis. "56 Diamond"), price, label (kategori: Diamond/CP/UC)
**`table_payment_method`** — metode_payment, logo, is_active
**`users`** — bawaan Laravel + kolom tambahan `is_admin` (migration `2026_07_02_082243_users.php`, dipakai untuk gating akses Filament)
**`transactions`** — order_id (unik), game_id/game_detail_id/payment_method_id (FK), `form_data` (JSON, isi field dinamis yang diisi user), email, amount, status (`pending`/`paid`/`failed`/`expired`), midtrans_snap_token

Relasi: `Game::details()` → hasMany `GameDetail`; `GameDetail::game()` → belongsTo `Game`; `Transaction` → belongsTo `Game`, `GameDetail`, `PaymentMethod`.

Migration kustom lama (mis. `game_items`) sudah **dihapus**, sekarang hanya migration bawaan Laravel + yang relevan (games, game_details, payment_methods, users is_admin).

## Alur Utama

1. **Halaman game (`/game/{id}`)** — 1 route + 1 controller (`GameController::show`) + 1 view (`pages/game.blade.php`). JANGAN buat file blade per-game (`game1.blade.php` dst) — datanya yang beda, bukan filenya.
2. **Nominal & payment method** diambil dari DB (bukan hardcoded), dikirim via `compact('game', 'paymentMethods')`.
3. **Invoice live update** — JS di `app.js` dengar event pilih nominal/payment/isi ID, update `#inv-item`, `#inv-total`, `#inv-payment`, `#inv-id` secara real-time tanpa reload.
4. **Search game** (`resources/js/search.js`) — debounce 400ms, data game di-embed sebagai `window.GAMES` lewat `@json()` di `app.blade.php` layout. Enter/klik search tanpa debounce → redirect `/game/{id}` atau `/game-not-found?q=`.
5. **Auth manual** — `Auth::attempt()` + `Hash::make()` + `session()->regenerate()` (login), `Auth::login()` auto-login setelah register, `session()->invalidate()` + `regenerateToken()` saat logout. Route guest-only untuk login/register, route auth-only untuk logout.
6. **Admin panel Filament** (`/admin`) — CRUD Games, GameDetails, PaymentMethods, Users. Ditambahkan di commit "belum sampe PG".
7. **Checkout** — form di `game.blade.php` (bungkus `<form>` + `@csrf`) submit ke `POST /transaction` (`TransactionController::store`). Validasi nominal/payment method/field dinamis wajib diisi → simpan `Transaction` status `pending` → panggil Midtrans Snap → redirect user ke halaman pembayaran Midtrans. Notifikasi status dari Midtrans masuk lewat `POST /payment/callback` (`TransactionController::callback`, dikecualikan dari CSRF di `bootstrap/app.php` karena request server-to-server) → update `transactions.status`. Halaman status: `GET /transaction/{orderId}` (`TransactionController::show`).

## File Kunci

```
app/Http/Controllers/AuthController.php         # login, register, logout
app/Http/Controllers/GameController.php         # index, show, populerIndex
app/Http/Controllers/TransactionController.php  # store (checkout → Midtrans Snap), callback (webhook), show (status)
app/Models/{Game,GameDetail,PaymentMethod,User,Transaction}.php
app/Filament/Resources/{Games,GameDetails,PaymentMethods,Users}/  # admin CRUD
app/Providers/Filament/AdminPanelProvider.php
config/midtrans.php   # server_key/client_key/is_production dari .env
resources/js/{app.js,search.js}
resources/views/pages/{game,game-not-found,allgames,home,login,register,transaction-status}.blade.php
resources/views/components/layouts/{app,navigation}.blade.php
routes/web.php
database/migrations/  # games(+timestamps), game_details, payment_methods, users(is_admin), transactions
database/seeders/     # GameSeeder, GameDetailsSeeder, payment_method_seeder (DatabaseSeeder set is_admin=true utk Test User)
note 1.md             # catatan teknis lebih detail (kode contoh) untuk topik di atas
note 2 - code review.md  # daftar bug & kualitas kode yang belum diperbaiki (lihat sebelum kerja di area terkait)
```

## Status / Yang Sedang Dikerjakan

- Branch aktif: `new_db` — eksplorasi migrasi database (kemungkinan ke PostgreSQL) belum selesai, `.env` masih pakai MySQL.
- Branch lain di remote: `main`, `develop`, `develop_learn`, `ezra`, `pidi`, `rivan`, `master` — kemungkinan branch kolaborasi per-anggota tim.
- phpMyAdmin dikonfigurasi login sebagai root (`PMA_USER: root`) supaya bisa kelola semua database di container, bukan cuma database `jajaningim`.

## Catatan Konvensi

- Detail kode contoh (snippet PHP/JS lengkap) untuk fitur-fitur di atas ada di `note 1.md` — baca file itu kalau butuh referensi implementasi persis, file ini hanya ringkasan peta proyek.
