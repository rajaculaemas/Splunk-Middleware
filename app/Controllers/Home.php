<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Home extends Controller
{
    public function index()
    {
        // Logic untuk menampilkan halaman utama (dashboard)
        return view('index'); // Ganti dengan nama view yang sesuai
    }
}