<?php
namespace App\Models;

use CodeIgniter\Model;

class TrolleyMasterModel extends Model {
    protected $table      = 'trolley_masters';
    protected $primaryKey = 'id';

    protected $allowedFields  = [
        'user_id',
        'vehicle_no',
        'capacity',
        'weight',
    ];

}