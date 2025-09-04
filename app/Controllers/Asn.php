<?php
namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use App\Models\DeliveryOrderItemsModel;
use App\Models\DeliveryOrdersModel;

class Asn extends BaseController {
    protected $deliveryOrdersModel;
    protected $deliveryOrderItemsModel;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger) {
        parent::initController($request, $response, $logger);
        $this->deliveryOrdersModel = new DeliveryOrdersModel();
        $this->deliveryOrderItemsModel = new DeliveryOrderItemsModel();
    }

    public function create() {
        $data['orders_data'] = [];
        if($this->request->is('post')) {
            $req_data = $this->request->getPost();
            $req_data['order_ids'] = explode(",",$req_data['order_ids']);
            
            $data['orders_data'] = $this->deliveryOrdersModel->whereIn('id',$req_data['order_ids'])->findAll();
            
            foreach($data['orders_data'] as $k => $v) {
                $data['orders_data'][$k]['order_items'] = $this->deliveryOrderItemsModel->where('delivery_order_id' , $v['id'])->findAll();
            }
        }
        return view("asn/create",$data);
    }
}