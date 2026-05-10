# JajaninGim — CLAUDE.md

Platform top-up game berbasis PHP vanilla. Users bisa beli in-game currency untuk game populer (Mobile Legends, Free Fire, CODM, dll).

---

## Stack

- **Backend:** PHP (no framework), PDO + MySQL
- **Frontend:** HTML, CSS3, Vanilla JS (no library)
- **Database:** MySQL — `jajaningim_DB`
- **Dev server:** XAMPP/WAMP (localhost)

---

## Struktur Project

```
index.php                    # Entry point + router utama
app/
  config/connection.php      # Koneksi PDO
  handlers/request.php       # Handler POST (login, register) — query auth saja
  helpers/                   # cookies.php & reponse.php (belum dipakai)
view/
  layout/header.php          # Navbar (sticky)
  layout/footer.php          # Footer + sosmed icons
  pages/
    home.php                 # Game grid (dinamis dari DB, urut id_game ASC)
    login.php                # Halaman login — split layout kiri/kanan
    register.php             # Halaman register — split layout kiri/kanan
    forgot_password.php      # Halaman lupa password
    games.php                # Daftar semua game (A-Z, sticky index sidebar)
    about.php                # Halaman about
    games_page/game1.php     # Top-up MLBB (item dinamis dari DB, id_games=1)
    games_page/game2.php     # Top-up game lain (belum dinamis)
assets/
  logo_jajaningim/           # Logo site + ikon sosmed (instagram, facebook, youtube)
  logo_game/                 # Logo game (mlbb.png, freefire.png, dll)
  component_logo/            # Logo payment (qris, gopay, shopeepay, dana, ovo)
  component_page/            # Asset halaman (contoh_akun.png)
styles/style.css             # CSS global (CSS variables, semua halaman)
add_rivan/                   # Legacy — JANGAN dipakai, sudah dimigrasikan ke view/pages
```

---

## Routing

Router ada di `index.php` pakai switch-case berdasarkan `?url=`:

```php
$url = trim($_GET['url'] ?? 'home', '/');
switch ($url) {
    case 'home':   // query games ORDER BY id_game ASC → $games
    case 'games':  // query games ORDER BY nama_game ASC → $games
    case 'game1':  // query game_items WHERE id_games=1 ORDER BY price ASC → $game_items
    case 'login':  // load view saja, tidak ada query
    ...
}
```

**Aturan wajib:**
- Query database untuk render halaman dilakukan di `index.php` **sebelum** load view, bukan di dalam file view
- Variabel hasil query di-pass ke view lewat variabel PHP biasa (`$games`, `$game_items`)
- View pakai `?? []` sebagai fallback jika variabel tidak terdefinisi
- `request.php` **hanya** boleh berisi query untuk keperluan autentikasi (login/register), bukan query render halaman

---

## Database

**Koneksi:** `app/config/connection.php` → variabel `$pdo`

| Tabel | Kegunaan |
|---|---|
| `games` | Daftar game (`id_game`, `nama_game`, `gambar_game`) |
| `game_items` | Item top-up per game (`id_item`, `id_games`, `label_item`, `price`, `type`) |
| `payment` | Metode pembayaran (`id_payment`, `metode_payment`, `logo`, `is_active`) |
| `users` | Akun user (`id_user`, `username`, `email`, `password`) |
| `transaksi` | Riwayat transaksi |

**Penting:**
- Semua query pakai **prepared statement PDO** — jangan pakai string interpolasi langsung
- Field `gambar_game` dan `logo` di DB hanya menyimpan **nama file** (contoh: `mlbb.png`), path lengkapnya di-handle di PHP/HTML saat render
- Password di-hash pakai `password_hash()` / `password_verify()` — plain-text tidak pernah disimpan

---

## Konvensi CSS

CSS global ada di `styles/style.css`. Pakai CSS variables:

```css
--aksen: #00b8c8
--aksen-hover: #0097a7
--navbar-bg: #252b32
--kartu-bg: #393E46
```

Penamaan class:
- **Indonesian:** `.kartu`, `.baris`, `.kolom`, `.tersembunyi`, `.terpilih`
- **Prefix per section:** `.banner-*`, `.grid-*`, `.item-*`, `.invoice-*`, `.auth-*`, `.nav-*`, `.games-*`
- State aktif: `.terpilih` (selected), `.tersembunyi` (hidden/display:none)

---

## Auth Flow

```
Form POST → /app/handlers/request.php (action=login|register)
  → Validasi input
  → Query PDO dengan prepared statement
  → Sukses login:    $_SESSION['user'] diset → redirect /?url=home
  → Sukses register: redirect /?url=login&success=registered
  → Gagal:           redirect /?url=login&error=invalid (atau error lain)
```

Error/success ditampilkan via `$_GET['error']` / `$_GET['success']` di view — bukan `alert()`.

---

## Games Page (/?url=games)

- Game dikelompokkan per huruf pertama nama game (A–Z), karakter non-huruf masuk `#`
- Sidebar kanan sticky berisi indeks A–Z + `#`
- Huruf yang tidak ada gamenya di-grey out dan tidak bisa diklik
- Klik huruf → smooth scroll ke section yang sesuai

---

## Game Top-Up Pages

- **game1.php** — item diambil dinamis dari tabel `game_items` WHERE `id_games = 1`
- **game2.php** — masih hard-coded, rencana akan dibuat dinamis berdasarkan `id_game` dari DB (sama seperti game1)
- Link dari home/games menggunakan `/?url=game{id_game}` — id sesuai tabel `games`

---

## Hal yang Perlu Diperhatikan

- **`add_rivan/`** — folder lama, sudah dimigrasikan. Aset di dalamnya (`asset_Login/`, `asset_registrasi/`) masih direferensikan oleh view login/register sampai dipindah ke `assets/`
- **`game2.php`** — masih hard-coded, belum dinamis dari DB
- **`app/helpers/`** — kosong, belum diimplementasikan
- **Transaksi** — halaman dan tabel sudah ada tapi belum ada backend processing
- **Session** — login set `$_SESSION['user']`, belum ada pengecekan session di semua halaman
