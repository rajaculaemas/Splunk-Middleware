<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Source Types</title>
    <!-- Bootstrap CSS (via CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #000020; /* Biru tua */
            color: white;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Kotak Header Biru */
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
            height: 55px;
        }

        .header-box img {
            height: 40px; /* Ukuran logo */
            width: 200px;
        }

        .header-box .navbar-text {
            margin-left: 20px;
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

        .navbar {
            background-color: #000020; /* Biru tua */
            padding: 10px 20px;
        }

        .navbar .navbar-brand {
            margin-right: auto; /* Hapus margin kiri agar logo terletak di pojok kanan */
            display: flex;
            flex-direction: column;
            align-items: center; /* Menjaga logo dan teks sejajar secara vertikal */
            justify-content: center; /* Menjaga mereka berada di sebelah kiri */
            font-size: 1rem; /* Mengatur ukuran font agar lebih kecil */
        }

        .logo {
            position: relative;
            z-index: 10;
            width: 150px !important;
            height: auto !important;
            margin-right: 15px; /* Memberikan ruang antara logo dan teks */
        }

        .sidebar {
            background-color: #000040; /* Biru gelap */
            height: 100vh;
            position: fixed;
            width: 250px;
            top: 0;
            left: 0;
            padding-top: 50px;
            transition: all 0.3s ease; /* Menambahkan animasi transisi untuk sidebar */
            z-index: 10; /* Sidebar berada di atas footer */
        }

        /* Menghapus bullet point pada list */
        .sidebar ul {
            padding-left: 0;
            max-height: 700px; /* tinggi submenu */
            overflow-y: auto; /* Menambahkan scroll jika konten lebih dari max-height */
        }

        .sidebar li {
            list-style: none;
        }

        .sidebar a {
            color: white;
            font-size: 18px;
            font-weight: 500;
            padding: 12px 20px;
            text-decoration: none;
            display: block;
            border-bottom: 1px solid #005f7f;
            transition: background-color 0.3s ease, padding-left 0.3s ease;
        }

        /* Efek hover untuk menu utama */
        .sidebar a:hover {
            background-color: #005f7f;
            padding-left: 30px; /* Efek geser ke kanan */
        }

        .sidebar span {
            margin-top: 50px; /* Menyesuaikan jarak */
            font-weight: bold;
            font-style: italic;
            font-size: 16px;
            display: block; /* Pastikan teks berada pada baris baru */
        }

        .submenu a {
            padding-left: 40px; /* Memberikan indentasi pada submenu */
            font-size: 12px;
        }

        .submenu a:hover {
            background-color: #004f6d; /* Warna lebih gelap pada submenu saat hover */
        }

        .submenu {
            display: none; /* Secara default submenu disembunyikan */
            padding-left: 20px;
            max-height: 200px; /* Tentukan tinggi maksimum submenu */
            overflow-y: auto; /* Menambahkan scroll kalo sub menu suka offside kek Mbappe */
        }

        .submenu.show {
            display: block; /* Menampilkan submenu ketika "show" ditambahkan */
            animation: slideIn 0.5s ease-out; /* Animasi slide in */
        }

        /* Animasi slide in */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .content {
            margin-left: 270px; /* Memberikan ruang di sebelah kiri untuk sidebar */
            padding: 20px;
            position: relative;
            top: 80px; /* Memberikan ruang untuk header */
        }

        .content h1, .content p {
            margin-top: 20px; /* Memberikan sedikit jarak antara elemen */
        }

        /* Style untuk footer */
        .footer {
            background-color: #000050; /* Warna footer kek sidebar */
            color: white;
            text-align: center;
            padding: 5px 0; /* Mengurangi padding agar footer lebih kompak */
            position: fixed;
            bottom: 0;
            width: 100%;
            height: 30px; /* Menentukan tinggi footer agar tidak terlalu tinggi */
            line-height: 40px; /* Menyelaraskan teks di tengah footer secara vertikal */
            z-index: 5; /* Footer berada di bawah sidebar */
        }

        .footer p {
            font-size: 10px; /* Mengatur ukuran font menjadi lebih kecil */
            margin: 0; /* Menghapus margin default pada <p> */
        }
    </style>
</head>
<body>
    <!-- Header with Logo -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="#">
            <img src="/images/logo2.PNG" alt="Logo" class="logo" style="width: 150px; height: auto;">
        </a>
        <!-- Kotak Biru Header -->
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

    <!-- Sidebar Menu -->
    <div class="sidebar">
        <ul>
            <span>
                <a a style="font-weight: bold; font-style: italic; font-size: 16px;">Log Type Sources</a>
            </span>
            <li>
                <a href="javascript:void(0)" onclick="toggleSubmenu('osLogsMenu')">OS Logs</a>
                <ul class="submenu" id="osLogsMenu">
                    <li><a href="#">Linux</a></li>
                    <li><a href="#">Windows</a></li>
                    <li><a href="/middleware/logs">Other</a></li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0)" onclick="toggleSubmenu('appLogsMenu')">App Logs</a>
                <ul class="submenu" id="appLogsMenu">
                    <li><a href="#">Web Server Logs</a></li>
                    <li><a href="#">Database Logs</a></li>
                    <li><a href="#">Middleware Logs</a></li>
                    <li><a href="#">Application Logs</a></li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0)" onclick="toggleSubmenu('securityLogsMenu')">Security Logs</a>
                <ul class="submenu" id="securityLogsMenu">
                    <li><a href="#">Firewall Logs</a></li>
                    <li><a href="#">VPN Logs</a></li>
                    <li><a href="#">IDS Logs</a></li>
                    <li><a href="#">Authentication Logs</a></li>
                    <li><a href="#">Audit Logs</a></li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0)" onclick="toggleSubmenu('networkLogsMenu')">Network Logs</a>
                <ul class="submenu" id="networkLogsMenu">
                    <li><a href="#">Flow Logs</a></li>
                    <li><a href="#">Proxy Logs</a></li>
                    <li><a href="#">Router Logs</a></li>
                    <li><a href="#">DNS Logs</a></li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0)" onclick="toggleSubmenu('hardwareLogsMenu')">Hardware Logs</a>
                <ul class="submenu" id="hardwareLogsMenu">
                    <li><a href="#">Disk Health Logs</a></li>
                    <li><a href="#">Server Hardware Logs</a></li>
                    <li><a href="#">Temperature Logs</a></li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0)" onclick="toggleSubmenu('webLogsMenu')">Web Logs</a>
                <ul class="submenu" id="webLogsMenu">
                    <li><a href="#">HTTP Access Logs</a></li>
                    <li><a href="#">Error Logs</a></li>
                    <li><a href="#">Proxy Logs</a></li>
                    <li><a href="#">Web Auth Logs</a></li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0)" onclick="toggleSubmenu('cloudLogsMenu')">Cloud & Virtualization Logs</a>
                <ul class="submenu" id="cloudLogsMenu">
                    <li><a href="#">AWS Logs</a></li>
                    <li><a href="#">Azure Logs</a></li>
                    <li><a href="#">VMware Logs</a></li>
                    <li><a href="#">Kubernetes Logs</a></li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0)" onclick="toggleSubmenu('performanceLogsMenu')">Performance Monitoring Logs</a>
                <ul class="submenu" id="performanceLogsMenu">
                    <li><a href="#">CPU Usage Logs</a></li>
                    <li><a href="#">Memory Usage Logs</a></li>
                    <li><a href="#">Disk I/O Logs</a></li>
                </ul>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="content">
        <h1>Welcome to the Splunk Middleware</h1>
        <p>Pilih salah satu jenis log di menu sebelah kiri untuk melihat lebih lanjut.</p>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>Copyright &copy; 2024 Raja Cula Emas</p>
    </div>

    <!-- Bootstrap JS and dependencies (via CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    <!-- Custom JavaScript -->
    <script>
        function toggleSubmenu(menuId) {
            var submenu = document.getElementById(menuId);
            submenu.classList.toggle('show'); // Toggle the 'show' class to toggle visibility
        }
    </script>

</body>
</html>
