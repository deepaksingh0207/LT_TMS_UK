<?php

namespace App\Controllers;
use CodeIgniter\Shield\Entities\User;
use CodeIgniter\Shield\Exceptions\ValidationException;
use CodeIgniter\Events\Events;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use App\Models\UserModel;

class Users extends BaseController
{
    protected $userModel;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        $this->userModel = new UserModel();
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
}
