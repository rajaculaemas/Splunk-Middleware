<?php

namespace App\Models;

use CodeIgniter\Model;

class AlertModel extends Model
{
    protected $table = 'alerts';
    protected $primaryKey = 'id';
    protected $allowedFields = ['time', 'alert_score', 'fidelity', 'severity', 'alert_type', 'description', 'tenant'];
}
