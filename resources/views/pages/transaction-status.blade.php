<x-layouts.app>
    @php
        $statusMeta = [
            'pending' => ['emoji' => '&#8987;', 'label' => 'Menunggu Pembayaran', 'color' => 'var(--of-text-2)'],
            'paid'    => ['emoji' => '&#9989;', 'label' => 'Pembayaran Berhasil', 'color' => 'var(--of-teal)'],
            'failed'  => ['emoji' => '&#10060;', 'label' => 'Pembayaran Gagal', 'color' => '#dc3545'],
            'expired' => ['emoji' => '&#8987;', 'label' => 'Pembayaran Kedaluwarsa', 'color' => '#dc3545'],
        ];
        $meta = $statusMeta[$transaction->status];
    @endphp

    <div class="promo_banner rounded-4 p-4 p-md-5 mx-auto" style="max-width: 480px;">
        <div class="text-center mb-4">
            <div style="font-size: 3rem; line-height: 1;">{!! $meta['emoji'] !!}</div>
            <h1 class="h5 fw-bold mt-3" style="color: {{ $meta['color'] }};">{{ $meta['label'] }}</h1>
            <p class="small" style="color: var(--of-text-2);">Order ID: {{ $transaction->order_id }}</p>
        </div>

        <div class="d-flex flex-column gap-3">
            <div class="d-flex justify-content-between align-items-center"
                 style="border-bottom: 1px solid var(--of-border); padding-bottom: .75rem;">
                <span style="color: var(--of-text-2);">Game</span>
                <span class="fw-semibold">{{ $transaction->game->name }}</span>
            </div>
            <div class="d-flex justify-content-between align-items-center"
                 style="border-bottom: 1px solid var(--of-border); padding-bottom: .75rem;">
                <span style="color: var(--of-text-2);">Item</span>
                <span class="fw-semibold">{{ $transaction->gameDetail->name }}</span>
            </div>
            <div class="d-flex justify-content-between align-items-center"
                 style="border-bottom: 1px solid var(--of-border); padding-bottom: .75rem;">
                <span style="color: var(--of-text-2);">Payment</span>
                <span class="fw-semibold">{{ $transaction->paymentMethod->metode_payment }}</span>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <span class="fw-bold">Total</span>
                <span class="fw-bold fs-5 text-of-accent">Rp. {{ number_format($transaction->amount, 0, ',', '.') }}</span>
            </div>
        </div>

        <a href="{{ route('home') }}" class="btn btn-of-accent w-100 mt-4 py-3 fw-bold text-center">
            Kembali ke Home
        </a>
    </div>
</x-layouts.app>
