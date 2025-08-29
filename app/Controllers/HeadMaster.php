<?php
namespace App\Controllers;

use App\Models\HeadMasterModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class HeadMaster extends BaseController {

    protected $headMasterModel;
    
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger) {
        parent::initController($request, $response, $logger);
        $this->headMasterModel = new HeadMasterModel();
    }

    public function index() {
        $data = [
            'head_masters' => $this->headMasterModel->paginate(5),
            'pager' => $this->headMasterModel->pager,
        ];

        if ($this->request->isAJAX()) {
            return view('users/head_masters_table_partial', $data);
        }
        else {
            return view('head_master/index', $data);
        }

        return view('head_master/index');
    }
}