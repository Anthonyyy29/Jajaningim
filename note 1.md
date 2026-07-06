# Note 1 — Catatan Pengembangan Jajaningim

## 1. Dynamic Page Berdasarkan ID Game

**Konsep:** 1 route + 1 controller method + 1 view blade. Data yang berubah, bukan file-nya.

**Bug yang diperbaiki di `GameController.php`:**
```php
// ❌ Salah — mencari file game1.blade.php, game2.blade.php, dst
return view('pages.game' . $id, compact('game'));

// ✅ Benar — selalu pakai 1 file game.blade.php, datanya yang beda
return view('pages.game', compact('game'));
```

**Alur:**
```
URL /game/3
  → GameController::show($id = 3)
  → Game::findOrFail(3)    ← ambil data dari DB sesuai ID
  → view('pages.game', compact('game'))   ← kirim ke 1 file blade
  → blade render {{ $game->name }}, {{ $game->description }}, dll
```

---

## 2. Struktur `game.blade.php`

### Sections yang dibuat:
| Section | Isi |
|---|---|
| Card atas | Gambar game + nama + form input User ID / Server |
| Card nominal | Grid pilih nominal (`$game->details`) |
| Card metode pembayaran | Pilihan QRIS, ShopeePay, GoPay, DANA, OVO dari DB |
| Email | Input email opsional |
| Invoice | Live update otomatis pakai JS |

### Form fields dinamis
Form input (User ID, Server) dibaca dari kolom `form_fields` (JSON) di tabel `games`:
```php
$formFields = $game->form_fields ?? []; // contoh: ['user_id', 'server_id']
```

### Invoice live update (JS di `app.js`)
```
User pilih nominal   → data-name, data-price → update #inv-item, #inv-total
User pilih payment   → data-full             → update #inv-payment
User ketik ID        → .game-id-field        → update #inv-id
```

---

## 3. Struktur Database

### Tabel `games`
| Kolom | Tipe | Keterangan |
|---|---|---|
| `id` | bigint | Primary key |
| `name` | string(100) | Nama game |
| `description` | text | Deskripsi |
| `image` | string(20) | Nama file gambar |
| `form_fields` | json | Field form yang ditampilkan |
| `is_active` | enum | true / false |

### Tabel `game_detail`
| Kolom | Tipe | Keterangan |
|---|---|---|
| `game_id` | FK → games.id | |
| `name` | string(100) | Nama nominal (misal: "56 Diamond") |
| `price` | integer | Harga dalam rupiah |
| `label` | string(20) | Kategori (Diamond, CP, UC, dll) |

### Tabel `table_payment_method`
| Kolom | Tipe | Keterangan |
|---|---|---|
| `metode_payment` | string(50) | Nama metode (QRIS, GoPay, dll) |
| `logo` | string(100) | Nama file logo |
| `is_active` | enum | true / false |

### Relasi Model
```php
// Game.php
public function details(): HasMany
{
    return $this->hasMany(GameDetail::class);
}

// GameDetail.php
public function game(): BelongsTo
{
    return $this->belongsTo(Game::class);
}
```

---

## 4. Payment Method

Diambil dari DB (bukan hardcoded) melalui controller:
```php
// GameController::show()
$paymentMethods = PaymentMethod::where('is_active', 'true')->get();
return view('pages.game', compact('game', 'paymentMethods'));
```

Logo diambil dari `public/assets/component_logo/` sesuai kolom `logo` di DB.

---

## 5. Search dengan Debounce (`resources/js/search.js`)

### Konsep Debounce
```
User ketik "m"   → timer mulai 400ms
User ketik "mo"  → timer RESET
User ketik "mob" → timer RESET
User berhenti... → 400ms berlalu → pencarian dijalankan
```
Tanpa debounce = setiap keystroke trigger pencarian → boros.

### Data game tersedia di JS via `window.GAMES`
Di `app.blade.php`, data game di-embed sebagai JS variable:
```php
@php $allGames = \App\Models\Game::where('is_active', 'true')->get(['id', 'name']); @endphp
<script>
    window.GAMES         = @json($allGames);
    window.GAME_BASE_URL = '{{ url('/game') }}';
    window.NOT_FOUND_URL = '{{ url('/game-not-found') }}';
</script>
```

