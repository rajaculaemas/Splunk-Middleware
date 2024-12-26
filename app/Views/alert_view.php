<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Splunk bootsv1 Logs</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #1a1c27;
            color: #fff;
        }
        .table {
            background-color: #2d303b;
            border-radius: 8px;
        }
        .table th, .table td {
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Splunk bootsv1 Logs</h2>
        <table id="alertTable" class="table table-striped table-dark">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Time</th>
                    <th>Alert Score</th>
                    <th>Fidelity</th>
                    <th>Severity</th>
                    <th>Alert Type</th>
                    <th>Description</th>
                    <th>Tenant</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; foreach ($alerts as $alert): ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $alert['time']; ?></td>
                    <td><?= $alert['alert_score']; ?></td>
                    <td><?= $alert['fidelity']; ?></td>
                    <td><?= $alert['severity']; ?></td>
                    <td><?= $alert['alert_type']; ?></td>
                    <td><?= $alert['description']; ?></td>
                    <td><?= $alert['tenant']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#alertTable').DataTable();
        });
    </script>
</body>
</html>
