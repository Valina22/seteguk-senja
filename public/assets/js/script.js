document.addEventListener("DOMContentLoaded", function () {
    const menuSelect = document.getElementById("menuSelect");
    const jumlahInput = document.getElementById("jumlah");
    const totalHargaEl = document.getElementById("totalHarga");
    const previewImg = document.getElementById("previewImg");
    const previewText = document.getElementById("previewText");
    const sizeInput = document.getElementById("size");

    const baseURL = document.body.getAttribute('data-baseurl') || '';

    const menuData = {
        latte: {
            harga: 25000,
            gambar: baseURL + "assets/img/latte.jpg",
            deskripsi: "Latte Senja – Perpaduan espresso dan susu hangat yang creamy, seperti pelukan hangat di tengah suasana senja."
        },
        lembayung: {
            harga: 20000,
            gambar: baseURL + "assets/img/es-kopi.jpg",
            deskripsi: "Kopi Lembayung – Kopi susu dingin dengan sentuhan moka yang lembut, mencerminkan keindahan langit senja yang bergradasi."
        },
        cappuccino: {
            harga: 28000,
            gambar: baseURL + "assets/img/Cappuccino Mega Jingga.jpg",
            deskripsi: "Cappuccino Mega Jingga – Cappuccino creamy dengan taburan kayu manis, semanis langit sore."
        },
        kopihitam: {
            harga: 18000,
            gambar: baseURL + "assets/img/Kopi Hitam Langit Petang.jpg",
            deskripsi: "Kopi Hitam Langit Petang – Kopi tubruk tanpa gula, pekat seperti langit menjelang malam."
        },
        awantemaram: {
            harga: 23000,
            gambar: baseURL + "assets/img/Es Kopi Awan Temaram.jpg",
            deskripsi: "Es Kopi Awan Temaram – Es kopi susu dengan hint karamel, manis lembut seperti awan menjelang malam."
        },
        aren: {
            harga: 24000,
            gambar: baseURL + "assets/img/Kopi Aren Rintik Senja.jpg",
            deskripsi: "Kopi Aren Rintik Senja – Espresso + susu + gula aren dengan aroma smoky yang khas."
        },
        redvelvet: {
            harga: 26000,
            gambar: baseURL + "assets/img/Red Velvet Mentari Padam.jpg",
            deskripsi: "Red Velvet Mentari Padam – Red velvet latte yang hangat, dengan warna secantik mentari yang tenggelam."
        },
        matcha: {
            harga: 27000,
            gambar: baseURL + "assets/img/Matcha Fajar Merona.jpg",
            deskripsi: "Matcha Fajar Merona – Matcha latte creamy, di-blend dingin seperti udara fajar."
        },
        coklat: {
            harga: 24000,
            gambar: baseURL + "assets/img/Coklat Hangat Cahaya Senja.jpg",
            deskripsi: "Coklat Hangat Cahaya Senja – Hot chocolate dengan sentuhan marshmallow & kayu manis."
        },
        taro: {
            harga: 25000,
            gambar: baseURL + "assets/img/Taro Malam Berbintang.jpg",
            deskripsi: "Taro Malam Berbintang – Taro latte ungu lembut dengan topping boba hitam."
        },
        cookiescream: {
            harga: 26000,
            gambar: baseURL + "assets/img/Cookies & Cream Awan Sore.jpg",
            deskripsi: "Cookies & Cream Awan Sore – Perpaduan krim lembut, susu segar, dan remahan cookies cokelat."
        },
        butterflypea: {
            harga: 17000,
            gambar: baseURL + "assets/img/Butterfly Pea Dusk.jpg",
            deskripsi: "Butterfly Pea Dusk – Teh bunga telang menyegarkan untuk sore santai."
        },
        tehpeach: {
            harga: 15000,
            gambar: baseURL + "assets/img/teh-peach.jpg",
            deskripsi: "Teh Peach – Sensasi manis dan segar yang menenangkan."
        },
        tehberry: {
            harga: 22000,
            gambar: baseURL + "assets/img/Teh Berry Pelangi.jpg",
            deskripsi: "Teh Berry Pelangi – Cold tea blend strawberry, blueberry, dan lemon."
        },
        lemonade: {
            harga: 22000,
            gambar: baseURL + "assets/img/Lemonade Cahaya Purnama.jpg",
            deskripsi: "Lemonade Cahaya Purnama – Lemon soda dengan sirup lavender, segar dan menyegarkan."
        },
        yakult: {
            harga: 24000,
            gambar: baseURL + "assets/img/Sunset Yakult Splash.jpg",
            deskripsi: "Sunset Yakult Splash – Yakult + jeruk + soda + sirup leci, cantik bergradasi seperti langit senja."
        },
        mangga: {
            harga: 23000,
            gambar: baseURL + "assets/img/Mangga Senja Tropis.jpg",
            deskripsi: "Mangga Senja Tropis – Jus mangga segar berpadu dengan susu dan es batu."
        },
        lychee: {
            harga: 18000,
            gambar: baseURL + "assets/img/Lychee Tea Mentari.jpg",
            deskripsi: "Lychee Tea Mentari – Teh lychee manis segar seperti mentari pagi."
        },
        waffle: {
            harga: 28000,
            gambar: baseURL + "assets/img/Banana Waffle Senja.jpg",
            deskripsi: "Banana Waffle Senja – Waffle hangat dengan topping pisang karamel dan es krim vanilla."
        },
        rotipanggang: {
            harga: 18000,
            gambar: baseURL + "assets/img/Roti Panggang Selimut Awan.jpg",
            deskripsi: "Roti Panggang Selimut Awan – Roti bakar isi coklat-keju, disajikan dengan taburan gula halus."
        },
        croissant: {
            harga: 22000,
            gambar: baseURL + "assets/img/Croissant Peluk Fajar.jpg",
            deskripsi: "Croissant Peluk Fajar – Croissant isi almond cream atau custard."
        },
        cinnamon: {
            harga: 20000,
            gambar: baseURL + "assets/img/Cinnamon Roll Pelipur Lara.jpg",
            deskripsi: "Cinnamon Roll Pelipur Lara – Soft roll manis, aroma kayu manisnya bikin betah duduk lama."
        },
        donat: {
            harga: 19000,
            gambar: baseURL + "assets/img/Donat Kopi Rembulan.jpg",
            deskripsi: "Donat Kopi Rembulan – Donat kopi dengan topping gula halus dan hint moka."
        },
        platter: {
            harga: 25000,
            gambar: baseURL + "assets/img/Mix Platter Senja.jpg",
            deskripsi: "Mix Platter Senja – Paduan kentang, nugget, dan sosis, cocok buat teman ngobrol sore."
        }
    };

    function updateOrder() {
        const selected = menuSelect.value;
        const jumlah = parseInt(jumlahInput.value) || 1;
        const size = sizeInput.value;
        const data = menuData[selected];

        let harga = data ? data.harga : 0;
        if (size === "small") harga -= 3000;
        else if (size === "large") harga += 3000;

        if (data) {
            const total = harga * jumlah;
            totalHargaEl.textContent = "Rp" + total.toLocaleString("id-ID");
            previewImg.src = data.gambar;
            previewText.textContent = data.deskripsi;
        }
    }

    updateOrder();
    menuSelect.addEventListener("change", updateOrder);
    jumlahInput.addEventListener("input", updateOrder);
    sizeInput.addEventListener("change", updateOrder);

    const form = document.querySelector('.order-form');
    form.addEventListener('submit', function (e) {
        const jumlah = parseInt(jumlahInput.value);
        const menu = menuSelect.value;
        const payment = document.getElementById("payment").value;

        if (!jumlah || jumlah < 1) {
            alert("Jumlah harus lebih dari 0.");
            e.preventDefault();
            return;
        }

        if (!menu || !menuData[menu]) {
            alert("Silakan pilih menu yang valid.");
            e.preventDefault();
            return;
        }

        if (!payment) {
            alert("Silakan pilih metode pembayaran.");
            e.preventDefault();
            return;
        }
    });
});

function printReceipt() {
    const selectedMenu = document.getElementById("menuSelect");
    const size = document.getElementById("size");
    const jumlah = document.getElementById("jumlah");
    const total = document.getElementById("totalHarga");
    const payment = document.getElementById("payment");
    const catatan = document.getElementById("catatan");

    document.getElementById("r_menu").textContent = selectedMenu.options[selectedMenu.selectedIndex].text;
    document.getElementById("r_size").textContent = size.value;
    document.getElementById("r_jumlah").textContent = jumlah.value;
    document.getElementById("r_total").textContent = total.textContent;
    document.getElementById("r_payment").textContent = payment.value;
    document.getElementById("r_catatan").textContent = catatan.value || "-";

    const now = new Date();
    document.getElementById("receiptDate").textContent = now.toLocaleString('id-ID');

    const printContents = document.getElementById("receiptContent").innerHTML;
    const originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
    location.reload();
}
