<?php
namespace App\Controllers;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\UserModel;
use CodeIgniter\Shield\Models\GroupModel;


class UserManagement extends BaseController
{
    protected $userModel;
    protected $groupModel;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        $this->userModel = new UserModel();
        $this->groupModel = new GroupModel();
    }

    public function index() {
        $data['users'] = $this->userModel->paginate(5);
        $data['pager'] = $this->userModel->pager;

        foreach($data['users'] as $key => $user) {
            $group_data = $this->groupModel->where('user_id' , $user->id)->first();
            if(!empty($group_data['group'])) {
                $user->group = $group_data['group'];
            }
        }

        // Check if it's an AJAX request
        if ($this->request->isAJAX()) {
            // If AJAX, only return the partial view containing the table rows and pagination links
            return view('user_management/users_table_partial', $data);
        } else {
            // If not AJAX, return the full view
            return view('user_management/index', $data);
        }
        return view('user_management/index');
    }
}