<?php

namespace App\Controllers;
use App\Models\UserModel;
class AdminController extends BaseController
{

    public function index()
    {
        $session = session();
        if (!$session->get('admin_isLoggedIn')) {
            return redirect()->to('adminlogin'); // Redirect to login if not logged in
        }
    
        return view('Admin/admin_dashboard');
    }
    

    public function showadminlogin()
    {
        return view('Admin/admin_login');
    }
    
    public function login()
    {
       
        $session = session();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
//dd($username);
        // Fetch user by username/email
        $userModel = new UserModel();
        $user = $userModel->where('username', $username)->where('password', $password)->first();
      //  $a=$user['password'];
        //dd($user );exit;
        if ($user !== null && $password === $user['password'] && $user['user_type'] == 'admin') {
            // Passwords match, user is authenticated
            $session->set('user_type', 'admin');
            $session->set('admin_isLoggedIn', true);
            $session->set('users_id', $user['users_id']);
            $session->set('username', $user['username']);
          // dd($user['user_type']);exit;
            return redirect()->to('admin/dashboard');
            } else {
                // Invalid credentials, show error message
                return redirect()->to('adminlogin')->with('error', 'Invalid username or password');
            }
         
        }
            public function logout()
            {
                $session = session();
            
                // Unset session data related to login status
                $session->remove('admin_isLoggedIn');
                $session->remove('username');
            
                // Destroy the session
                $session->destroy();
            
                // Redirect to the login page or any other desired page
                return redirect()->to('adminlogin');
            }
            













}
