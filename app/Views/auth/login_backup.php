<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Middleware Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        body {
            transform: scale(0.8); /* Zoom out ke 80% */
            background-color: #001f3d;
            color: white;
        }
        .form-container {
            margin-top: 10%;
            border: 4px solid white; /* Border kuning lebih tebal */
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
                    <a href="<?= site_url('/middleware/register') ?>" class="text-light">Belum punya akun? Register</a>
                </div>

        </div>
    </div>
</body>
</html>
