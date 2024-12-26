<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload CSV</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #1a1c27;
            color: #fff;
        }

        .header-box {
            background-color: #000050; /* Warna biru terang */
            padding: 8px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            box-shadow: 0 2px 2px -2px black;
            height: 60px;
        }

        .header-box img {
            height: 40px; /* Ukuran logo */
            width: 200px;
        }

        .header-box .navbar-text {
            margin-left: 20px;
            color: #fff;
        }

        .header-box .btn {
            margin-right: 20px;
            background-color: #007bff; /* Atur warna biru sesuai keinginan */
            color: white;
            border: 0px;
        }

        .content-wrapper {
            padding-top: 80px; /* Memberikan ruang untuk header */
        }

        .container {
            margin-top: 100px; /* Memberikan ruang untuk header fixed */
        }

        /* Menata form dan tombol di sebelah kiri */
        .upload-form {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .upload-form .form-label, .upload-form .form-control, .upload-form .btn {
            width: 100%; /* Membuat elemen-elemen di bawah lebar penuh */
            max-width: 300px; /* Membatasi lebar elemen */
        }

        .upload-form .form-group {
            margin-bottom: 1rem;
        }

        #csv_file {
    width: 2000%;  /* Membuat input file mengambil lebar penuh dari elemen induknya */
    max-width: 1200px;  /* Anda dapat menyesuaikan lebar maksimal sesuai kebutuhan */
        }
    </style>
</head>
<body>
    <!-- Header with Logo -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="header-box">
            <!-- Logo -->
            <a href="/middleware">
            <img src="/images/logo2.PNG" alt="Logo">
        </a>
            <!-- Menampilkan nama pengguna jika sudah login -->
            <?php if (session()->get('isLoggedIn')): ?>
                <div>
                    <span class="navbar-text">
                        Welcome, <?= session()->get('username'); ?> <!-- Menampilkan nama pengguna dari session -->
                    </span>
                    <a href="<?= base_url('middleware/logout'); ?>" class="btn btn-danger ms-3">Logout</a> <!-- Tombol Logout -->   
                </div>
            <?php else: ?>
                <div>
                    <a href="<?= base_url('auth/login'); ?>" class="btn btn-success ms-3">Login</a> <!-- Tombol Login jika belum login -->
                </div>
            <?php endif; ?>
        </div>
    </nav>

    <!-- Content Section -->
    <div class="container">
        <h2>Upload Other Logs</h2>
        <form action="/logs/upload" method="post" enctype="multipart/form-data">
        <div class="upload-form">
            <div class="form-group">
                <label for="csv_file" class="form-label">Pilih file CSV, ngerti ga lu jan iya iya aja</label>
                <input type="file" class="form-control" id="csv_file" name="csv_file" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Upload</button>
            </div>
        </div>
    </div>

</body>
</html>
