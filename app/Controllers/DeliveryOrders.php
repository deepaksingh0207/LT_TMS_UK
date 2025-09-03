<?php
namespace App\Controllers;

use App\Models\DeliveryOrderItemsModel;
use App\Models\DeliveryOrdersModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Shield\Models\GroupModel;
use Psr\Log\LoggerInterface;

class DeliveryOrders extends BaseController {

    protected $deliveryOrdersModel;
    protected $deliveryOrderItemsModel;
    protected $userModel;
    protected $groupModel;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger) {
        parent::initController($request, $response, $logger);
        $this->deliveryOrdersModel = new DeliveryOrdersModel();
        $this->deliveryOrderItemsModel = new DeliveryOrderItemsModel();
        $this->userModel = new UserModel();
        $this->groupModel = new GroupModel();
    }

    public function index() {
        if(session()->get('group') == 'transporter') {
            $data['orders'] = $this->deliveryOrdersModel->where('transporter_id' , session()->get('user_id'))->paginate(5);
        }
        else {
            $data['orders'] = $this->deliveryOrdersModel->paginate(5);
        }
        
        $data['pager'] = $this->deliveryOrdersModel->pager;
        $transporter_user_ids = $this->groupModel->where('group' , 'transporter')->findColumn("user_id");
        $data['transporter_data'] = $this->userModel->whereIn('id',$transporter_user_ids)->findAll();

        foreach($data['orders'] as $k => $v) {
            if(!empty($v['transporter_id'])) {
                $transporter_data = $this->userModel->where('id',$v['transporter_id'])->first();
                if(!empty($transporter_data->first_name) && !empty($transporter_data->last_name)) {
                    $data['orders'][$k]['transporter_name'] = $transporter_data->first_name." ".$transporter_data->last_name;
                }
            }
        }

        if ($this->request->isAJAX()) {
            // If AJAX, only return the partial view containing the table rows and pagination links
            return view('delivery_orders/table_partial', $data);
        } else {
            // If not AJAX, return the full view
            return view('delivery_orders/index', $data);
        }

        return view("delivery_orders/index");
    }

    public function assignTransporter() {
        if($this->request->is('post') ) {
            $req_data = $this->request->getPost();
            if(!empty($req_data['transporter_id']) && !empty($req_data['order_ids'])) {
                foreach($req_data['order_ids'] as $order_id) {
                    $this->deliveryOrdersModel->update($order_id,['transporter_id' => $req_data['transporter_id']]);
                }

                return $this->response->setJSON(['status' => 1 , 'message' => 'Transporter Assigned Successfull']);
            }
        }
    }
}