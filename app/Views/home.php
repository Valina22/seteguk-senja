<!-- app/Views/home.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Seteguk Senja Coffee Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>
<body data-baseurl="<?= base_url() ?>">
<header>
    <h1>Seteguk Senja Coffee Shop</h1>
    <nav>
        <a href="#home">Home</a>
        <a href="#menu">Menu</a>
        <a href="#order">Order</a>
        <a href="#gallery">Gallery</a>
        <a href="#about">About Us</a>
        <a href="#contact">Contact</a>
    </nav>
</header>

<!-- Bagian Hero -->
<section id="home" class="hero">
    <div class="overlay"></div>
    <div class="hero-text">
        <p class="hero-title">Hangatnya Setiap Tegukan di Balik Lembayung Senja</p>
        <p class="hero-subtitle">Temui rasa yang menyatu dengan suasana. Nikmati secangkir kehangatan dari Seteguk Senja.</p>
        <a href="#order" class="cta-btn">Pesan Sekarang</a>
    </div>
</section>

<!-- Lanjutan dari bagian Hero -->

<!-- Menu Section -->
<section id="menu" class="section">
    <h2>Menu</h2>
    <div class="menu">
        <div class="menu-item">
            <img src="<?= base_url('assets/img/latte.jpg') ?>" alt="Latte Senja">
            <h3>Latte Senja</h3>
            <p>Rp25.000</p>
        </div>
        <div class="menu-item">
            <img src="<?= base_url('assets/img/es-kopi.jpg') ?>" alt="Es Kopi Lembayung">
            <h3>Es Kopi Lembayung</h3>
            <p>Rp20.000</p>
        </div>
        <div class="menu-item">
            <img src="<?= base_url('assets/img/teh-peach.jpg') ?>" alt="Teh Peach">
            <h3>Teh Peach</h3>
            <p>Rp15.000</p>
        </div>
    </div>
</section>

<!-- Bagian Order Section -->
<section id="order" class="section">
    <h2>Order Online</h2> <!-- Dipindah ke sini, sejajar dengan section lainnya -->

    <div class="order-section" style="display: flex; flex-wrap: wrap; gap: 40px;">
    <!-- FORM PESAN -->
    <form class="order-form" action="<?= base_url('order/process') ?>" method="post" style="flex: 1 1 50%; max-width: 500px;">

        <label for="menuSelect">Pilih Menu:</label>
        <select name="menu" id="menuSelect">
            <option value="latte">Latte Senja - Rp25.000</option>
            <option value="kopilembayung">Kopi Lembayung - Rp20.000</option>
            <option value="tehpeach">Teh Peach - Rp15.000</option>
        </select>

        <label for="size">Ukuran:</label>
        <select name="size" id="size">
            <option value="small">Kecil</option>
            <option value="medium">Sedang</option>
            <option value="large">Besar</option>
        </select>

        <label for="jumlah">Jumlah:</label>
        <input type="number" name="jumlah" id="jumlah" value="1" min="1">

        <p><strong>Total Harga:</strong></p>
        <p class="total-harga" id="totalHarga">Rp25.000</p>

        <label for="payment">Metode Pembayaran:</label>
        <select name="payment" id="payment">
            <option value="cash">Cash</option>
            <option value="qris">QRIS</option>
            <option value="shopeepay">ShopeePay</option>
        </select>

        <label for="catatan">Catatan Khusus:</label>
        <textarea name="catatan" id="catatan" placeholder="Masukkan catatan khusus"></textarea>
        <label for="email">Email:</label>
<input type="email" name="email" id="email" required>

        <button type="submit" class="cta-btn">Pesan Sekarang</button>
    </form>

    <!-- PREVIEW -->
    <div class="order-preview" style="flex: 1 1 40%; text-align: center;">
        <img id="previewImg" src="<?= base_url('assets/img/latte.jpg') ?>" alt="Selected Drink" style="width: 100%; max-width: 300px; border-radius: 12px;">
        <p id="previewText" style="margin-top: 10px;">Latte Senja – Pilihan sempurna untuk menikmati suasana senja.</p>
        <button type="button" onclick="printReceipt()" style="margin-top: 10px;">Cetak Struk</button>
    </div>
