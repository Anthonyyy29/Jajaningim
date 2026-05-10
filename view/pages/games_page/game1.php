<div id="halaman-utama">
  <main class="konten-utama">

    <div class="banner-game">
      <div class="banner-kiri">
        <img src="/assets/logo_game/mlbb.png" class="banner-icon" />
        <div class="banner-info">
          <div class="banner-nama-game">Mobile Legends: Bang Bang</div>
        </div>
      </div>
      <div class="banner-kanan">
        <p class="banner-deskripsi">
          Nikmati top up Mobile Legends yang cepat dan praktis.<br>
          Pilih metode pembayaran favoritmu dan langsung masuk ke akun.<br>
          Aman, mudah, dan terpercaya.
        </p>
        <div class="banner-store">
          <a href="https://apps.apple.com/id/app/mobile-legends-bang-bang/id1160056295?l=id" class="tombol-store-svg">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-apple" viewBox="0 0 16 16">
              <path d="M11.182.008C11.148-.03 9.923.023 8.857 1.18c-1.066 1.156-.902 2.482-.878 2.516s1.52.087 2.475-1.258.762-2.391.728-2.43m3.314 11.733c-.048-.096-2.325-1.234-2.113-3.422s1.675-2.789 1.698-2.854-.597-.79-1.254-1.157a3.7 3.7 0 0 0-1.563-.434c-.108-.003-.483-.095-1.254.116-.508.139-1.653.589-1.968.607-.316.018-1.256-.522-2.267-.665-.647-.125-1.333.131-1.824.328-.49.196-1.422.754-2.074 2.237-.652 1.482-.311 3.83-.067 4.56s.625 1.924 1.273 2.796c.576.984 1.34 1.667 1.659 1.899s1.219.386 1.843.067c.502-.308 1.408-.485 1.766-.472.357.013 1.061.154 1.782.539.571.197 1.111.115 1.652-.105.541-.221 1.324-1.059 2.238-2.758q.52-1.185.473-1.282"/>
            </svg>
            <span>App Store</span>
          </a>
          <a href="https://play.google.com/store/apps/details?id=com.mobile.legends&hl=id_ID" class="tombol-store-svg">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-google-play" viewBox="0 0 16 16">
              <path d="M14.222 9.374c1.037-.61 1.037-2.137 0-2.748L11.528 5.04 8.32 8l3.207 2.96zm-3.595 2.116L7.583 8.68 1.03 14.73c.201 1.029 1.36 1.61 2.303 1.055zM1 13.396V2.603L6.846 8zM1.03 1.27l6.553 6.05 3.044-2.81L3.333.215C2.39-.341 1.231.24 1.03 1.27"/>
            </svg>
            <span>Google Play</span>
          </a>
        </div>
      </div>
    </div>

    <div class="kartu" id="section-user-id">
      <div class="kartu-judul">USER ID</div>
      <div class="baris-input">
        <div class="kolom-input">
          <label>ID:</label>
          <input type="text" id="userId" placeholder="Masukkan ID...">
          <small>Pastikan isi kolom ID dan Server dengan benar!</small>
        </div>
        <div class="kolom-input">
          <label>Server:</label>
          <input type="text" id="serverId" placeholder="Masukkan Server...">
        </div>
        <div class="info-akun" id="info-akun">
          <img class="contoh-akun" src="/assets/component_page/contoh_akun.png" />
        </div>
      </div>
    </div>

    <div class="kartu" id="section-diamond">
      <div class="kartu-judul">Item</div>
      <div class="grid-diamond">
        <?php foreach (($game_items ?? []) as $item):
            $harga = number_format($item['price'], 0, ',', '.'); ?>
        <div class="item-diamond" data-value="<?= $item['price'] ?>" data-label="<?= htmlspecialchars($item['label_item']) ?>" onclick="pilihDiamond(this)">
          <div class="diamond-jumlah"><?= htmlspecialchars($item['label_item']) ?></div>
          <div class="diamond-harga">Rp. <?= $harga ?></div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>

    <div class="kartu" id="section-payment">
      <div class="kartu-judul">Metode Pembayaran</div>
      <div class="grid-payment">
        <div class="item-payment" data-payment="QRIS" onclick="pilihPayment(this)">
          <div class="payment-icon">
            <img src="/assets/component_logo/qris.png" alt="QRIS" class="payment-logo" />
          </div>
          <div class="payment-nama">QRIS</div>
        </div>
        <div class="item-payment" data-payment="ShopeePay" onclick="pilihPayment(this)">
          <div class="payment-icon">
            <img src="/assets/component_logo/shopeepay.png" alt="ShopeePay" class="payment-logo" />
          </div>
          <div class="payment-nama">ShopeePay</div>
        </div>
        <div class="item-payment" data-payment="Gopay" onclick="pilihPayment(this)">
          <div class="payment-icon">
            <img src="/assets/component_logo/gopay.png" alt="Gopay" class="payment-logo" />
          </div>
          <div class="payment-nama">Gopay</div>
        </div>
        <div class="item-payment" data-payment="Dana" onclick="pilihPayment(this)">
          <div class="payment-icon">
            <img src="/assets/component_logo/dana.png" alt="Dana" class="payment-logo" />
          </div>
          <div class="payment-nama">Dana</div>
        </div>
        <div class="item-payment" data-payment="OVO" onclick="pilihPayment(this)">
          <div class="payment-icon">
            <img src="/assets/component_logo/ovo.png" alt="OVO" class="payment-logo" />
          </div>
          <div class="payment-nama">OVO</div>
        </div>
      </div>
    </div>

    <div class="baris-email-invoice">
      <div class="kartu kartu-email">
        <div class="kartu-judul">E-mail</div>
        <p class="email-deskripsi">
          Opsional. Jika anda ingin mendapatkan bukti pembayaran atas
          pembelian anda, harap mengisi alamat emailnya.
        </p>
        <input type="email" id="email" placeholder="Masukkan e-mail...">
      </div>

      <div class="kartu kartu-invoice">
        <div class="kartu-judul">Invoice</div>
        <div class="invoice-baris">
          <span class="invoice-label">ID:</span>
          <span class="invoice-nilai" id="inv-id">------</span>
        </div>
        <div class="invoice-baris">
          <span class="invoice-label">Item:</span>
          <span class="invoice-nilai" id="inv-diamond">...... Diamonds (Rp. ...)</span>
        </div>
        <div class="invoice-baris">
          <span class="invoice-label">Payment:</span>
          <span class="invoice-nilai" id="inv-payment">------</span>
        </div>
        <button class="tombol-beli" onclick="beliSekarang()">BELI SEKARANG!</button>
      </div>
    </div>

  </main>
