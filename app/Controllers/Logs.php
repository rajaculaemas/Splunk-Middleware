<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\LogModel;

class Logs extends Controller
{
    public function index()
    {
        return view('upload_form');
    }

    public function upload()
    {
        $logModel = new LogModel();
        
        // Handle file upload
        $file = $this->request->getFile('csv_file');
        if ($file->isValid() && !$file->hasMoved()) {
            // Move file to folder
            $filePath = WRITEPATH . 'uploads/' . $file->getName();
            $file->move(WRITEPATH . 'uploads');

            // Read the CSV file
            $csvData = array_map('str_getcsv', file($filePath));
            // Assume first row is header
            $header = array_shift($csvData);

            // Insert CSV data to database
            foreach ($csvData as $row) {
                $data = [
                    'serial' => $row[0],
                    'time' => $row[1],
                    'source' => $row[2],
                    'sourcetype' => $row[3],
                    'host' => $row[4],
                    'index' => $row[5],
                    'splunk_server' => $row[6],
                    'raw_data' => $row[7]
                ];
                $logModel->save($data);
            }

            return redirect()->to('/middleware/logs');
        }
    }

public function showLogs()
{
    $logModel = new LogModel(); 
    $totalLogs = $logModel->countAllResults(); 
    $perPage = 10; 

    $currentPage = $this->request->getVar('page') ?? 1;

    // Mengambil limit dan search parameter
    $limit = $this->request->getVar('limit') ?? $perPage;
    $search = $this->request->getVar('search');

    // Mengambil data logs berdasarkan parameter pencarian di kolom cari tau ga lu jan iya iya aja
    if ($search) {
        $logs = $logModel->like('serial', $search)
                         ->orLike('source', $search)
                         ->orLike('sourcetype', $search)
                         ->orLike('host', $search)           
                         ->orLike('index', $search)          
                         ->orLike('splunk_server', $search)  
                         ->paginate($limit, 'default', $currentPage);

        $totalLogs = $logModel->like('serial', $search)
                              ->orLike('source', $search)
                              ->orLike('sourcetype', $search)
                              ->orLike('host', $search)
                              ->orLike('index', $search)
                              ->orLike('splunk_server', $search)
                              ->countAllResults();
    } else {
        $logs = $logModel->paginate($limit, 'default', $currentPage);
    }

    // Kirim data ke view biar ditampilin, tau ga lu jan iya iya aja
    return view('logs_view', [
        'logs' => $logs,
        'pager' => \Config\Services::pager(),
        'currentPage' => $currentPage,
        'perPage' => $perPage,
        'totalLogs' => $totalLogs,
        'totalRecords' => $totalLogs,
        'limit' => $limit,
        'search' => $search,
        'page' => $currentPage
    ]);
}

    public function viewRawData($id)
    {
        $logModel = new LogModel();
        $log = $logModel->find($id);

        if (!$log) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Log not found');
        }

        // Cek apakah raw_data JSON yang valid, kalau ga ya gabisa ditampilin bussett
        $rawData = json_decode($log['raw_data'], true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception('Raw data tidak dalam format JSON yang valid.');
        }

        return view('raw_data_view', ['rawData' => $rawData]);
    }
    public function getRawData($id)
{
    $logModel = new LogModel();
    $log = $logModel->find($id);

    if (!$log) {
        return $this->response->setStatusCode(404)->setBody('Log not found');
    }

    // Cek apakah raw_data JSON yang valid, kalau ga ya gabisa ditampilin bussett
    $rawData = json_decode($log['raw_data'], true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        return $this->response->setStatusCode(400)->setBody('Invalid JSON data');
    }

    // Mengembalikan raw_data dalam format JSON
    return $this->response->setJSON($rawData);
}
}
