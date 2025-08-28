<?php
namespace App\Models;

use CodeIgniter\Model;

class TrolleyMasterModel extends Model {
    protected $table      = 'trolley_master';
    protected $primaryKey = 'id';

    protected $allowedFields  = [
        'user_id',
        'trolley_no',
        'capacity',
        'weight',
    ];

}