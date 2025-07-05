document.addEventListener("DOMContentLoaded", function () {
    const menuSelect = document.getElementById("menuSelect");
    const jumlahInput = document.getElementById("jumlah");
    const totalHargaEl = document.getElementById("totalHarga");
    const previewImg = document.getElementById("previewImg");
    const previewText = document.getElementById("previewText");

    // Ambil base URL dari tag body
    const baseURL = document.body.getAttribute('data-baseurl') || '';

    // Data menu lengkap
    const menuData = {
        latte: {
            harga: 25000,
            gambar: baseURL + "assets/img/latte.jpg",
            deskripsi: "Latte Senja – Pilihan sempurna untuk menikmati suasana senja."
        },
        kopilembayung: {
            harga: 20000,
            gambar: baseURL + "assets/img/es-kopi.jpg",
            deskripsi: "Kopi Lembayung – Teman larut malam yang mendalam dan hangat."
        },
        tehpeach: {
            harga: 15000,
            gambar: baseURL + "assets/img/teh-peach.jpg",
            deskripsi: "Teh Peach – Sensasi manis dan segar yang menenangkan."
        }
    };

    // Fungsi update total & preview
    function updateOrder() {
        const selected = menuSelect.value;
        const jumlah = parseInt(jumlahInput.value) || 1;
        const data = menuData[selected];

        if (data) {
            const total = data.harga * jumlah;
            totalHargaEl.textContent = "Rp" + total.toLocaleString("id-ID");
            previewImg.src = data.gambar;
            previewText.textContent = data.deskripsi;
        }
    }

    // Inisialisasi awal
    updateOrder();
    menuSelect.addEventListener("change", updateOrder);
    jumlahInput.addEventListener("input", updateOrder);
});

// Fungsi cetak struk (harus di luar DOMContentLoaded agar bisa dipanggil onclick)
function printReceipt() {
    const selectedMenu = document.getElementById("menuSelect");
    const size = document.getElementById("size");
    const jumlah = document.getElementById("jumlah");
    const total = document.getElementById("totalHarga");
    const payment = document.getElementById("payment");
    const catatan = document.getElementById("catatan");

    // Isi struk
    document.getElementById("r_menu").textContent = selectedMenu.options[selectedMenu.selectedIndex].text;
    document.getElementById("r_size").textContent = size.value;
    document.getElementById("r_jumlah").textContent = jumlah.value;
    document.getElementById("r_total").textContent = total.textContent;
    document.getElementById("r_payment").textContent = payment.value;
    document.getElementById("r_catatan").textContent = catatan.value || "-";

    // Tanggal
    const now = new Date();
    document.getElementById("receiptDate").textContent = now.toLocaleString('id-ID');

    // Cetak
    const printContents = document.getElementById("receiptContent").innerHTML;
    const originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
    location.reload(); // supaya tidak hilang JS-nya
}

document.addEventListener("DOMContentLoaded", function () {
    // ... (kode sebelumnya)

    const form = document.querySelector('.order-form');

    form.addEventListener('submit', function (e) {
        const jumlah = parseInt(jumlahInput.value);
        const menu = menuSelect.value;
        const payment = document.getElementById("payment").value;

        // Validasi jumlah
        if (!jumlah || jumlah < 1) {
            alert("Jumlah harus lebih dari 0.");
            e.preventDefault();
            return;
        }

        // Validasi menu
        if (!menu || !menuData[menu]) {
            alert("Silakan pilih menu yang valid.");
            e.preventDefault();
            return;
        }

        // Validasi metode pembayaran
        if (!payment) {
            alert("Silakan pilih metode pembayaran.");
            e.preventDefault();
            return;
        }
    });
});
