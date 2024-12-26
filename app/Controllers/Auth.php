<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{

public function login()
{
    log_message('debug', 'Current URL: ' . current_url());
    if (session()->get('isLoggedIn')) {
        log_message('debug', 'Sesi isLoggedIn: ' . (session()->get('isLoggedIn') ? 'true' : 'false'));
        return redirect()->to('/middleware'); // Jika sudah login, arahkan langsung ke halaman /middleware
    }
    return view('auth/login'); // Jika belum login, ya login dulu ga sih
}


public function doLogin()
{
    $session = session();
    $username = $this->request->getPost('username');
    $password = $this->request->getPost('password');

    // Ambil data user dari database berdasarkan username
    $userModel = new UserModel();
    $user = $userModel->where('username', $username)->first();

    // Cek apakah user ditemukan
    if ($user && password_verify($password, $user['password'])) {
        // Jika password benar
        $session->set('isLoggedIn', true);
        $session->set('username', $user['username']); // Menyimpan username ke session
        return redirect()->to('/middleware'); // Arahkan ke halaman utama setelah login
    } else {
        // Jika login gagal
        $session->setFlashdata('error', 'Username atau Password salah');
        return redirect()->to('/middleware/login');
    }
}



    public function logout()
{
    // Menghapus session pengguna
    session()->remove('isLoggedIn');
    
    // Redirect ke halaman login setelah logout
    return redirect()->to('middleware/login');
}

    public function register()
    {
        return view('auth/register');
    }

    public function doRegister()
{
    $model = new UserModel();

    // Ambil data yang dikirimkan dari form
    $username = $this->request->getPost('username');
    $email = $this->request->getPost('email');
    $password = $this->request->getPost('password');
    $passwordConfirm = $this->request->getPost('password_confirm');

    // Cek apakah username sudah ada di database
    $existingUser = $model->where('username', $username)->first();

    if ($existingUser) {
        // Jika username sudah terdaftar
        return redirect()->to('/middleware/register')->with('error', 'Username sudah digunakan!');
    }

    // Validasi apakah password dan konfirmasi password cocok
    if ($password !== $passwordConfirm) {
        // Jika password dan konfirmasi tidak cocok
        return redirect()->to('/middleware/register')->with('error', 'Password dan konfirmasi password beda busset!');
    }

    // Jika username belum terdaftar dan password valid
    $data = [
        'username' => $username,
        'email'    => $email,
        'password' => password_hash($password, PASSWORD_DEFAULT),
    ];

    // Simpan data pengguna ke database
    $model->save($data);

    // Redirect ke halaman login setelah registrasi berhasil
    return redirect()->to('/middleware/login')->with('success', 'Registrasi berhasil. Silakan login.');
}
}
