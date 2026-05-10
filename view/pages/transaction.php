<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>JajaninGim</title>
  <link rel="stylesheet" href="/styles/style.css">
</head>
<body>
  <div class="page">
    <header class="navbar">
      <div class="logo-box">
        <img src="/assets/logo_jajaningim/logo.png" alt="JajaninGim Logo">
      </div>

      <h1 class="site-title">JajaninGim.site</h1>

      <div class="nav-right">
        <div class="search-box">
          <input type="text" id="searchInput" placeholder="Find Games...">
          <button id="searchBtn">⌕</button>
        </div>
        <nav class="nav-links">
          <a href="/?url=home">Home</a>
          <a href="/?url=games">Games</a>
          <a href="/?url=about">About</a>
        </nav>
        <a href="/?url=login" class="login-btn">Login / Register</a>
      </div>
    </header>

    <!-- ===== KONTEN UTAMA ===== -->
    <main class="konten-utama">

      <!-- BANNER GAME -->
      <div class="banner-game">
        <div class="banner-kiri">
          <img src="mlbb.png" class="banner-icon" />
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
            <a href="https://apps.apple.com/id/app/mobile-legends-bang-bang/id1160056295?l=id">
              <img src="logo app store.png" alt="logo app store" class="tombol-store" />
            </a>
            <a href="https://play.google.com/store/apps/details?id=com.mobile.legends&hl=id_ID&gl=LA">
              <img src="logo play store.png" alt="logo play store" class="tombol-store" />
            </a>
          </div>
        </div>
      </div>

      <!-- SECTION: USER ID -->
      <div class="kartu" id="section-user-id">
        <div class="kartu-judul">USER ID</div>
        <div class="baris-input">
          <div class="kolom-input">
            <label>ID:</label>
            <input type="text" id="userId" placeholder="Masukkan ID...">
            <small>Pastikan isi kolom ID dan Server dengan benar !</small>
          </div>
          <div class="kolom-input">
            <label>Server:</label>
            <input type="text" id="serverId" placeholder="Masukkan Server...">
          </div>
          <!-- Kotak info akun (muncul setelah isi ID) -->
          <div class="info-akun" id="info-akun">
            <img class="contoh-akun" src="contoh-id.jpg" />
          </div>
        </div>
      </div>

      <!-- SECTION: PILIH DIAMOND -->
      <div class="kartu" id="section-diamond">
        <div class="kartu-judul">Diamond</div>
        <div class="grid-diamond">

          <!-- Setiap item diamond punya: gambar, jumlah, harga -->
          <!-- data-value = harga dalam rupiah, data-jumlah = jumlah diamond -->
          <div class="item-diamond" data-value="1200" data-jumlah="3" onclick="pilihDiamond(this)">
            <div class="diamond-icon">💎</div>
            <div class="diamond-jumlah">3 Diamonds</div>
            <div class="diamond-harga">Rp. 1.200</div>
          </div>

          <div class="item-diamond" data-value="1500" data-jumlah="5" onclick="pilihDiamond(this)">
            <div class="diamond-icon">💎</div>
            <div class="diamond-jumlah">5 Diamonds</div>
            <div class="diamond-harga">Rp. 1.500</div>
          </div>

          <div class="item-diamond" data-value="3400" data-jumlah="12" onclick="pilihDiamond(this)">
            <div class="diamond-icon">💎</div>
            <div class="diamond-jumlah">12 Diamonds</div>
            <div class="diamond-harga">Rp. 3.400</div>
          </div>

          <div class="item-diamond" data-value="5300" data-jumlah="19" onclick="pilihDiamond(this)">
            <div class="diamond-icon">💎💎</div>
            <div class="diamond-jumlah">19 Diamonds</div>
            <div class="diamond-harga">Rp. 5.300</div>
          </div>

          <div class="item-diamond" data-value="7800" data-jumlah="28" onclick="pilihDiamond(this)">
            <div class="diamond-icon">💎💎</div>
            <div class="diamond-jumlah">28 Diamonds</div>
            <div class="diamond-harga">Rp. 7.800</div>
          </div>

          <div class="item-diamond" data-value="11500" data-jumlah="44" onclick="pilihDiamond(this)">
            <div class="diamond-icon">💎💎</div>
            <div class="diamond-jumlah">44 Diamonds</div>
            <div class="diamond-harga">Rp. 11.500</div>
          </div>

          <div class="item-diamond" data-value="15500" data-jumlah="59" onclick="pilihDiamond(this)">
            <div class="diamond-icon">💎💎💎</div>
            <div class="diamond-jumlah">59 Diamonds</div>
            <div class="diamond-harga">Rp. 15.500</div>
          </div>

          <div class="item-diamond" data-value="21200" data-jumlah="85" onclick="pilihDiamond(this)">
            <div class="diamond-icon">💎💎💎</div>
            <div class="diamond-jumlah">85 Diamonds</div>
            <div class="diamond-harga">Rp. 21.200</div>
          </div>

          <div class="item-diamond" data-value="44000" data-jumlah="170" onclick="pilihDiamond(this)">
            <div class="diamond-icon">💎💎💎</div>
            <div class="diamond-jumlah">170 Diamonds</div>
            <div class="diamond-harga">Rp. 44.000</div>
          </div>

          <div class="item-diamond" data-value="62000" data-jumlah="240" onclick="pilihDiamond(this)">
            <div class="diamond-icon">💎💎💎</div>
            <div class="diamond-jumlah">240 Diamonds</div>
            <div class="diamond-harga">Rp. 62.000</div>
          </div>

          <div class="item-diamond" data-value="76000" data-jumlah="296" onclick="pilihDiamond(this)">
            <div class="diamond-icon">💎💎💎💎</div>
            <div class="diamond-jumlah">296 Diamonds</div>
            <div class="diamond-harga">Rp. 76.000</div>
          </div>

          <div class="item-diamond" data-value="104500" data-jumlah="408" onclick="pilihDiamond(this)">
            <div class="diamond-icon">💎💎💎💎</div>
            <div class="diamond-jumlah">408 Diamonds</div>
            <div class="diamond-harga">Rp. 104.500</div>
          </div>

          <div class="item-diamond" data-value="142500" data-jumlah="568" onclick="pilihDiamond(this)">
            <div class="diamond-icon">💎💎💎💎</div>
            <div class="diamond-jumlah">568 Diamonds</div>
            <div class="diamond-harga">Rp. 142.500</div>
          </div>

          <div class="item-diamond" data-value="218500" data-jumlah="975" onclick="pilihDiamond(this)">
            <div class="diamond-icon">💎💎💎💎💎</div>
            <div class="diamond-jumlah">975 Diamonds</div>
            <div class="diamond-harga">Rp. 218.500</div>
          </div>

          <div class="item-diamond item-diamond-besar" data-value="475000" data-jumlah="2010" onclick="pilihDiamond(this)">
            <div class="diamond-icon">💎💎💎💎💎</div>
            <div class="diamond-jumlah">2010 Diamonds</div>
            <div class="diamond-harga">Rp. 475.000</div>
          </div>

          <div class="item-diamond item-diamond-besar" data-value="1140000" data-jumlah="4830" onclick="pilihDiamond(this)">
            <div class="diamond-icon">💎💎💎💎💎💎</div>
            <div class="diamond-jumlah">4830 Diamonds</div>
            <div class="diamond-harga">Rp. 1.140.000</div>
          </div>

        </div>
      </div>

      <!-- SECTION: METODE PEMBAYARAN -->
      <div class="kartu" id="section-payment">
        <div class="kartu-judul">Metode Pembayaran</div>
        <div class="grid-payment">

          <!-- Setiap metode bayar bisa diklik -->
          <div class="item-payment" data-payment="QRIS" onclick="pilihPayment(this)">
            <div class="payment-icon">⬛</div>
            <div class="payment-nama">QRIS</div>
          </div>

          <div class="item-payment" data-payment="ShopeePay" onclick="pilihPayment(this)">
            <div class="payment-icon">🛍️</div>
            <div class="payment-nama">ShopeePay</div>
          </div>

          <div class="item-payment" data-payment="GoPay" onclick="pilihPayment(this)">
            <div class="payment-icon">🟢</div>
            <div class="payment-nama">GoPay</div>
          </div>

          <div class="item-payment" data-payment="Dana" onclick="pilihPayment(this)">
            <div class="payment-icon">🔵</div>
            <div class="payment-nama">Dana</div>
          </div>

          <div class="item-payment" data-payment="OVO" onclick="pilihPayment(this)">
            <div class="payment-icon">🟣</div>
            <div class="payment-nama">OVO</div>
          </div>

        </div>
      </div>

      <!-- SECTION: EMAIL + INVOICE (satu baris) -->
      <div class="baris-email-invoice">

        <!-- Email (kiri) -->
        <div class="kartu kartu-email">
          <div class="kartu-judul">E-mail</div>
          <p class="email-deskripsi">
            Opsional. Jika anda ingin mendapatkan bukti pembayaran atas
            pembelian anda, harap mengisi alamat emailnya
          </p>
          <input type="email" id="email" placeholder="Masukkan e-mail...">
        </div>

        <!-- Invoice (kanan) -->
        <div class="kartu kartu-invoice">
          <div class="kartu-judul">Invoice</div>
          <div class="invoice-baris">
            <span class="invoice-label">ID:</span>
            <span class="invoice-nilai" id="inv-id">------[...]</span>
          </div>
          <div class="invoice-baris">
            <span class="invoice-label">Diamond:</span>
            <span class="invoice-nilai" id="inv-diamond">...... Diamonds (Rp. ...)</span>
          </div>
          <div class="invoice-baris">
            <span class="invoice-label">Payment:</span>
            <span class="invoice-nilai" id="inv-payment">------</span>
          </div>
          <!-- Tombol beli -->
          <button class="tombol-beli" onclick="beliSekarang()">BELI SEKARANG !</button>
        </div>

      </div>

    </main>

    <!-- ===== FOOTER ===== -->
    <footer class="footer">
      <div class="footer-konten">

        <!-- Kiri: logo + deskripsi -->
        <div class="footer-kiri">
          <div class="footer-logo">
            <div class="logo-bulat">🎮</div>
            <span class="footer-nama">JAJANINGIM</span>
          </div>
          <p class="footer-deskripsi">
            Setiap bulannya, jutaan gamer memilih JAJANINGIM
            untuk membeli kredit game favorit mereka dengan
            mudah, cepat, dan aman. Tanpa ribet registrasi, saldo
            akan langsung masuk ke akunmu, siap dimainkan!
          </p>
          <!-- Fitur-fitur -->
          <div class="footer-fitur">
            <div class="fitur-item">
              <span class="fitur-icon">⚡</span>
              <div>
                <strong>Bayar dalam Hitungan Detik</strong>
                <p>Transaksi cepat tanpa hambatan! transfer bank, kartu debit, saldo game langsung terverifikasi di akunmu.</p>
              </div>
            </div>
            <div class="fitur-item">
              <span class="fitur-icon">💳</span>
              <div>
                <strong>Metode Pembayaran Terlengkap</strong>
                <p>Bayar dengan pulsa, e-wallet, transfer bank, atau minimarket terdekat. Pilihan sangat untuk kemudahanmu.</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Tengah: lebih banyak fitur -->
        <div class="footer-tengah">
          <div class="fitur-item">
            <span class="fitur-icon">🎁</span>
            <div>
              <strong>Promosi & Program Reward Menarik</strong>
              <p>Dapatkan diskon eksklusif, kode promo, dan hadiah setiap hari top-up, dengan bergabung program referral untuk bonus tambahan!</p>
            </div>
          </div>
          <div class="fitur-item">
            <span class="fitur-icon">🎁</span>
            <div>
              <strong>Promosi & Program Reward Menarik</strong>
              <p>Dapatkan diskon eksklusif, kode promo, dan hadiah setiap hari top-up, dengan bergabung program referral untuk bonus tambahan!</p>
            </div>
          </div>
        </div>

        <!-- Kanan: Find Us -->
        <div class="footer-kanan">
          <strong>Find Us</strong>
          <p>More about Us :</p>
          <div class="sosmed">📷 📘 ▶</div>
          <div class="footer-links">
            <a href="#">ABOUT US</a>
            <a href="#">CONTACT US</a>
          </div>
        </div>

      </div>
      <div class="footer-bawah">©Hak Cipta Jajaningim Corp</div>
    </footer>

  </div><!-- end halaman-utama -->


  <!-- ============================================================
    HALAMAN 2: MENUNGGU PEMBAYARAN (tersembunyi, muncul setelah beli)
  ============================================================ -->
  <div id="halaman-loading" class="tersembunyi">

    <!-- Navbar sama -->
    <header class="navbar">
      <div class="navbar-logo">
        <div class="logo-bulat">🎮</div>
        <span class="logo-teks">JajaninGim</span>
      </div>
      <div class="navbar-judul">JajaninGim.site</div>
      <div class="navbar-kanan">
        <input class="navbar-search" type="text" placeholder="Find Games...">
        <button class="tombol-login">Login / Register</button>
      </div>
    </header>

    <main class="konten-tengah">
      <!-- Tombol Kembali -->
      <button class="tombol-kembali" onclick="kembaliKeUtama()">← Back</button>

      <!-- Animasi jam / loading -->
      <div class="lingkaran-status">
        <div class="jam-icon">🕐</div>
      </div>

      <!-- Teks status -->
      <button class="tombol-status-abu">Menunggu Pembayaran...</button>
      <p class="teks-info">
        Kamu akan diarahkan ke pembayaran dalam 3 detik..<br>
        Verifikasi pembayaran akan dilakukan otomatis oleh sistem<br>
        Jika tidak dapat diarahkan otomatis, <a href="#" class="link-biru">klik disini</a>
      </p>

      <!-- Countdown otomatis -->
      <div class="countdown" id="countdown-angka">3</div>
    </main>

    <!-- Footer sama -->
    <footer class="footer">
      <div class="footer-konten">
        <div class="footer-kiri">
          <div class="footer-logo">
            <div class="logo-bulat">🎮</div>
            <span class="footer-nama">JAJANINGIM</span>
          </div>
          <p class="footer-deskripsi">
            Setiap bulannya, jutaan gamer memilih JAJANINGIM untuk membeli kredit game favorit mereka dengan mudah, cepat, dan aman.
          </p>
        </div>
        <div class="footer-kanan">
          <strong>Find Us</strong>
          <div class="footer-links">
            <a href="#">ABOUT US</a>
            <a href="#">CONTACT US</a>
          </div>
        </div>
      </div>
      <div class="footer-bawah">©Hak Cipta Jajaningim Corp</div>
    </footer>

  </div><!-- end halaman-loading -->


  <!-- ============================================================
    HALAMAN 3: PEMBAYARAN BERHASIL (tersembunyi)
  ============================================================ -->
  <div id="halaman-sukses" class="tersembunyi">

    <!-- Navbar sama -->
    <header class="navbar">
      <div class="navbar-logo">
        <div class="logo-bulat">🎮</div>
        <span class="logo-teks">JajaninGim</span>
      </div>
      <div class="navbar-judul">JajaninGim.site</div>
      <div class="navbar-kanan">
        <input class="navbar-search" type="text" placeholder="Find Games...">
        <button class="tombol-login">Login / Register</button>
      </div>
    </header>

    <main class="konten-tengah">
      <!-- Tombol Next -->
      <button class="tombol-next" onclick="kembaliKeUtama()">Next →</button>

      <!-- Centang hijau -->
      <div class="lingkaran-status lingkaran-hijau">
        <div class="centang-icon">✓</div>
      </div>

      <!-- Teks berhasil -->
      <button class="tombol-status-hijau">Pembayaran-mu Berhasil !</button>
      <p class="teks-info">
        Apabila Diamond belum diterima atau mengalami kendala lainnya, Harap Hubungi Kami dibawah..<br>
        Terima Kasih telah memilih JajaninGim 🎮🎯
      </p>
    </main>

    <!-- Footer sama -->
    <footer class="footer">
      <div class="footer-brand">
        <div class="brand-row">
          <img src="/assets/logo_jajaningim/logo.png" alt="JajaninGim Logo">
          <h3>JAJANINGIM</h3>
        </div>
        <p>
          Setiap bulannya, jutaan gamer memilih JAJANINGIM untuk membeli kredit
          game favorit mereka dengan mudah, cepat, dan aman. Tanpa perlu
          registrasi, saldo akan langsung masuk ke akunmu, siap dimainkan!
        </p>
      </div>

      <div class="footer-line"></div>

      <div class="footer-find">
        <h3>Find Us</h3>
        <p>More about Us :</p>
        <div class="socials">
          <span>◎</span>
          <span>f</span>
          <span>▻</span>
        </div>
      </div>

      <div class="footer-links">
        <a href="/?url=about">ABOUT US</a>
        <a href="#">CONTACT US</a>
      </div>
    </footer>


  </div><!-- end halaman-sukses -->


  <!-- ===== JAVASCRIPT ===== -->
  <script>

    /* ==================================================
       VARIABEL GLOBAL
       Menyimpan pilihan user
    ================================================== */
    let diamondDipilih = null;   // Menyimpan elemen diamond yang diklik
    let paymentDipilih = null;   // Menyimpan elemen payment yang diklik


    /* ==================================================
       FUNGSI: Pilih Diamond
       Dipanggil saat user klik salah satu item diamond
    ================================================== */
    function pilihDiamond(elemen) {
      // Hapus style "terpilih" dari semua diamond
      document.querySelectorAll('.item-diamond').forEach(function(item) {
        item.classList.remove('terpilih');
      });

      // Tambahkan style "terpilih" ke yang diklik
      elemen.classList.add('terpilih');
      diamondDipilih = elemen;

      // Update invoice
      updateInvoice();
    }


    /* ==================================================
       FUNGSI: Pilih Payment
       Dipanggil saat user klik salah satu metode bayar
    ================================================== */
    function pilihPayment(elemen) {
      // Hapus style "terpilih" dari semua payment
      document.querySelectorAll('.item-payment').forEach(function(item) {
        item.classList.remove('terpilih');
      });

      // Tambahkan style "terpilih" ke yang diklik
      elemen.classList.add('terpilih');
      paymentDipilih = elemen;

      // Update invoice
      updateInvoice();
    }


    /* ==================================================
       FUNGSI: Update Invoice
       Memperbarui tampilan invoice setiap ada perubahan
    ================================================== */
    function updateInvoice() {
      var userId = document.getElementById('userId').value;
      var serverId = document.getElementById('serverId').value;

      // Update ID di invoice
      if (userId) {
        var idTampil = userId;
        if (serverId) idTampil += ' (' + serverId + ')';
        document.getElementById('inv-id').textContent = idTampil;
      }

      // Update Diamond di invoice
      if (diamondDipilih) {
        var jumlah = diamondDipilih.getAttribute('data-jumlah');
        var harga = diamondDipilih.getAttribute('data-value');
        var hargaFormatted = 'Rp. ' + parseInt(harga).toLocaleString('id-ID');
        document.getElementById('inv-diamond').textContent = jumlah + ' Diamonds (' + hargaFormatted + ')';
      }

      // Update Payment di invoice
      if (paymentDipilih) {
        var namaPayment = paymentDipilih.getAttribute('data-payment');
        document.getElementById('inv-payment').textContent = namaPayment;
      }
    }


    /* ==================================================
       FUNGSI: Beli Sekarang
       Validasi lalu pindah ke halaman loading
    ================================================== */
    function beliSekarang() {
      var userId = document.getElementById('userId').value;
      var serverId = document.getElementById('serverId').value;

      // Cek apakah semua sudah diisi
      if (!userId || !serverId) {
        alert('Harap isi ID dan Server terlebih dahulu!');
        return;
      }
      if (!diamondDipilih) {
        alert('Harap pilih jumlah Diamond!');
        return;
      }
      if (!paymentDipilih) {
        alert('Harap pilih metode pembayaran!');
        return;
      }

      // Semua sudah diisi, pindah ke halaman loading
      pindahHalaman('halaman-loading');

      // Mulai countdown 3 detik
      startCountdown();
    }


    /* ==================================================
       FUNGSI: Countdown Pembayaran
       Hitung mundur 3 detik lalu pindah ke halaman sukses
    ================================================== */
    function startCountdown() {
      var angka = 3;
      var elCountdown = document.getElementById('countdown-angka');

      // Jalankan setiap 1 detik
      var timer = setInterval(function() {
        angka--;
        if (elCountdown) elCountdown.textContent = angka;

        if (angka <= 0) {
          clearInterval(timer);         // Stop timer
          pindahHalaman('halaman-sukses'); // Pindah ke sukses
        }
      }, 1000);
    }


    /* ==================================================
       FUNGSI: Pindah Halaman
       Sembunyikan semua halaman, tampilkan yang dipilih
    ================================================== */
    function pindahHalaman(idHalaman) {
      // Sembunyikan semua halaman
      document.getElementById('halaman-utama').classList.add('tersembunyi');
      document.getElementById('halaman-loading').classList.add('tersembunyi');
      document.getElementById('halaman-sukses').classList.add('tersembunyi');

      // Tampilkan halaman yang dipilih
      document.getElementById(idHalaman).classList.remove('tersembunyi');

      // Scroll ke atas
      window.scrollTo(0, 0);
    }


    /* ==================================================
       FUNGSI: Kembali ke Halaman Utama
    ================================================== */
    function kembaliKeUtama() {
      pindahHalaman('halaman-utama');
    }


    /* ==================================================
       UPDATE INVOICE saat user mengetik ID
    ================================================== */
    document.getElementById('userId').addEventListener('input', updateInvoice);
    document.getElementById('serverId').addEventListener('input', updateInvoice);

  </script>


  

</body>
</html>