</div>

<div id="halaman-loading" class="tersembunyi">
  <main class="konten-tengah">
    <button class="tombol-kembali" onclick="kembaliKeUtama()">← Back</button>
    <div class="lingkaran-status">
      <div class="jam-icon">🕐</div>
    </div>
    <button class="tombol-status-abu">Menunggu Pembayaran...</button>
    <p class="teks-info">
      Kamu akan diarahkan ke pembayaran dalam 3 detik..<br>
      Verifikasi pembayaran akan dilakukan otomatis oleh sistem.<br>
      Jika tidak dapat diarahkan otomatis, <a href="#" class="link-biru">klik disini</a>
    </p>
    <div class="countdown" id="countdown-angka">3</div>
  </main>
</div>

<div id="halaman-sukses" class="tersembunyi">
  <main class="konten-tengah">
    <button class="tombol-next" onclick="kembaliKeUtama()">Next →</button>
    <div class="lingkaran-status lingkaran-hijau">
      <div class="centang-icon">✓</div>
    </div>
    <button class="tombol-status-hijau">Pembayaran-mu Berhasil!</button>
    <p class="teks-info">
      Apabila Diamond belum diterima atau mengalami kendala lainnya, harap hubungi kami.<br>
      Terima Kasih telah memilih JajaninGim!
    </p>
  </main>
</div>

<script>
  let diamondDipilih = null;
  let paymentDipilih = null;

  function pilihDiamond(elemen) {
    document.querySelectorAll('.item-diamond').forEach(i => i.classList.remove('terpilih'));
    elemen.classList.add('terpilih');
    diamondDipilih = elemen;
    updateInvoice();
  }

  function pilihPayment(elemen) {
    document.querySelectorAll('.item-payment').forEach(i => i.classList.remove('terpilih'));
    elemen.classList.add('terpilih');
    paymentDipilih = elemen;
    updateInvoice();
  }

  function updateInvoice() {
    const userId   = document.getElementById('userId').value;
    const serverId = document.getElementById('serverId').value;

    if (userId) {
      document.getElementById('inv-id').textContent = serverId ? `${userId} (${serverId})` : userId;
    }
    if (diamondDipilih) {
      const label = diamondDipilih.dataset.label;
      const harga = parseInt(diamondDipilih.dataset.value).toLocaleString('id-ID');
      document.getElementById('inv-diamond').textContent = `${label} (Rp. ${harga})`;
    }
    if (paymentDipilih) {
      document.getElementById('inv-payment').textContent = paymentDipilih.dataset.payment;
    }
  }

  function beliSekarang() {
    if (!document.getElementById('userId').value || !document.getElementById('serverId').value) {
      alert('Harap isi ID dan Server terlebih dahulu!');
      return;
    }
    if (!diamondDipilih) { alert('Harap pilih jumlah Diamond!'); return; }
    if (!paymentDipilih) { alert('Harap pilih metode pembayaran!'); return; }

    pindahHalaman('halaman-loading');
    startCountdown();
  }

  function startCountdown() {
    let angka = 3;
    const el  = document.getElementById('countdown-angka');
    const timer = setInterval(() => {
      angka--;
      if (el) el.textContent = angka;
      if (angka <= 0) { clearInterval(timer); pindahHalaman('halaman-sukses'); }
    }, 1000);
  }

  function pindahHalaman(id) {
    ['halaman-utama', 'halaman-loading', 'halaman-sukses'].forEach(h => {
      document.getElementById(h).classList.add('tersembunyi');
    });
    document.getElementById(id).classList.remove('tersembunyi');
    window.scrollTo(0, 0);
  }

  function kembaliKeUtama() { pindahHalaman('halaman-utama'); }

  document.getElementById('userId').addEventListener('input', updateInvoice);
  document.getElementById('serverId').addEventListener('input', updateInvoice);
</script>