</section>

<!-- Gallery Section -->
<section id="gallery" class="section">
    <h2>Gallery</h2>
    <div class="menu">
        <div class="menu-item">
            <img src="<?= base_url('assets/img/interior 1.jpg') ?>" alt="Interior 1">
            <p>Interior Hangat</p>
        </div>
        <div class="menu-item">
            <img src="<?= base_url('assets/img/interior 2.jpg') ?>" alt="Interior 2">
            <p>Nuansa Senja</p>
        </div>
        <div class="menu-item">
            <img src="<?= base_url('assets/img/barista.jpg') ?>" alt="Barista">
            <p>Tim Barista Kami</p>
        </div>
    </div>
</section>

<!-- About Section -->
<section id="about" class="about-section">
    <h2 class="section-title">About Us</h2>
    <div class="about-container">
        <div class="about-text">
            <p><strong>Seteguk Senja</strong> berdiri dengan satu tujuan sederhana: menghadirkan pengalaman yang hangat dan romantis dalam setiap tegukan kopi Anda. Kami percaya bahwa setiap minuman memiliki cerita, dan kami ada di sini untuk menyajikan cerita terbaik yang melibatkan Anda dalam setiap momen.</p>

            <p>Misi kami adalah memberikan kenyamanan melalui setiap cita rasa yang disajikan, serta menciptakan suasana yang memungkinkan Anda menikmati waktu santai bersama teman, keluarga, atau diri sendiri. Kami mengutamakan kualitas bahan, kenyamanan tempat, dan pelayanan yang ramah untuk menjadikan setiap kunjungan Anda sebagai kenangan yang tak terlupakan.</p>

            <p>Kami berharap, di <strong>Seteguk Senja</strong>, setiap tegukan kopi Anda membawa kehangatan yang sama seperti saat matahari terbenam di balik horizon. Ini adalah tempat di mana rasa dan suasana berpadu untuk menciptakan kenangan yang indah.</p>
        </div>
        <div class="about-image">
            <img src="<?= base_url('assets/img/interior-kedai.jpg') ?>" alt="Interior Kedai Seteguk Senja">
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="section">
    <h2>Contact Us</h2>
    <form>
        <label for="name">Nama:</label>
        <input type="text" id="name" name="name" required>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <label for="message">Pesan:</label>
        <textarea id="message" name="message"></textarea>
        <button type="submit">Kirim</button>
    </form>
    <p>Lokasi: <a href="https://maps.app.goo.gl/iBgY8ysNQiQXEmai9" target="_blank">Lihat di Google Maps</a></p>
    <p>Email: contact@seteguksenja.com | WhatsApp: 0831-8892-2755</p>
</section>

<!-- Footer -->
<footer class="footer">
    &copy; 2025 Seteguk Senja Coffee Shop. All Rights Reserved.
</footer>
<!-- Bagian lainnya seperti Menu, Order, Gallery, About Us, Contact -->
<!-- Silakan load dari partial view atau tempel langsung di sini -->
 <div id="receiptContent" style="display: none;">
    <h2>Seteguk Senja Coffee Shop</h2>
    <p id="receiptDate"></p>
    <hr>
    <p><strong>Menu:</strong> <span id="r_menu"></span></p>
    <p><strong>Ukuran:</strong> <span id="r_size"></span></p>
    <p><strong>Jumlah:</strong> <span id="r_jumlah"></span></p>
    <p><strong>Total Harga:</strong> <span id="r_total"></span></p>
    <p><strong>Pembayaran:</strong> <span id="r_payment"></span></p>
    <p><strong>Catatan:</strong> <span id="r_catatan"></span></p>
</div>

<!-- JS -->
<script src="<?= base_url('assets/js/script.js') ?>"></script>
</body>
</html>
