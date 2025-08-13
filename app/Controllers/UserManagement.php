<?php
namespace App\Controllers;

class UserManagement extends BaseController
{
    public function index() {
        return view('user_management/index');
    }
}