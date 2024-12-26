<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Pager extends BaseConfig
{
    public $templates = [
    'default_full'   => 'CodeIgniter\Pager\Views\default_full',
    'default_simple' => 'CodeIgniter\Pager\Views\default_simple',
    'default_head'   => 'CodeIgniter\Pager\Views\default_head',
    'bootstrap_full' => 'App\Views\pagination\bootstrap_full', // Tambahkan ini
];

    public $perPage = 20;
}
