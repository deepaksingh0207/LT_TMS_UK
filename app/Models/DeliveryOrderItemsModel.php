<?php
namespace App\Models;

use CodeIgniter\Model;

class DeliveryOrderItemsModel extends Model {
    protected $table      = 'delivery_order_items';
    protected $primaryKey = 'id';

    protected $allowedFields  = [
        'id',
        'delivery_order_id',
        'item_no',
        'material_code',
        'material_name',
        'plant',
        'storage_location',
        'batch',
        'delivery_qty',
        'uom',
    ];

}