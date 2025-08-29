<?php
namespace App\Controllers;

use App\Models\TrolleyMasterModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class TrolleyMaster extends BaseController {

    protected $trolleyMasterModel;
    
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger) {
        parent::initController($request, $response, $logger);
        $this->trolleyMasterModel = new TrolleyMasterModel();
    }

    public function index() {
        $data = [
            'trolley_masters' => $this->trolleyMasterModel->paginate(5),
            'pager' => $this->trolleyMasterModel->pager,
        ];

        if ($this->request->isAJAX()) {
            return view('users/trolley_masters_table_partial', $data);
        }
        else {
            return view('trolley_master/index', $data);
        }

        return view('trolley_master/index');
    }
}