### Alur search
```
User mengetik (input event, debounce 400ms)
  → searchGames(query) → filter window.GAMES
  → Ada hasil?  → tampilkan dropdown
  → Tidak ada?  → dropdown "Game X tidak ditemukan"

User tekan Enter / klik Search (submit event, tanpa debounce)
  → Ada hasil?  → redirect ke /game/{id}
  → Tidak ada?  → redirect ke /game-not-found?q=xxx
```

### Halaman not found (`pages/game-not-found.blade.php`)
Menampilkan pesan error + query yang dicari + tombol kembali.

---

## 6. Autentikasi Manual

### File yang dibuat/diubah
| File | Perubahan |
|---|---|
| `app/Http/Controllers/AuthController.php` | Baru — handle login, register, logout |
| `routes/web.php` | Tambah POST routes + middleware |
| `pages/login.blade.php` | Action + error display + `old()` |
| `pages/register.blade.php` | Action + fix field name + error display |
| `components/layouts/navigation.blade.php` | Pakai `@auth` + tombol logout |
| `resources/css/auth.css` | Tambah class `.auth-error` |

### Routes auth
```php
// Guest only (tidak bisa diakses kalau sudah login)
Route::middleware('guest')->group(function () {
    Route::get('/login',     [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',    [AuthController::class, 'login'])->name('login.post');
    Route::get('/register',  [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

// Auth only (hanya bisa diakses kalau sudah login)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
```

### Alur login
```
POST /login
  → validate email & password
  → Auth::attempt()
      → Cocok: session()->regenerate() → redirect home
      → Tidak cocok: back() + error "Email atau password salah"
```

### Alur register
```
POST /register
  → validate name, email (unique), password (min:8, confirmed)
  → User::create() + Hash::make(password)
  → Auth::login($user) → auto login
  → redirect home
```

### Alur logout
```
POST /logout
  → Auth::logout()
  → session()->invalidate()      ← hancurkan session
  → session()->regenerateToken() ← buat CSRF token baru
  → redirect home
```

### Konsep penting
| Konsep | Penjelasan |
|---|---|
| `Auth::attempt()` | Cek email + bandingkan password hash di DB otomatis |
| `Hash::make()` | Enkripsi password — tidak bisa dibaca balik |
| `session()->regenerate()` | Ganti session ID — cegah session fixation attack |
| `redirect()->intended()` | Redirect ke halaman tujuan awal sebelum login |
| `onlyInput('email')` | Kembalikan email ke form tapi bukan password |
| `'confirmed'` rule | Cocokkan `password` dengan `password_confirmation` otomatis |
| `@auth / @else / @endauth` | Directive blade untuk cek status login |

---

## 7. File Structure Ringkasan

```
app/
├── Http/Controllers/
│   ├── AuthController.php       ← login, register, logout
│   └── GameController.php       ← index, show, populerIndex
└── Models/
    ├── Game.php
    ├── GameDetail.php
    └── PaymentMethod.php

resources/
├── css/
│   ├── app.css                  ← Ocean Fresh design system
│   └── auth.css                 ← styling khusus halaman auth
├── js/
│   ├── app.js                   ← entry point + invoice live update
│   └── search.js                ← debounce search + dropdown
└── views/
    ├── components/layouts/
    │   ├── app.blade.php        ← layout utama + embed window.GAMES
    │   └── navigation.blade.php ← navbar + search form + auth dropdown
    └── pages/
        ├── game.blade.php       ← halaman detail game (dinamis)
        ├── game-not-found.blade.php
        ├── allgames.blade.php
        ├── home.blade.php
        ├── login.blade.php
        └── register.blade.php

database/
├── migrations/
│   ├── 0001_01_01_000000_create_users_table.php   ← bawaan Laravel
│   ├── 2026_06_29_064126_create_games_table.php
│   ├── 2026_06_29_065121_create_game_details_table.php
│   └── 2026_07_02_074600_create_payment_methods.php
└── seeders/
    ├── DatabaseSeeder.php
    ├── GameSeeder.php
    ├── GameDetailsSeeder.php
    └── payment_method_seeder.php

routes/
└── web.php
```
