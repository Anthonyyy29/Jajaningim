<x-layouts.app>
    <a href="{{ route('home') }}" class="auth-link-muted d-inline-block mb-4">&larr; Kembali ke Home</a>

    <div class="mb-3">
        <h1 class="heading-jumbotron mb-1">Detail Akun</h1>
        <p style="color: var(--of-text-2);">Kelola informasi akun, keamanan, dan lihat riwayat top up kamu di sini.</p>
    </div>

    @if (session('status'))
        <div class="account-status">{{ session('status') }}</div>
    @endif

    <div class="account-grid">
        {{-- Kartu profil --}}
        <div class="account-card account-profile-card">
            <div class="account-avatar">{{ strtoupper(substr($user->name, 0, 2)) }}</div>
            <div class="account-name">{{ $user->name }}</div>
            <div class="account-email">{{ $user->email }}</div>

            <div class="account-meta">
                <div class="account-meta-row">
                    <span>Member sejak</span>
                    <span>{{ $user->created_at->translatedFormat('F Y') }}</span>
                </div>
                <div class="account-meta-row">
                    <span>Total transaksi</span>
                    <span>{{ $transactions->count() }} order</span>
                </div>
                <div class="account-meta-row">
                    <span>Total top up</span>
                    <span>Rp{{ number_format($transactions->where('status', 'paid')->sum('amount'), 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <div class="account-sections">
            {{-- Informasi akun --}}
            <section class="account-card">
                <div class="account-section-head">
                    <h2>Informasi Akun</h2>
                    <span class="hint">Email dipakai untuk invoice &amp; notifikasi pembayaran</span>
                </div>

                <form method="POST" action="{{ route('account.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="account-field-row">
                        <div class="account-field">
                            <label for="name">Username / Nama</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}">
                            @error('name')
                                <div class="auth-error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="account-field">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}">
                            @error('email')
                                <div class="auth-error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="account-form-actions">
                        <button class="btn btn-of-accent" type="submit">Simpan Perubahan</button>
                    </div>
                </form>
            </section>

            {{-- Keamanan --}}
            <section class="account-card">
                <div class="account-section-head">
                    <h2>Keamanan</h2>
                    <span class="hint">Ganti password secara berkala</span>
                </div>

                <form method="POST" action="{{ route('account.password') }}">
                    @csrf
                    @method('PUT')

                    <div class="account-field">
                        <label for="current_password">Password saat ini</label>
                        <input type="password" id="current_password" name="current_password" placeholder="Masukkan password saat ini">
                        @error('current_password')
                            <div class="auth-error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="account-field-row">
                        <div class="account-field">
                            <label for="password">Password baru</label>
                            <input type="password" id="password" name="password" placeholder="Minimal 8 karakter">
                            @error('password')
                                <div class="auth-error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="account-field">
                            <label for="password_confirmation">Konfirmasi password baru</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password baru">
                        </div>
                    </div>

                    <div class="account-form-actions">
                        <button class="btn btn-of-accent" type="submit">Update Password</button>
                    </div>
                </form>
            </section>

            {{-- Riwayat transaksi --}}
            <section class="account-card">
                <div class="account-section-head">
                    <h2>Riwayat Transaksi</h2>
                    <span class="hint">{{ $transactions->count() }} transaksi terakhir</span>
                </div>

                @if ($transactions->isEmpty())
                    <p class="account-empty-note">Belum ada transaksi. Yuk mulai top up game favoritmu!</p>
                @else
                    <div class="order-table-wrap">
                        <table class="order-table">
                            <thead>
                                <tr>
                                    <th>Order</th>
                                    <th>Item</th>
                                    <th>Jumlah</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $transaction)
                                    <tr>
                                        <td class="order-id">
                                            <a href="{{ route('transaction.show', $transaction->order_id) }}" class="auth-link">{{ $transaction->order_id }}</a>
                                        </td>
                                        <td>
                                            <div class="order-item-name">{{ $transaction->gameDetail->name ?? '—' }}</div>
                                            <div class="order-item-sub">{{ $transaction->game->name ?? '—' }}</div>
                                        </td>
                                        <td class="amount">Rp{{ number_format($transaction->amount, 0, ',', '.') }}</td>
                                        <td>
                                            @php
                                                $pillClass = match ($transaction->status) {
                                                    'paid' => 'pill--paid',
                                                    'pending' => 'pill--pending',
                                                    default => 'pill--failed',
                                                };
                                                $pillLabel = match ($transaction->status) {
                                                    'paid' => '✅ Berhasil',
                                                    'pending' => '⏳ Menunggu',
                                                    'expired' => '⏳ Kedaluwarsa',
                                                    default => '❌ Gagal',
                                                };
                                            @endphp
                                            <span class="pill {{ $pillClass }}">{{ $pillLabel }}</span>
                                        </td>
                                        <td>{{ $transaction->created_at->translatedFormat('d M Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </section>
        </div>
    </div>
</x-layouts.app>
