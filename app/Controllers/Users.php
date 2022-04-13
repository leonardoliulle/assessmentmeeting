<?php

namespace App\Controllers;

class Users extends BaseController
{
    public function index()
    {
        return view('welcome_message');
    }

    public function testete()
    {
        echo 'adasfasdsdatqwer';
    }

    public function list($link = null)
    {
        $userModel = model('App\Models\UserModel');
        
        $data['list'] =  $userModel->where('link', $link)->findAll();
        return json_encode($data);
    }

    public function userq()
    {
        
        return view('users/userq');
    
    }

}
