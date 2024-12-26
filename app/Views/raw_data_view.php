<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raw Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #1a1c27;
            color: #fff;
        }
        .table th {
            color: #fff;
            background-color: #000;
            font-size: 0.85rem;
            padding: 0.75rem;
        }
        .table td {
            color: #fff !important;
            font-size: 0.8rem;
            padding: 0.5rem;
        }
    </style>
</head>
<body>
    <!-- Header with Logo -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="ms-auto">
            <!-- Menampilkan nama pengguna jika sudah login -->
            <?php if (session()->get('isLoggedIn')): ?>
                <span class="navbar-text">
                    Welcome, <?= session()->get('username'); ?> <!-- Menampilkan nama pengguna dari session -->
                </span>
                <a href="<?= base_url('middleware/logout'); ?>" class="btn btn-danger ms-3">Logout</a> <!-- Tombol Logout -->   
            <?php else: ?>
                <a href="<?= base_url('auth/login'); ?>" class="btn btn-success ms-3">Login</a> <!-- Tombol Login jika belum login -->
            <?php endif; ?>
        </div>
    </nav>
    <div class="container mt-5">
        <h2>Raw Data</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-light">
                    <tr>
                        <th class="text-center">End Time</th>
                        <th class="text-center">Timestamp</th>
                        <th class="text-center">Bytes</th>
                        <th class="text-center">Source IP</th>
                        <th class="text-center">Source Mac</th>
                        <th class="text-center">Source Port</th>
                        <th class="text-center">Bytes In</th>
                        <th class="text-center">Dest IP</th>
                        <th class="text-center">Dest MAC</th>
                        <th class="text-center">Dest Port</th>
                        <th class="text-center">Bytes Out</th>
                        <th class="text-center">Time Taken</th>
                        <th class="text-center">Transport</th>
                        <th class="text-center">Command</th>
                        <th class="text-center">File Name</th>
                        <th class="text-center">File Size</th>
                        <th class="text-center">NT Status</th>
                        <th class="text-center">Search Pattern</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($rawData) && is_array($rawData)): ?>
                        <tr>
                            <td><?= esc($rawData['endtime'] ?? 'N/A'); ?></td>
                            <td><?= esc($rawData['timestamp'] ?? 'N/A'); ?></td>
                            <td><?= esc($rawData['bytes'] ?? 'N/A'); ?></td>
                            <td><?= esc($rawData['src_ip'] ?? 'N/A'); ?></td>
                            <td><?= esc($rawData['src_mac'] ?? 'N/A'); ?></td>
                            <td><?= esc($rawData['src_port'] ?? 'N/A'); ?></td>
                            <td><?= esc($rawData['bytes_in'] ?? 'N/A'); ?></td>
                            <td><?= esc($rawData['dest_ip'] ?? 'N/A'); ?></td>
                            <td><?= esc($rawData['dest_mac'] ?? 'N/A'); ?></td>
                            <td><?= esc($rawData['dest_port'] ?? 'N/A'); ?></td>
                            <td><?= esc($rawData['bytes_out'] ?? 'N/A'); ?></td>
                            <td><?= esc($rawData['time_taken'] ?? 'N/A'); ?></td>
                            <td><?= esc($rawData['transport'] ?? 'N/A'); ?></td>
                            <td><?= is_array($rawData['command']) ? implode(', ', $rawData['command']) : 'N/A'; ?></td>
                            <td>
                            <?= is_array($rawData['filename'] ?? null) ? implode(', ', $rawData['filename']) : 'N/A'; ?>
                            </td>
                            <td>
                            <?= is_array($rawData['filesize'] ?? null) ? implode(', ', $rawData['filesize']) : 'N/A'; ?>
                            </td>
                            <td><?= is_array($rawData['nt_status']) ? implode(', ', $rawData['nt_status']) : 'N/A'; ?></td>
                            <td><?= esc($rawData['search_pattern'] ?? 'N/A'); ?></td>
                        </tr>
                    <?php else: ?>
                        <tr>
                            <td colspan="17">No raw data available or invalid format.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
