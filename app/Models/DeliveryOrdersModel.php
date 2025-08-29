<?php
namespace App\Models;

use CodeIgniter\Model;

class DeliveryOrdersModel extends Model {
    protected $table      = 'delivery_orders';
    protected $primaryKey = 'id';

    protected $allowedFields  = [
        'id',
        'order_no',
        'delivery_date',
        'ship_to_party_code',
        'ship_to_party_name',
        'sold_to_party_code',
        'sold_to_party_name',
    ];

}