<?php

// app/Controllers/OtherLogsController.php

namespace App\Controllers;

use CodeIgniter\Controller;

class OtherLogsController extends Controller
{
    public function logs()
    {
        // Logika untuk menampilkan halaman logs
        return view('otherlogs_view');
    }
}
