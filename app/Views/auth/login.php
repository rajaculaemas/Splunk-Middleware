<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Middleware Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        :root {
            --background-color: #001f3d; /* Warna latar belakang default */
            /* Ganti URL di bawah dengan path gambar latar belakang yang diinginkan */
            --background-image: url('/images/mbappe.jpg'); /* Gambar hanya di kiri dan kanan */
        }

        /* Bagian body */
        body {
            transform: scale(1); /* Zoom out ke 80% */
            transform-origin: 0 0;
            margin: 0;
            padding: 0;
            height: 100vh; /* Pastikan tinggi halaman memenuhi layar */
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: var(--background-color);
            color: white;
        }

        /* Gambar di sisi kiri dan kanan */
        .background-side {
            position: absolute;
            top: 0;
            bottom: 0;
            width: 35%; /* Lebar gambar di sisi kiri dan kanan */
            background-image: var(--background-image);
            background-repeat: repeat-y; /* Gambar hanya diulang secara vertikal */
            background-size: auto; /* Jangan merubah ukuran gambar */
            background-position: center top; /* Posisi gambar agar tetap terjaga */
        }

        /* Gambar pada sisi kiri */
        .background-left {
            left: 0;
        }

        /* Gambar pada sisi kanan */
        .background-right {
            right: 0;
        }

        /* Form login */
        .form-container {
            margin-top: 10%;
            border: 4px midnightblue; /* Border kuning lebih tebal */
            padding: 40px 50px; /* Padding lebih besar untuk memperbesar kotak */
            border-radius: 15px; /* Sudut border lebih melengkung */
            display: inline-block; /* Agar kontainer menyesuaikan dengan ukuran teks */
            width: auto; /* Membuat kontainer tidak terikat lebar tetap */
            box-sizing: border-box; /* Menyertakan padding dalam perhitungan lebar kontainer */
        }

        .form-container h1 {
            display: inline-block; /* Membuat teks tetap dalam satu baris */
            white-space: nowrap; /* Mencegah teks dibungkus ke baris berikutnya */
            margin-bottom: 20px; /* Jarak antara judul dan form */
            padding: 10px 15px; /* Memberikan sedikit ruang antara teks dan border */
        }

        .margin-top {
            margin-top: 40px;
        }

    </style>
</head>
<body>

    <!-- Gambar sisi kiri -->
    <div class="background-side background-left"></div>

    <!-- Gambar sisi kanan -->
    <div class="background-side background-right"></div>

    <!-- Kontainer form login -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 form-container">
                <h1 class="text-center">Splunk Middleware</h1>
                <h5 class="text-center mt-5">Login Untuk Melanjutkan</h5>
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>
                <form action="<?= site_url('/middleware/login') ?>" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
                <div class="text-center mt-3">
                    <a href="<?= site_url('/middleware/register') ?>" class="text-light">Belum punya akun? Register</a> <br></br>
                    <br>Lupa password? kontak admin ga ada halaman reset!!</br>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
