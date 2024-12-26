<?php

namespace App\Controllers;

use App\Models\AlertModel;

class AlertController extends BaseController
{
    public function index()
    {
        $model = new AlertModel();

        // Ambil semua data dari database
        $data['alerts'] = $model->findAll();

        // Tampilkan data di view
        return view('alert_view', $data);
    }
}
