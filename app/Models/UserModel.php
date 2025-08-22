<?php
namespace App\Models;

use CodeIgniter\Shield\Models\UserModel as ShieldUserModel;

class UserModel extends ShieldUserModel {
    protected $table      = 'users';
    protected $primaryKey = 'id';

    protected $allowedFields  = [
        'username',
        'sap_user_code',
        'first_name',
        'last_name',
        'status',
        'status_message',
        'is_approved',
        'active',
        'last_active',
    ];

}