<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logs Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Zoom-out 80% */
        body {
            transform: scale(0.8); /* Zoom out ke 80% */
            transform-origin: 0 0; /* Menjaga titik origin di kiri atas */
            width: 125%; /* Memperbesar width agar konten tetap proporsional */
            height: 120%; /* Memperbesar height agar konten tetap proporsional */
            overflow: auto; /* Menghindari scrollbars */
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
            height: 60px;
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

        /* Styles untuk slide-in */
        #slideInPanel {
            position: fixed;
            top: 0;
            right: -100%;
            width: 40%;
            height: 120%;
            background-color: rgba(0, 0, 0, 0.94);
            font-size: 17px;
            color: greenyellow;
            overflow-y: scroll;
            padding: 20px;
            transition: right 0.6s ease-in-out;
            z-index: 1050; /* bikin panel jadi paling atas */
        }

        #slideInPanel.show {
            right: 0;
        }

        /* Untuk memastikan tombol berada di kiri */
        .navbar .ms-auto {
            margin-right: 0 !important; /* Menghilangkan margin otomatis */
        }
    </style>
</head>
<body style="background-color: #000025; color: #fff;">

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

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <div class="container mt-5">    
            <!-- Tombol Upload -->
            <div class="mb-4">
                <a href="<?= site_url('middleware/upload'); ?>" class="btn btn-light">Upload Log</a>
            </div>

            <!-- Judul Halaman -->
            <h2 class="text-center">Logs Data</h2>
            <p>Halaman <?= $currentPage ?> dari <?= ceil($totalLogs / $limit) ?> total halaman</p>

            <!-- Dropdown Pilihan Limit dan Pencarian - Disusun Sejajar -->
            <div class="row mb-4 d-flex justify-content-between">
                <!-- Dropdown Limit -->
                <div class="col-md-1">
                    <label for="limitSelect" class="form-label"></label>
                    <select id="limitSelect" class="form-select">
                        <option value="5" <?= $limit == 5 ? 'selected' : '' ?>>5</option>
                        <option value="10" <?= $limit == 10 ? 'selected' : '' ?>>10</option>
                        <option value="25" <?= $limit == 25 ? 'selected' : '' ?>>25</option>
                        <option value="50" <?= $limit == 50 ? 'selected' : '' ?>>50</option>
                    </select>
                </div>
                <!-- Pencarian -->
                <div class="col-md-5 text-end">
                    <form method="get" class="d-inline">
                        <input type="text" name="search" class="form-control d-inline w-100" placeholder="Cari data..." value="<?= htmlspecialchars($search) ?>">
                    </form>
                </div>
            </div>

            <!-- Tabel Data -->
            <div class="table-responsive">
                <table class="table table-dark table-striped">
                    <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Time</th>
                            <th>Source</th>
                            <th>Source Type</th>
                            <th>Host</th>
                            <th>Index</th>
                            <th>Splunk Server</th>
                            <th>Raw Data</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = ($page - 1) * $pager->getPerPage() + 1; ?>
                        <?php foreach ($logs as $log): ?>
                            <tr>
                                <td><?= htmlspecialchars($log['serial']); ?></td>
                                <td><?= htmlspecialchars($log['time']); ?></td>
                                <td><?= htmlspecialchars($log['source']); ?></td>
                                <td><?= htmlspecialchars($log['sourcetype']); ?></td>
                                <td><?= htmlspecialchars($log['host']); ?></td>
                                <td><?= htmlspecialchars($log['index']); ?></td>
                                <td><?= htmlspecialchars($log['splunk_server']); ?></td>
                                <td>
                                    <!-- Tombol Raw Data untuk menampilkan data dalam slide-in -->
                                    <button class="btn btn-primary btn-sm viewRawData" data-id="<?= $log['id']; ?>">Raw Data</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Slide-in Panel untuk menampilkan raw data -->
            <div id="slideInPanel">
                <button id="closeSlideIn" class="btn btn-danger" style="position: absolute; top: 10px; right: 10px;">Close</button>
                <pre id="rawDataContent"></pre>
            </div>

            <!-- Pagination Section -->
            <div class="mt-4 d-flex justify-content-between align-items-center">
                <div>
                    Menampilkan <?= count($logs) ?> dari <?= $totalLogs ?> jumlah data
                </div>
                <nav>
                    <ul class="pagination justify-content-center">
                        <li class="page-item <?= $currentPage == 1 ? 'disabled' : '' ?>">
                            <a href="<?= site_url('middleware/logs?page=1&limit=' . $limit . '&search=' . urlencode($search)) ?>" class="page-link">First</a>
                        </li>
                        <li class="page-item <?= $currentPage == 1 ? 'disabled' : '' ?>">
                            <a href="<?= site_url('middleware/logs?page=' . ($currentPage - 1) . '&limit=' . $limit . '&search=' . urlencode($search)) ?>" class="page-link">Previous</a>
                        </li>
                        <li class="page-item <?= $currentPage == $pager->getPageCount() ? 'disabled' : '' ?>">
                            <a href="<?= site_url('middleware/logs?page=' . ($currentPage + 1) . '&limit=' . $limit . '&search=' . urlencode($search)) ?>" class="page-link">Next</a>
                        </li>
                        <li class="page-item <?= $currentPage == $pager->getPageCount() ? 'disabled' : '' ?>">
                            <a href="<?= site_url('middleware/logs?page=' . $pager->getPageCount() . '&limit=' . $limit . '&search=' . urlencode($search)) ?>" class="page-link">Last</a>
                        </li>
                    </ul>
                </nav>
            </div>

        </div>
    </div>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('.viewRawData').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                
                // Fetch raw data from the server using AJAX
                fetch(`/middleware/logs/getRawData/${id}`)
                    .then(response => response.json())
                    .then(data => {
                        // Format and display raw data in the slide-in panel
                        document.getElementById('rawDataContent').textContent = JSON.stringify(data, null, 2);
                        document.getElementById('slideInPanel').classList.add('show');
                    })
                    .catch(error => alert('Error loading raw data'));
            });
        });

        document.getElementById('closeSlideIn').addEventListener('click', () => {
            document.getElementById('slideInPanel').classList.remove('show');
        });
    </script>

    <script>
        // Update URL Parameter Ketika Pilihan Limit Berubah
        document.getElementById('limitSelect').addEventListener('change', function() {
            const limit = this.value;
            const url = new URL(window.location.href);
            url.searchParams.set('limit', limit);
            url.searchParams.delete('page'); // Reset ke halaman 1
            window.location.href = url.toString();
        });
    </script>

</body>
</html>
