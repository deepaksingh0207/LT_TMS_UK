<?php
namespace App\Controllers;

use App\Models\TrolleyMasterModel;
use App\Models\UserModel;
use CodeIgniter\Shield\Models\GroupModel;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class TrolleyMaster extends BaseController {

    protected $trolleyMasterModel;
    protected $userModel;
    protected $groupModel;
    
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger) {
        parent::initController($request, $response, $logger);
        $this->trolleyMasterModel = new TrolleyMasterModel();
        $this->userModel = new UserModel();
        $this->groupModel = new GroupModel();
    }

    public function index() {
        $data = [
            'trolley_masters' => $this->trolleyMasterModel->paginate(5),
            'pager' => $this->trolleyMasterModel->pager,
        ];

        $transporter_user_ids = $this->groupModel->where('group' , 'transporter')->findColumn("user_id");
        $data['transporter_data'] = $this->userModel->whereIn('id',$transporter_user_ids)->findAll();

        foreach($data['trolley_masters'] as $k => $v) {
            if(!empty($v['user_id'])) {
                $user_data = $this->userModel->where('id',$v['user_id'])->first();
                $data['trolley_masters'][$k]['sap_user_code'] = $user_data->sap_user_code;
                $data['trolley_masters'][$k]['user_name'] = $user_data->first_name." ".$user_data->last_name;
            }
        }

        if ($this->request->isAJAX()) {
            return view('users/trolley_masters_table_partial', $data);
        }
        else {
            return view('trolley_master/index', $data);
        }

        return view('trolley_master/index');
    }
}