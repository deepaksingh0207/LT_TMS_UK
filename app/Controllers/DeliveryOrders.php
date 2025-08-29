<?php
namespace App\Controllers;

use App\Models\DeliveryOrderItemsModel;
use App\Models\DeliveryOrdersModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class DeliveryOrders extends BaseController {

    protected $deliveryOrdersModel;
    protected $deliveryOrderItemsModel;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger) {
        parent::initController($request, $response, $logger);
        $this->deliveryOrdersModel = new DeliveryOrdersModel();
        $this->deliveryOrderItemsModel = new DeliveryOrderItemsModel();
    }

    public function index() {
        $data['orders'] = $this->deliveryOrdersModel->paginate(5);
        $data['pager'] = $this->deliveryOrdersModel->pager;

        if ($this->request->isAJAX()) {
            // If AJAX, only return the partial view containing the table rows and pagination links
            return view('delivery_orders/table_partial', $data);
        } else {
            // If not AJAX, return the full view
            return view('delivery_orders/index', $data);
        }

        return view("delivery_orders/index");
    }
}