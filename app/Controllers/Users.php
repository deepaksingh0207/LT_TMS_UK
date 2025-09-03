<?php

namespace App\Controllers;

use App\Models\HeadMasterModel;
use App\Models\TrolleyMasterModel;
use CodeIgniter\Shield\Entities\User;
use CodeIgniter\Shield\Exceptions\ValidationException;
use CodeIgniter\Events\Events;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use App\Models\UserModel;
use CodeIgniter\Shield\Models\GroupModel;


class Users extends BaseController
{
    protected $userModel;
    protected $groupModel;
    protected $headMasterModel;
    protected $trolleyMasterModel;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        $this->userModel = new UserModel();
        $this->groupModel = new GroupModel();
        $this->headMasterModel = new HeadMasterModel();
        $this->trolleyMasterModel = new TrolleyMasterModel();
    }

    public function index()
    {
        return view('users/index');
    }

    public function login()
    {
        $request = service('request');
        $errors = [];
        if($request->is('post')) {
            $data = $request->getPost();

            if(!empty($data['email'])) {
                $authenticator = auth('session')->getAuthenticator();
                
                $result = $authenticator->attempt($data);
                if (! $result->isOK()) {
                    $errors [] = $result->reason();
                }
                else {
                    $user = auth()->user();
                    $user_group_data = $this->groupModel->where('user_id' , $user->id)->first();
    
                    session()->set([
                        'user_id'   => $user->id,
                        'sap_user_code' => $user->sap_user_code,
                        'first_name' => $user->first_name,
                        'last_name' => $user->last_name,
                        'username'  => $user->username,
                        'email'     => $user->email,
                        'group'     => $user_group_data['group'],
                    ]);
                    
                    return redirect()->to('dashboard');
                }
            }
            else {
                $errors [] = "Email Not Found";
            }

        }
        return view('users/login' , ['errors' => $errors]);
    }

    public function register()
    {
        if (auth()->loggedIn()) {
            return redirect()->to('dashboard');
        }
        
        $request = service('request');
        $errors = [];
        if($request->is('post')) {
            $data = $request->getPost();
            if(
                !empty($data['first_name']) &&
                !empty($data['last_name']) &&
                !empty($data['email']) &&
                !empty($data['password']) &&
                !empty($data['password_confirm'])
            ) {
                $users = auth()->getProvider();

                $data['username'] = $data['email'];
                $user = $users->createNewUser($data);

                // Workaround for email only registration/login
                if ($user->username === null) {
                    $user->username = null;
                }

                try {
                    $user->first_name = $data['first_name'];
                    $user->last_name = $data['last_name'];
                    $users->save($user);
                } catch (ValidationException) {
                    return redirect()->back()->withInput()->with('errors', $users->errors());
                }

                // To get the complete user object with ID, we need to get from the database
                $user = $users->findById($users->getInsertID());

                // Add to default group
                $users->addToDefaultGroup($user);

                Events::trigger('register', $user);

                /** @var Session $authenticator */
                $authenticator = auth('session')->getAuthenticator();
                $authenticator->startLogin($user);

                // Set the user active
                $user->activate();
                $authenticator->completeLogin($user);

                return redirect()->to('users/login')->with('message', "Account created successfully. Please Login to proceed");

            }
            else {
                $errors [] = "Empty Data Found Please check input fields.";
            }
        }
        return view('users/register' , ['errrors' => $errors]);
    }

    public function logout() {
        auth()->logout();
        return redirect()->to("login")->with('message', lang('Auth.successLogout'));
    }

    public function update() {
        if ($this->request->isAJAX()) {
            $request_data = $this->request->getPost();
            $update_data = [];

            if(!empty($request_data['column_name'])) {
                if($request_data['column_name'] == 'is_approved') {
                    $update_data = [
                        'is_approved' => $request_data['value']
                    ];
                }

                if($request_data['column_name'] == 'active') {
                    $update_data = [
                        'active' => $request_data['value']
                    ];
                }
            }
            
            if(!empty($update_data) && !empty($request_data['user_id'])) {
                $updateResult = $this->userModel->update($request_data['user_id'] , $update_data);

                if($updateResult) {
                    return $this->response->setJSON(['status' => 1 , 'message' => 'Record Updated']);
                }
                else {
                    return $this->response->setJSON(['status' => 0 , 'message' => 'Record Not Updated']);
                }
            } 
        }
    }

    public function add()
    {
        if ($this->request->is('post')) {

            $request_data = $this->request->getPost();
            $users = auth()->getProvider(); // Shield's UserModel
            $password = '123456';

            // check if user already exists
            $existing = $users->where('username', $request_data['email'])->first();
            if ($existing) {
                return $this->response->setJSON([
                    'status'  => 0,
                    'message' => 'User already exists!'
                ]);
            }

            // 1. Create User entity
            $user = new User([
                'username' => $request_data['email'],
                'email'    => $request_data['email'],
                'password' => $password, // Shield hashes automatically
            ]);
            $user->sap_user_code = $request_data['sap_user_code'];
            $user->first_name = $request_data['first_name'];
            $user->last_name = $request_data['last_name'];

            // 2. Save to `users` table
            $users->save($user);

            // 3. Get ID of inserted user
            $userId = $users->getInsertID();

            // 4. Reload the saved user entity
            $savedUser = $users->findById($userId);

            // 6. Assign groups
            if (!empty($request_data['group'])) {
                $savedUser->addGroup($request_data['group']);
            }

            return $this->response->setJSON([
                'status'  => 1,
                'message' => 'User created with group(s) successfully!'
            ]);
        }

        exit;
    }

    public function edit($user_id) {
        if ($this->request->is('get')) {
            $user_data = $this->userModel->where('id' , $user_id)->first();
            $user_group_data = $this->groupModel->where('user_id' , $user_id)->first();

            $data = [
                'id' => $user_data->id,
                'sap_user_code' => $user_data->sap_user_code,
                'first_name' => $user_data->first_name,
                'last_name' => $user_data->last_name,
                'email' => $user_data->email,
                'group' => $user_group_data['group'],
            ];

            return $this->response->setJSON(['status' => 1 , 'data' => $data]);
        }
        if ($this->request->is('post')) {
            $request_data = $this->request->getPost();
            $update_data = [
                'sap_user_code' => $request_data['sap_user_code'],
                'first_name' => $request_data['first_name'],
                'last_name' => $request_data['last_name'],
                'username' => $request_data['email'],
            ];

            $user_update = $this->userModel->update($user_id , $update_data);

            $user_group_update = $this->groupModel->where('user_id' , $user_id)->set('group' , $request_data['group'])->update();

            if($user_update && $user_group_update) {
                return $this->response->setJSON(['status' => 1 , 'message' => "User Record Updated Successfully"]);
            }
        }
    }

    public function profile() {
        return view('users/profile');
    }

    public function getHeadMasterData() {
        $user_id = session()->get('user_id');
        if(!empty($user_id)) {
            $data = [
                'head_masters' => $this->headMasterModel->where('user_id' , $user_id)->paginate(5),
                'pager' => $this->headMasterModel->pager,
            ];

            $transporter_user_ids = $this->groupModel->where('group' , 'transporter')->findColumn("user_id");
            $data['transporter_data'] = $this->userModel->whereIn('id',$transporter_user_ids)->findAll();

            if ($this->request->isAJAX()) {
                // If AJAX, only return the partial view containing the table rows and pagination links
                return view('users/head_masters_table_partial', $data);
            }
        }
    }

    public function getTrolleyMasterData() {
        $user_id = session()->get('user_id');
        if(!empty($user_id)) {
            $data = [
                'trolley_masters' => $this->trolleyMasterModel->where('user_id' , $user_id)->paginate(5),
                'pager' => $this->trolleyMasterModel->pager,
            ];

            $transporter_user_ids = $this->groupModel->where('group' , 'transporter')->findColumn("user_id");
            $data['transporter_data'] = $this->userModel->whereIn('id',$transporter_user_ids)->findAll();

            if ($this->request->isAJAX()) {
                // If AJAX, only return the partial view containing the table rows and pagination links
                return view('users/trolley_masters_table_partial', $data);
            }
        }
    }

    public function addHeadMasterData() {
        if(session()->get('group') == 'transporter') {
            $user_id = session()->get('user_id');
        }

        if($this->request->is('post')) {
            $req_data = $this->request->getPost();

            if(session()->get('group') == 'admin' || session()->get('group') == 'superadmin') {
                if(!empty($req_data['transporter_id'])) {
                    $user_id = $req_data['transporter_id'];
                }
            }

            if(!empty($req_data['vehicle_no']) && !empty($req_data['weight']) && !empty($user_id)) {
                $head_master_record = $this->headMasterModel->where(['vehicle_no' => $req_data['vehicle_no'] , 'user_id' => $user_id ])->first();
                
                if(!empty($head_master_record['id'])) {
                    return $this->response->setJSON(['status' => 0 , 'message' => 'This Vehicle No is already added']);
                }
                else {
                    $insert_data = [
                        'user_id' => $user_id,
                        'vehicle_no' => $req_data['vehicle_no'],
                        'weight' => $req_data['weight'], 
                    ];
                    $this->headMasterModel->insert($insert_data);

                    if($this->headMasterModel->getInsertID()) {
                        return $this->response->setJSON(['status' => 1 , 'message' => 'Record created successfully']);
                    }
                }
            }
            else {

                if(empty($req_data['vehicle_no'])) {
                    $message = "Empty Vehicle No Found";
                }

                if(empty($req_data['weight'])) {
                    $message = "Empty Weight Found";
                }

                if(empty($user_id)) {
                    $message = "No Transporter Found";
                }
                return $this->response->setJSON(['status' => 0 , 'message' => $message]);
            }
        }
    }

    public function addTrolleyMasterData() {
        if(session()->get('group') == 'transporter') {
            $user_id = session()->get('user_id');
        }

        if($this->request->is('post')) {
            $req_data = $this->request->getPost();
            if(session()->get('group') == 'admin' || session()->get('group') == 'superadmin') {
                if(!empty($req_data['transporter_id'])) {
                    $user_id = $req_data['transporter_id'];
                }
            }

            if( !empty($req_data['trolley_no']) && !empty($req_data['trolley_weight']) && !empty($req_data['capacity']) ) {
                $trolley_master_record = $this->trolleyMasterModel->where(['trolley_no' => $req_data['trolley_no'] , 'user_id' => $user_id ])->first();

                if(!empty($trolley_master_record['id'])) {
                    return $this->response->setJSON(['status' => 0 , 'message' => 'This Trolley No is already added']);
                }
                else {
                    $insert_data = [
                        'user_id' => $user_id,
                        'trolley_no' => $req_data['trolley_no'],
                        'weight' => $req_data['trolley_weight'], 
                        'capacity' => $req_data['capacity']
                    ];
                    $this->trolleyMasterModel->insert($insert_data);

                    if($this->trolleyMasterModel->getInsertID()) {
                        return $this->response->setJSON(['status' => 1 , 'message' => 'Record created successfully']);
                    }
                }
            }
            else {

                if(empty($req_data['vehicle_no'])) {
                    $message = "Empty Vehicle No Found";
                }

                if(empty($req_data['weight'])) {
                    $message = "Empty Weight Found";
                }

                if(empty($req_data['capacity'])) {
                    $message = "Empty Capacity Found";
                }

                if(empty($user_id)) {
                    $message = "No Transporter Found";
                }

                return $this->response->setJSON(['status' => 0 , 'message' => $message]);
            }
        }
    }
}
