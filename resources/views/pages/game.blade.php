<x-layouts.app>
    @php
        $fieldMeta = [
            'user_id'   => ['label' => 'User ID', 'placeholder' => 'Masukkan ID...', 'hint' => 'cth: 125907713'],
            'server_id' => ['label' => 'Server',  'placeholder' => 'Masukkan Server...', 'hint' => 'cth: 2631'],
        ];
        $formFields = $game->form_fields ?? [];

    @endphp

    @if ($errors->any())
        <div class="alert alert-danger rounded-4 mb-4">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('transaction.store') }}">
        @csrf
        <input type="hidden" name="game_id" value="{{ $game->id }}">

        {{-- Card atas: info game + form input ID --}}
        <div class="promo_banner rounded-4 p-4 p-md-5 mb-4">
        <div class="row g-4 align-items-center">

            <div class="col-md-7">
                <div class="d-flex align-items-center gap-3 mb-4">
                    <img src="{{ asset('assets/logo_game/' . $game->image) }}"
                         alt="{{ $game->name }}"
                         class="rounded-4"
                         style="width: 90px; height: 90px; object-fit: cover; flex-shrink: 0;">
                    <div>
                        <h1 class="h4 fw-bold mb-0">{{ $game->name }}</h1>
                    </div>
                </div>

                @foreach ($formFields as $field)
                    @php
                        $meta = $fieldMeta[$field] ?? [
                            'label'       => ucfirst(str_replace('_', ' ', $field)),
                            'placeholder' => 'Masukkan ' . ucfirst(str_replace('_', ' ', $field)) . '...',
                            'hint'        => null,
                        ];
                    @endphp
                    <div class="mb-3">
                        <label for="{{ $field }}" class="form-label fw-semibold small" style="color: var(--of-text);">
                            {{ $meta['label'] }}
                        </label>
                        <div class="d-flex gap-2">
                            <input type="text" id="{{ $field }}" name="{{ $field }}"
                                   class="form-control form-control-lg game-id-field"
                                   style="background-color: var(--of-surface-2); border-color: var(--of-border); color: var(--of-text);"
                                   placeholder="{{ $meta['placeholder'] }}">
                            @if ($meta['hint'])
                                <span class="d-flex align-items-center px-3 rounded-3 flex-shrink-0 small"
                                      style="background-color: var(--of-surface-2); border: 1px solid var(--of-border); color: var(--of-text-2);">
                                    {{ $meta['hint'] }}
                                </span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="col-md-5 d-flex align-items-center justify-content-center border-start-md ps-md-5">
                <p class="text-center mb-0" style="color: var(--of-text-2);">
                    {{ $game->description }}
                </p>
            </div>

        </div>
    </div>

    {{-- Card nominal --}}
    @if ($game->details->isNotEmpty())
        <div class="promo_banner rounded-4 p-4 p-md-5 mb-4">
            <h2 class="h5 fw-bold mb-4">
                <span class="text-of-teal">&#9670;</span> Pilih Nominal
            </h2>
            <div class="row g-3">
                @foreach ($game->details as $detail)
                    <div class="col-6 col-md-4 col-lg-3 col-xl-2-4">
                        <label class="nominal-card d-block rounded-4 p-3 text-center h-100" style="cursor: pointer;">
                            <input type="radio" name="detail_id" value="{{ $detail->id }}" class="d-none"
                                   data-name="{{ $detail->name }}"
                                   data-price="Rp. {{ number_format($detail->price, 0, ',', '.') }}">
                            <div class="fw-semibold mb-1">
                                <span class="text-of-teal">&#9670;</span>
                                {{ $detail->name }}
                            </div>
                            <div class="small" style="color: var(--of-text-2);">
                                Rp. {{ number_format($detail->price, 0, ',', '.') }}
                            </div>
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    {{-- Card metode pembayaran --}}
    <div class="promo_banner rounded-4 p-4 p-md-5 mb-4">
        <h2 class="h5 fw-bold mb-4">Metode Pembayaran</h2>
        <div class="row g-3">
            @foreach ($paymentMethods as $method)
                <div class="col-6 col-md-4 col-lg">
                    <label class="payment-card d-block rounded-4 p-3 text-center h-100" style="cursor: pointer;">
                        <input type="radio" name="payment_method" value="{{ $method->id }}" class="d-none"
                               data-full="{{ $method->metode_payment }}">
                        <img src="{{ asset('assets/component_logo/' . $method->logo) }}"
                             alt="{{ $method->metode_payment }}"
                             style="height: 32px; object-fit: contain; margin-bottom: .5rem;">
                        <div class="fw-bold small">{{ $method->metode_payment }}</div>
                    </label>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Email + Invoice --}}
    <div class="row g-4">

        {{-- Email --}}
        <div class="col-md-5">
            <div class="promo_banner rounded-4 p-4 p-md-5 h-100">
                <h2 class="h5 fw-bold mb-1">E-mail</h2>
                <p class="small mb-3" style="color: var(--of-text-2);">
                    Opsional: isi email kamu untuk mendapatkan bukti pembayaran.
                </p>
                <input type="email" id="email_input" name="email"
                       class="form-control form-control-lg"
                       style="background-color: var(--of-surface-2); border-color: var(--of-border); color: var(--of-text);"
                       placeholder="Masukkan E-mail...">
            </div>
        </div>

        {{-- Invoice --}}
        <div class="col-md-7">
            <div class="promo_banner rounded-4 p-4 p-md-5 h-100 d-flex flex-column">
                <h2 class="h5 fw-bold mb-4">Invoice</h2>

                <div class="d-flex flex-column gap-3 flex-grow-1">
                    <div class="d-flex justify-content-between align-items-center"
                         style="border-bottom: 1px solid var(--of-border); padding-bottom: .75rem;">
                        <span style="color: var(--of-text-2);">ID</span>
                        <span id="inv-id" class="fw-semibold" style="color: var(--of-text-2);">———</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center"
                         style="border-bottom: 1px solid var(--of-border); padding-bottom: .75rem;">
                        <span style="color: var(--of-text-2);">Item</span>
                        <span id="inv-item" class="fw-semibold" style="color: var(--of-text-2);">———</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center"
                         style="border-bottom: 1px solid var(--of-border); padding-bottom: .75rem;">
                        <span style="color: var(--of-text-2);">Payment</span>
                        <span id="inv-payment" class="fw-semibold" style="color: var(--of-text-2);">———</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-bold">Total</span>
                        <span id="inv-total" class="fw-bold fs-5 text-of-accent">———</span>
                    </div>
                </div>

                <button type="submit" class="btn btn-of-accent w-100 mt-4 py-3 fw-bold"
                        style="font-family: 'Saira Stencil One', sans-serif; letter-spacing: .05em; font-size: 1.1rem;">
                    BELI SEKARANG !
                </button>
            </div>
        </div>

    </div>
    </form>

    <style>
        .border-start-md { border-left: none; }
        @media (min-width: 768px) {
            .border-start-md { border-left: 1px solid var(--of-border); }
        }

        @media (min-width: 1200px) {
            .col-xl-2-4 { flex: 0 0 auto; width: 20%; }
        }

        /* Nominal cards — teal selected */
        .nominal-card {
            background-color: var(--of-surface-2);
            border: 1px solid var(--of-border);
            transition: border-color .15s ease, background-color .15s ease;
        }
        .nominal-card:hover { border-color: var(--of-teal); }
        .nominal-card:has(input:checked) {
            border-color: var(--of-teal);
            background-color: var(--of-surface);
            box-shadow: 0 0 0 1px var(--of-teal);
        }

        /* Payment cards — blue selected */
        .payment-card {
            background-color: var(--of-surface-2);
            border: 1px solid var(--of-border);
            transition: border-color .15s ease, background-color .15s ease;
        }
        .payment-card:hover { border-color: var(--of-primary); }
        .payment-card:has(input:checked) {
            border-color: var(--of-primary);
            background-color: var(--of-surface);
            box-shadow: 0 0 0 1px var(--of-primary);
        }

        input.form-control::placeholder { color: var(--of-muted); }
    </style>

</x-layouts.app>
