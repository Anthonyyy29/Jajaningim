// ============================================================
// DEBOUNCE
// Menunda eksekusi fungsi sampai user berhenti mengetik.
// Setiap kali fungsi dipanggil, timer direset.
// Fungsi baru dijalankan hanya setelah `delay` ms berlalu
// tanpa ada panggilan baru.
// ============================================================
function debounce(fn, delay) {
    let timer;
    return function (...args) {
        clearTimeout(timer);                          // reset timer tiap keystroke
        timer = setTimeout(() => fn.apply(this, args), delay);
    };
}

// ============================================================
// PENCARIAN
// Filter window.GAMES berdasarkan query (case-insensitive).
// Mengembalikan array game yang namanya mengandung query.
// ============================================================
function searchGames(query) {
    const games = window.GAMES || [];
    return games.filter(g => g.name.toLowerCase().includes(query.toLowerCase()));
}

// ============================================================
// DROPDOWN
// Dibuat sekali secara dinamis dan di-append ke wrapper form.
// Ditampilkan/disembunyikan sesuai hasil pencarian.
// ============================================================
function createDropdown(form) {
    const dropdown = document.createElement('ul');
    dropdown.id = 'search-dropdown';

    // Styling inline pakai CSS variable Ocean Fresh
    Object.assign(dropdown.style, {
        position:        'absolute',
        top:             '100%',
        left:            '0',
        right:           '0',
        zIndex:          '9999',
        listStyle:       'none',
        margin:          '4px 0 0',
        padding:         '0',
        borderRadius:    '8px',
        border:          '1px solid var(--of-border)',
        backgroundColor: 'var(--of-surface-2)',
        boxShadow:       '0 8px 24px rgba(0,0,0,.4)',
        display:         'none',
    });

    // Wrapper form dibuat relative agar dropdown bisa absolute
    form.style.position = 'relative';
    form.appendChild(dropdown);
    return dropdown;
}

// ============================================================
// TAMPILKAN HASIL DI DROPDOWN
// ============================================================
function showResults(dropdown, results, rawQuery) {
    dropdown.innerHTML = '';

    if (results.length === 0) {
        // ── Tidak ada hasil ──
        const li = document.createElement('li');
        li.textContent = `Game "${rawQuery}" tidak ditemukan`;
        Object.assign(li.style, {
            padding: '.6rem 1rem',
            color:   'var(--of-muted)',
            fontSize: '.875rem',
        });
        dropdown.appendChild(li);

    } else {
        // ── Tampilkan tiap game yang cocok ──
        results.forEach(game => {
            const li = document.createElement('li');
            li.textContent = game.name;
            Object.assign(li.style, {
                padding:    '.6rem 1rem',
                cursor:     'pointer',
                color:      'var(--of-text)',
                fontSize:   '.9rem',
                transition: 'background-color .1s ease',
            });

            // Highlight saat hover
            li.addEventListener('mouseenter', () => li.style.backgroundColor = 'var(--of-surface)');
            li.addEventListener('mouseleave', () => li.style.backgroundColor = 'transparent');

            // Klik item → langsung ke halaman game
            li.addEventListener('click', () => {
                window.location.href = window.GAME_BASE_URL + '/' + game.id;
            });

            dropdown.appendChild(li);
        });
    }

    dropdown.style.display = 'block';
}

// ============================================================
// SEMBUNYIKAN DROPDOWN
// ============================================================
function hideDropdown(dropdown) {
    dropdown.style.display = 'none';
    dropdown.innerHTML = '';
}

// ============================================================
// INIT — dipanggil setelah DOM siap
// ============================================================
document.addEventListener('DOMContentLoaded', function () {
    const form  = document.getElementById('search-form');
    const input = document.getElementById('search-input');
    if (!form || !input) return;

    const dropdown = createDropdown(form);

    // ── Live search dengan debounce 400ms ──
    // Artinya: pencarian baru terjadi 400ms setelah user
    // berhenti mengetik — bukan setiap keystroke.
    const onInput = debounce(function () {
        const query = input.value.trim();

        if (!query) {
            hideDropdown(dropdown);
            return;
        }

        const results = searchGames(query);
        showResults(dropdown, results, query);
    }, 400);

    input.addEventListener('input', onInput);

    // ── Submit form (tekan Enter / klik tombol Search) ──
    // Langsung navigasi tanpa debounce — karena user sudah
    // secara eksplisit menekan submit.
    form.addEventListener('submit', function (e) {
        e.preventDefault();
        const query = input.value.trim();
        if (!query) return;

        const results = searchGames(query);
        if (results.length > 0) {
            window.location.href = window.GAME_BASE_URL + '/' + results[0].id;
        } else {
            window.location.href = window.NOT_FOUND_URL + '?q=' + encodeURIComponent(query);
        }
    });

    // ── Tutup dropdown saat klik di luar area form ──
    document.addEventListener('click', function (e) {
        if (!form.contains(e.target)) hideDropdown(dropdown);
    });
});
