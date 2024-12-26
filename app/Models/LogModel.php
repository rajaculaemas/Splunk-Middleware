<?php

namespace App\Models;

use CodeIgniter\Model;

class LogModel extends Model
{
    protected $table = 'botsv1';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'serial', 'time', 'source', 'sourcetype', 'host', 'index', 'splunk_server', 'raw_data'
    ];

    /**
     * Fungsi untuk mengambil data dengan pagination
     *
     * @param int $limit Batas data per halaman
     * @param int $page Halaman yang diminta
     * @return mixed
     */
    public function getLogsWithPagination($limit = 10, $page = 1)
    {
        return $this->paginate($limit, 'default', $page);
    }

    /**
     * Fungsi untuk mendapatkan total jumlah data (untuk pagination)
     *
     * @return int
     */
    public function getTotalLogs()
    {
        return $this->countAllResults();
    }
}
