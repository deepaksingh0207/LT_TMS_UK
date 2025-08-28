<?php
namespace App\Models;

use CodeIgniter\Model;

class HeadMasterModel extends Model {
    protected $table      = 'head_master';
    protected $primaryKey = 'id';

    protected $allowedFields  = [
        'id',
        'user_id',
        'vehicle_no',
        'weight',
    ];

}