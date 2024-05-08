<?php
namespace App\Controllers;
use App\Models\ApplicationModel;
use App\Models\ParamModel;
use App\Models\AgentModel;
use App\Models\StaffModel;
use App\Models\AdminModel;
use App\Models\CountryModel;
use App\Models\StateModel;
use App\Models\DistrictModel;
use App\Models\CityModel;
use App\Models\UserModel;
use App\Models\TertiarymModel;

class ApplicationController extends BaseController
{
   


    public function __construct() {
        helper('text');
        $this->AdminModel = new AdminModel();
        $this->TertiarymModel = new TertiarymModel();
        $this->AgentModel = new AgentModel();
        $this->ApplicationModel = new ApplicationModel();
    }
    public function index()
    {
        $aps = new ApplicationModel();
        $data['pageTitle']='Share Holder';
        $data['apps'] = $aps->findAll();
        return view('Admin/Applications',$data);
    }
    public function A_Add()
    {
        $data['password_length'] = 8; // Change this to your desired password length
        $data['password'] = random_string('alnum', $data['password_length']);
        $apt = new ParamModel();
    $data['pt'] = $apt->findAll();
    $data['pageTitle']='Agent';
    return view('Admin/agentcode',$data);
    }

    public function A_listall()
    {  
    $data['pageTitle']='Agents';
    $Patients = new AgentModel();
    //$today= array('clinic_id'=>session('cid'));
    $data['Patients'] = $Patients->orderBy('a_id','ASC')->findAll();
    return view('Admin/Agents',$data);
    }
    public function staff_Add()
    {
       
    $data['pageTitle']='staff';
    return view('Admin/addstaff',$data);
    }
    public function staff_listall()
    {  

    $data['pageTitle']='staffs';
    $staffcategorys = new StaffModel();
    $data['staffcategorys'] = $staffcategorys->orderBy('staff_id','ASC')->findAll();
    return view('Admin/staffcategory',$data);
    }
    public function asave()
    {
        $session = session();
        $isLoggedIn = $session->get('isLoggedIn');
        $tmanagercode = $session->get('tmanagercode');
    
        if (!$isLoggedIn || empty($tmanagercode)) {
            return redirect()->to('tertiary_manager_login')->with('error', 'Please log in to access the dashboard.');
        }
    $user = new UserModel();
    $patient = new AgentModel();
    $apt = new ParamModel(); 
     $adharfront=$this->request->getFile('Adharfront');
        $adharback=$this->request->getFile('adharback');
        $pfront=$this->request->getFile('pfront');
        if ($adharfront->isValid() && ! $adharfront->hasMoved()) {
            $adar=$adharfront->getRandomName();
            $adaar=$adharback->getRandomName();
            $panf=$pfront->getRandomName();
            $adharfront->move('adhar/',$adar);
            $adharback->move('adhar/',$adaar); 
            $pfront->move('pan/',$panf);
           
        }
    $data = ['Agent_code'=> $this->request->getVar('agentcode'),
    'tmanager_code'=> $tmanagercode,
    'username'=>$this->request->getVar('username'),
    'password'=>$this->request->getVar('password'),
    'Name'=>$this->request->getVar('name'),
    'FName'=>$this->request->getVar('fname'),
    'Address'=>$this->request->getVar('add'),
    'Email'=>$this->request->getVar('email'),
    'Mobile'=>$this->request->getVar('phone'),
    'accnumber'=>$this->request->getVar('accnumber'),
    'bname'=>$this->request->getVar('bname'),
    'ifsc'=>$this->request->getVar('ifsc'),
    'adharno'=>$this->request->getVar('adharno'),
    'panno'=>$this->request->getVar('panno'),
    'pfront'=>$panf, 
    'afront'=>$adar, 
    'aback'=>$adaar,
    'Status'=>$this->request->getVar('status'),
    'Created_at'=>date('d/m/Y'),
    ];
    
        $patient->insert($data);
        $apt->find('1');
        $id=['agent_code'=>$this->request->getVar('aid')];
        $apt->update('1',$id);
        $agent_id = $patient->getInsertID();
        //dd($adminid);exit;
   
           $userData = [
               'username' => $data['username'],
               'password' => $data['password'],
               'user_type' => 'agent',
               'users_id' =>$agent_id, // Assuming user type is 'admin' for admin users
           ];
           $user->insert($userData);
     return $this->response->redirect(site_url('/Addwalls/Agents'));
    }
    public function edit_agent($a_id)
    {
        
        $agentmodel = new AgentModel();
        $data['agent']= $agentmodel->find($a_id);
        // Pass the selected names and ID to the view
        return view('Admin/edit_agent', $data);
    
   }
   public function update_agent($a_id)
   {
       $agent = new AgentModel();
       $user = new UserModel();
   
       $adharfront = $this->request->getFile('Adharfront');
     
       $adharback = $this->request->getFile('adharback');
        
       $pfront = $this->request->getFile('pfront');
       //dd($pfront);exit;
   
   
       
       //dd($district_id);
   
       $data = [
        'Agent_code'=> $this->request->getVar('agentcode'),
        'username'=>$this->request->getVar('username'),
        'password'=>$this->request->getVar('password'),
        'Name'=>$this->request->getVar('name'),
        'FName'=>$this->request->getVar('fname'),
        'Address'=>$this->request->getVar('add'),
        'Email'=>$this->request->getVar('email'),
        'Mobile'=>$this->request->getVar('phone'),
        'accnumber'=>$this->request->getVar('accnumber'),
        'bname'=>$this->request->getVar('bname'),
        'ifsc'=>$this->request->getVar('ifsc'),
        'adharno'=>$this->request->getVar('adharno'),
        'panno'=>$this->request->getVar('panno'),
        'Status'=>$this->request->getVar('status'),
        'Created_at'=>date('d/m/Y'),
       ];
      // print_r($data);exit;
   
       if ($adharfront->isValid()) {
           $adar = $adharfront->getRandomName();
           $adharfront->move('adhar/', $adar);
           $data['afront'] = $adar;
       }
      // dd( $data['afront']);exit;
   
       if ($adharback->isValid()) {
           $adaar = $adharback->getRandomName();
           $adharback->move('adhar/', $adaar);
           $data['aback'] = $adaar;
       }
   
       if ($pfront->isValid()) {
           $panf = $pfront->getRandomName();
           $pfront->move('pan/', $panf);
           $data['pfront'] = $panf;
       }
   
       // Perform update
       $agentId = $this->request->getPost('agent_id');
     
       $agent->update($agentId, $data);
      // dd($adminId);exit;
      $userData = [
       'username' => $data['username'],
       'password' => $data['password'],
      
   ];
   //print_r($userData);exit;
   //dd($admin_id);exit;
   $user->set($userData)->where('users_id', $a_id)->update();
     
           // Update user data
          
       
   
   
   
       return $this->response->redirect(site_url('Addwalls/Agents'));
   }
   public function delete_agent($a_id)
   {
      
       $agent = new AgentModel();
       $user = new UserModel();
       $deleted =  $agent->delete($a_id);
       $deleted_user = $user->where('users_id', $a_id)->delete();
   
       // Check if the staff member was successfully deleted
       if ($deleted && $deleted_user) {
           // Redirect to a success page or return a success message
           return $this->response->redirect(site_url('Addwalls/Agents'));
       }
   }
 
    public function showagentlogin()
    {
        return view('Admin/agent_login');
    }
    
    public function agent_login()
    {
       
        //dd('a');exit;
        $session = session();
    
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
    //dd($username);
        // Fetch user by username/email
        $userModel = new UserModel();
        // $agent = $this->userModel->getAgentcodebyUsersud($users_id);
        // $this->session->set_userdata('users_id', $agent->users_id); 
        // dd($agent->users_id);exit;
        $user = $userModel->where('username', $username)->where('password', $password)->first();
      //  $a=$user['password'];
       // dd($user );exit;
        if ($user !== null && $password === $user['password'] && $user['user_type'] == 'agent') {

            $agentModel = new AgentModel(); // Assuming AgentModel is your model for agents
            $agent = $agentModel->where('a_id', $user['users_id'])->first();


            if ($agent !== null) {
            // Passwords match, user is authenticated
            $session->set('agent_isLoggedIn', true);
            $session->set('username', $user['username']);
            $session->set('agent_code', $agent['Agent_code']);
           // dd($agent['Agent_code']);exit;
            return redirect()->to('agent/dashboard');
        } else {
            // Agent not found, handle the error
            return redirect()->to('agents/login')->with('error', 'Agent not found.');
        }
    } else {
        // Invalid credentials, show error message
        return redirect()->to('agents/login')->with('error', 'Invalid username or password');
    }
         
        }
        public function agent_index()
        {
            $session = session();
            $isLoggedIn = $session->get('agent_isLoggedIn');
            $agentCode = $session->get('agent_code');
        
            if (!$isLoggedIn || empty($agentCode)) {
                return redirect()->to('agent_login')->with('error', 'Please log in to access the dashboard.');
            }
        
            $applicationModel = new ApplicationModel();
            $agentModel = new AgentModel();
        
            // Fetch the agent's data including the agent code
            $agent = $agentModel->where('Agent_code', $agentCode)->first();
        
            if ($agent === null) {
                return redirect()->to('agents/login')->with('error', 'Agent not found.');
            }
        
            // Fetch applications based on the agent code
            $applications = $applicationModel->where('referalcode', $agentCode)->findAll();
        
            // Pass the applications data to the view
            return view('Admin/agent_dashboard', ['applications' => $applications]);
        }
    
        public function agent_applications()
        {
            $session = session();
            $isLoggedIn = $session->get('agent_isLoggedIn');
            $agentCode = $session->get('agent_code');
        
            if (!$isLoggedIn || empty($agentCode)) {
                return redirect()->to('agents/login')->with('error', 'Please log in to access the dashboard.');
            }
        
            $applicationModel = new ApplicationModel();
            $applications = $applicationModel->where('referalcode', $agentCode)->where('status','verified')->findAll();
        
            // Pass the applications data to the separate view page
            return view('Admin/application_agent', ['applications' => $applications]);
        }
        
    
    
    
            public function agent_logout()
            {
                $session = session();
            
                // Unset session data related to login status
                $session->remove('agent_isLoggedIn');
    $session->remove('agent_username');
            
                // Destroy the session
                $session->destroy();
            
                // Redirect to the login page or any other desired page
                return redirect()->to('agents/login');
            }
    
            public function showAgents($tmanager_id) {
                // Fetch manager details using $manager_id
                $tmanager = $this->TertiarymModel->getTManagerById($tmanager_id);
            
                if ($tmanager) {
                    // Fetch the manager's manager's code from $manager
                    $tmanager_manager_code = $tmanager->tmanager_code;
            
                    // Fetch tertiary managers under the manager's manager
                    $agents = $this->AgentModel->getAgentsByManagerTManagerCode($tmanager_manager_code);
                 
            
                    $data['tmanager'] = $tmanager;
                    $data['agents'] = $agents;
                    return view('Admin/showAgents',$data);
                } else {
                    echo "Agents  not found.";
                }
            }
            public function view_agent($a_id)
            {
                $agentmodel = new AgentModel();
                //$history = new PHistoryModel();
                $agents= $agentmodel->find($a_id);
               // $data['tmanager']= $tmanagermodel->find($tmanager_id);
                // $countryName = $tmanagermodel->getCountryNameById($tmanager['country_id']);
                // $stateName = $tmanagermodel->getStateNameById($tmanager['state_id']);
                // $districtName = $tmanagermodel->getDistrictNameById($tmanager['district_id']);
                // $cityName = $tmanagermodel->getCityNameById($tmanager['city_id']);
                $data['agents'] = $agents;
                $data['pageTitle']='Agent/view';
                return view('Admin/view_agent',$data);
            }
                public function showShareholdres($agent_id) {
                    // Fetch manager details using $manager_id
                    $agent = $this->AgentModel->getAgentById($agent_id);
                
                    if ($agent) {
                        // Fetch the manager's manager's code from $manager
                        $agent_code = $agent->Agent_code;
                
                        // Fetch tertiary managers under the manager's manager
                        $shareholders = $this->ApplicationModel->getshareholdersByAgentCode($agent_code);
                
                        $data['agent'] = $agent;
                        $data['shareholders'] = $shareholders;
                        return view('Admin/showShareholders',$data);
                    } else {
                        echo "Agents  not found.";
                    }

            }

            public function view_shareholder($App_id)
            {
                $applicationmodel = new ApplicationModel();
                //$history = new PHistoryModel();
                $shareholders= $applicationmodel->find($App_id);
               // $data['tmanager']= $tmanagermodel->find($tmanager_id);
                // $countryName = $tmanagermodel->getCountryNameById($tmanager['country_id']);
                // $stateName = $tmanagermodel->getStateNameById($tmanager['state_id']);
                // $districtName = $tmanagermodel->getDistrictNameById($tmanager['district_id']);
                // $cityName = $tmanagermodel->getCityNameById($tmanager['city_id']);
                $data['shareholders'] = $shareholders;
                $data['pageTitle']='shareholder/view';
                return view('Admin/view_shareholder',$data);
            }









    // staff categorys................


    public function staffsave()
    {
    $staffcategorys = new StaffModel();

    $data = [
    'Name'=>$this->request->getVar('staffid'),
    'Staff_type'=>$this->request->getVar('stafftype'),
    'StaffKey'=>$this->request->getVar('staffkey'),
    'Description'=>$this->request->getVar('description'),
    'Status'=>$this->request->getVar('status'),
    ];
    
     $staffcategorys->insert($data);
       
     return $this->response->redirect(site_url('/Addwalls/staffcategorys'));
    }

    public function edit_staffcategorys($Staff_id)
    {
        
        $staffcategorys = new StaffModel();
        $data['staffcategorys'] = $staffcategorys->find($Staff_id);
        return view('Admin/edit_staffcategory', $data);
    }
    public function updateStaff($staff_id) {
        $staffcategorys = new StaffModel();
        // Retrieve staff data from the form or request
        $data = [
            'Staff_type' => $this->request->getPost('staff_type'),
            'StaffKey' => $this->request->getPost('staffkey'),
            'Description' => $this->request->getPost('description'),
            'Status' => $this->request->getPost('status')
        ];

        // Call the model function to update staff data
        $staffcategorys->update($staff_id,$data);

        // Check if the update was successful
        if($staffcategorys) {
            // Success message
            return $this->response->redirect(site_url('/Addwalls/staffcategorys'));
       
        }
       
    }

    public function delete_staff($staff_id)
    {
       
        $staffcategorys = new StaffModel();
        $deleted =  $staffcategorys->delete($staff_id);

        // Check if the staff member was successfully deleted
        if ($deleted) {
            // Redirect to a success page or return a success message
            return $this->response->redirect(site_url('/Addwalls/staffcategorys'));
        }
    }

    public function save()
    {   $apt = new ParamModel();
        $staff = new ApplicationModel();
        //$encrypter=\Config\Services::encrypter();
        //$login=new LoginModel();
    //     $userdata= ['username'=> $this->request->getPost('username'),
    //     'email'=> $this->request->getPost('email'),
    //     'Password'=> $this->request->getPost('pass'), 
    //     'Status'=> $this->request->getPost('status'),
    //     'Type'=> $this->request->getPost('category'),
    //     'J_id'=>session('cid')
    // ];
    //     $login->insert($userdata);
        $email = \Config\Services::email();
           $message='Dear '.$this->request->getPost('name').',
 
 Congratulations from Add-Walls! 

   We happily welcome you into the Add-Walls shareholder family! This is an exciting time for our company, and by registering to the share application form, you have successfully become a proud part of our company. 

Kindly wait for the approval. We will be contacting you soon regarding the further procedures.

Thank you!

For more information: +91 8590562299,+91 4972557173

Email: admin@addwalls.in

www.addwalls.in

WITH REGARDS, 
ADD-WALLS INFRA SOLUTION LIMITED';
        // Set email parameters
        $email->setTo($this->request->getPost('email'));
        $email->setFrom('admin@addwalls.com','Addwalls');
        $email->setSubject('Congratulations from Add-Walls!');
        $email->setMessage($message);
       
       // Send email
        if ($email->send()) {
            //echo 'Email sent successfully.';
        } else {
            $data = $email->printDebugger(['headers']);
            //print_r($data);
        }
    
        $adharfront=$this->request->getFile('Adharfront');
        $adharback=$this->request->getFile('adharback');
        $pfront=$this->request->getFile('pfront');
        //$pback=$this->request->getFile('pback');
        $base64Image = $this->request->getPost('selfie');
        // Convert base64 to binary data
        $binaryImage = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64Image));
        // Save the image to the database using the model
        //$selfieModel = new SelfieModel();
        if ($adharfront->isValid() && ! $adharfront->hasMoved()) {
            $adar=$adharfront->getRandomName();
            $adaar=$adharback->getRandomName();
            $panf=$pfront->getRandomName();
           // $panb=$pback->getRandomName();
            $adharfront->move('adhar/',$adar);
            $adharback->move('adhar/',$adaar); 
            $pfront->move('pan/',$panf);
           // $pback->move('pan/',$panb);
        }
        // if($this->request->getPost('rcode')=""){
        //     $introcode="Addwalls";
        // }
        // else{
        //     $introcode=$this->request->getPost('rcode');
        // }
        $data= ['Name'=>$this->request->getPost('name'),
         'Username'=>$this->request->getPost('username'), 
         'adharno'=>$this->request->getPost('adharno'),
         'panno'=>$this->request->getPost('panno'),
         'birthday'=>$this->request->getPost('birthday'), 
         'Gender'=>$this->request->getPost('gender'), 
         'Occupation'=>$this->request->getPost('job'), 
         'Qualification'=>$this->request->getPost('qualification'), 
         'Father_name'=>$this->request->getPost('fathername'),
         'Mother_name'=>$this->request->getPost('mothername'),
         'Spouse_Name'=>$this->request->getPost('spouse'),
         'Nominee_Name'=>$this->request->getPost('nominee'),
         'Relation'=>$this->request->getPost('relation'),
         'Email'=>$this->request->getPost('email'), 
         'Country'=>$this->request->getPost('country'), 
         'state'=>$this->request->getPost('state'), 
         'Pincode'=>$this->request->getPost('pincode'),
         'District'=> $this->request->getPost('district'),
         'City'=>$this->request->getPost('city'), 
         'Passord'=>$this->request->getPost('rpass'),
         'Paddress'=>$this->request->getPost('paddress'), 
         'Caddress'=>$this->request->getPost('caddress'), 
         'Mobile'=>$this->request->getPost('mobile'), 
         'Ophone'=>$this->request->getPost('ophone'), 
         'pfront'=>$panf, 
         //'pback'=>$panb, 
         'afront'=>$adar, 
         'aback'=>$adaar, 
         'selfie'=>$binaryImage, 
         'referalcode'=>$this->request->getPost('rcode'), 
         'Application_Id'=>'Awalls_'.$this->request->getPost('state').'_'.$this->request->getVar('Aid'), 
         'know'=>$this->request->getPost('know'),
         'status'=>'pending'];
        $apt->find('1');
        $id=['shap_id'=>$this->request->getVar('Aid')];
        $apt->update('1',$id);
        $staff->insert($data);
       // return $this->response->redirect(site_url('/clinic/Employees')); 
       return view('thankyou');
		}
	
        public function view($id)
        {
            $singleapt = new ApplicationModel();
            //$history = new PHistoryModel();
            $data['myapt']= $singleapt->find($id);
            // $userlist = $singleapt->select('P_id')
            // ->where('a_id',$id);
            // $data['history']=$history->where('P_id',$userlist)->findAll();
            $data['pageTitle']='Applications/view';
            return view('Admin/ViewApps',$data);
        }
        public function update($id)
        {
            $staff = new ApplicationModel();
            $staff->find($id);
            //$avatar=$this->request->getFile('avatar');
            $data= [
                
                'status'=>$this->request->getPost('status'),
               // 'created_at'=>date('Y-m-d H:i:s'),
            ];
            $staff->update($id,$data);
            return $this->response->redirect(site_url('/Applications'));
        }

        public function delete_application($id)
        {
           
            $singleapt = new ApplicationModel();
            $user = new UserModel();
            $deleted =  $singleapt->delete($id);
            $deleted_user = $user->where('users_id', $id)->delete();
        
            // Check if the staff member was successfully deleted
            if ($deleted && $deleted_user) {
                // Redirect to a success page or return a success message
                return $this->response->redirect(site_url('/Applications'));
            }
        }




        //Addwalls/getAgents
         public function getAgents(){

        $request = service('request');
        $postData = $request->getPost();

        $response = array();

        // Read new token and assign in $response['token']
        $response['token'] = csrf_hash();
        $data = array();

        if(isset($postData['search'])){

              $search = $postData['search'];

              // Fetch record
              $patient = new AgentModel();
              $userlist = $patient->select('a_id,Agent_code,Name')
                          ->like('Agent_code',$search)
                          ->orderBy('Agent_code')
                          ->findAll(5);
              foreach($userlist as $user){
                    $data[] = array(
                          "value" => $user['Name'],
                          "label" => $user['Agent_code'],
                          
                    );
              }
        }

        $response['data'] = $data;

        return $this->response->setJSON($response);


    }
    
    public function checkEmail()
    {
        // Get the email from the POST request
        $email = $this->request->getPost('email');

        // Load the user model
        $adminmodel = new AdminModel();

        // Check if the email exists in the database
        $existingUser = $adminmodel->where('email', $email)->first();

        // Prepare the response
        $response = ['exists' => false];

        if ($existingUser !== null) {
            // Email already exists
            $response['exists'] = true;
        }

        // Send JSON response
        return $this->response->setJSON($response);
    }
         public function checkMobile()
    {
        $mob = $this->request->getPost('mobile');
        $userModel = new ApplicationModel();

        $user = $userModel->where('Mobile', $mob)->first();

        if ($user) {
            echo json_encode(['status' => 'success', 'message' => 'Mobile Number is already registerd with us, please try with another Mobile number.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => '']);
        }
    }
     public function checkUsername()
    {
        $user = $this->request->getPost('user');
        $userModel = new ApplicationModel();

        $user = $userModel->where('Username', $user)->first();

        if ($user) {
            echo json_encode(['status' => 'success', 'message' => 'Username already exists, please try with another Username.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => '']);
        }
    }
    // ............admin.......................


    public function admin_Add()
    {
       
        $data['password_length'] = 8; // Change this to your desired password length
        $data['password'] = random_string('alnum', $data['password_length']);

        $countryModel = new CountryModel();
        $data['countries'] = $countryModel->findAll();
       
        //print_r($data);exit;
    $data['pageTitle']='admin';
    return view('Sadmin/add_admin',$data);
    }
    public function admin_listall()
    {  
    $data['pageTitle']='admin';
    $admins = new AdminModel();
    $data['admins'] = $admins->orderBy('admin_id','ASC')->findAll();
    return view('Sadmin/superadmin',$data);
    }
    public function getStates()
    {
        $countryId = $this->request->getPost('country_id');
        $stateModel = new StateModel();
        $states = $stateModel->where('country_id', $countryId)->findAll();
        
        return json_encode($states);
    }
    public function getDist()
    {
        $stateId = $this->request->getPost('state_id');
        $distModel = new DistrictModel();
        $districts = $distModel->where('state_id', $stateId)->findAll();
        
        return json_encode($districts);
    }
    public function getcity()
    {
        $distId = $this->request->getPost('dist_id');
        $cityModel = new CityModel();
        $cities = $cityModel->where('dist_id', $distId)->findAll();
        
        return json_encode($cities);
    }
    public function adminsave()
    {

        $validation = \Config\Services::validation();

        $validation->setRules([
            'email' => 'required|valid_email|is_unique[Sadmin.email]',
            // Add other validation rules as needed
        ]);
        if (!$validation->withRequest($this->request)->run()) {
            // Validation failed
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
        //  $email = \Config\Services::email();
         
           $message='Dear '.$this->request->getPost('username').',
 
 Congratulations from Add-Walls! 

   We happily welcome you into the Add-Walls shareholder family! This is an exciting time for our company, and by registering to the share application form, you have successfully become a proud part of our company. 

Kindly wait for the approval. We will be contacting you soon regarding the further procedures.

Thank you!

For more information: +91 8590562299,+91 4972557173

Email: admin@addwalls.in

www.addwalls.in

WITH REGARDS, 
ADD-WALLS INFRA SOLUTION LIMITED';
        // Set email parameters
    //     $email->setTo($this->request->getPost('email'));
    //     $email->setFrom('admin@addwalls.com','Addwalls');
    //     $email->setSubject('Congratulations from Add-Walls!');
    //     $email->setMessage($message);
       
    //    // Send email
    //     if ($email->send()) {
    //         //echo 'Email sent successfully.';
    //     } else {
    //         $data = $email->printDebugger(['headers', 'message']);
    //         print_r($data);exit;
    //     }
       
       // Send email
  
    $admin = new AdminModel();
    $user = new UserModel();
    //$apt = new ParamModel(); 
  
     $adharfront=$this->request->getFile('Adharfront');;
     $adharback=$this->request->getFile('adharback');
        $pfront=$this->request->getFile('pfront');
        
        if ($adharfront->isValid() && ! $adharfront->hasMoved()) {
            $adar=$adharfront->getRandomName();
            $adaar=$adharback->getRandomName();
            $panf=$pfront->getRandomName();
            $adharfront->move('adhar/',$adar);
            $adharback->move('adhar/',$adaar); 
            $pfront->move('pan/',$panf);
           
        }



    $data = [
    'username'=>$this->request->getPost('username'),
    'password'=>$this->request->getPost('password'),
    'Caddress'=>$this->request->getPost('caddress'),
    'Paddress'=>$this->request->getPost('paddress'),
    'email'=>$this->request->getPost('email'),
    'Adhar_cardno'=>$this->request->getPost('adharno'),
    'Pancardno'=>$this->request->getPost('panno'),
    'Father'=>$this->request->getPost('father'),
    'Mother'=>$this->request->getPost('mother'),
    'Nominee'=>$this->request->getPost('nominee'),
    'Education'=>$this->request->getPost('education'),
    'Dob'=>$this->request->getPost('birthday'), 
    'Relationship_with_nominee'=>$this->request->getPost('rnominee'),
    'country_id'=>$this->request->getPost('country'), 
    'state_id'=>$this->request->getPost('state'), 
    'Pin'=>$this->request->getPost('pin'),
    'district_id'=> $this->request->getPost('district'),
    'city_id'=>$this->request->getPost('city'), 
    'Pancard_front'=>$panf, 
    'Adhar_card_front'=>$adar, 
    'Adhar_card_back'=>$adaar,
    'Status'=>$this->request->getPost('status'),
    'Created_at'=>date('d/m/Y'),
    ];
 

        $admin->insert($data);
        $adminid = $admin->getInsertID();
     //dd($adminid);exit;

        $userData = [
            'username' => $data['username'],
            'password' => $data['password'],
            'user_type' => 'admin',
            'users_id' =>$adminid, // Assuming user type is 'admin' for admin users
        ];
        $user->insert($userData);
      
        return $this->response->redirect(site_url('Addwalls/admins'));
    }
   
    public function edit_admin($admin_id)
    {
        
        $adminmodel = new AdminModel();
        $admin= $adminmodel->find($admin_id);
        // Pass the selected names and ID to the view
        if ($admin) {
            // Get country name
            $countryName = $adminmodel->getCountryNameById($admin['country_id']);
            $stateName = $adminmodel->getStateNameById($admin['state_id']);
            $districtName = $adminmodel->getDistrictNameById($admin['district_id']);
            $cityName = $adminmodel->getCityNameById($admin['city_id']);
            
            
        
            // Pass data to the view
            return view('Sadmin/edit_admin', [
                'admin' => $admin,
                'countryName' => $countryName,
                'stateName' => $stateName,
                'districtName' => $districtName,
                'cityName' => $cityName,
            ]);
        } else {
            // Handle case where admin data is not found
            return redirect()->to('admin/list')->with('error', 'Admin not found.');
        }
    
    
   }
    public function getRecord($id) {
        $record = $this->yourModel->find($id);
        $countryId = $record['country_id'];
        $countryName = $this->countryModel->find($countryId)['name'];
        $record['country_name'] = $countryName;
        return $record;
    }
    public function fetchStates()
{
    // Fetch states based on the selected country ID sent via AJAX
    $countryId = $this->request->getPost('country_id');
    $stateModel = new StateModel();
    $states = $stateModel->where('country_id', $countryId)->findAll();

    // Return states as JSON response
    return $this->response->setJSON($states);
}
    public function update_admin($admin_id)
{
    $admin = new AdminModel();
    $user = new UserModel();

    $adharfront = $this->request->getFile('Adharfront');
   // dd($adharfront);exit;
    $adharback = $this->request->getFile('adharback');
    $pfront = $this->request->getFile('pfront');



    $countryName = $this->request->getPost('country');
    $stateName = $this->request->getPost('state');
    $districtName = $this->request->getPost('district');
    $cityName = $this->request->getPost('city');
//dd($stateName);
    $country_id = $admin->getCountryIdByName($countryName);
    $state_id = $admin->getStateIdByName($stateName);
    //dd($state_id);
    $district_id = $admin->getDistrictIdByName($districtName);
    $city_id = $admin->getCityIdByName($cityName);

    $data['country_id'] = $country_id;
    $data['state_id'] = $state_id;
    $data['district_id'] = $district_id;
    $data['city_id'] = $city_id;
    //dd($district_id);

    $data = [
        'username' => $this->request->getPost('username'),
        'password' => $this->request->getPost('password'),
        'Caddress' => $this->request->getPost('caddress'),
        'Paddress' => $this->request->getPost('paddress'),
        'email' => $this->request->getPost('email'),
        'Adhar_cardno' => $this->request->getPost('adharno'),
        'Pancardno' => $this->request->getPost('panno'),
        'Father' => $this->request->getPost('father'),
        'Mother' => $this->request->getPost('mother'),
        'Nominee' => $this->request->getPost('nominee'),
        'Relationship_with_nominee' => $this->request->getPost('rnominee'),
        'country_id' =>  $country_id, 
    'state_id' => $state_id,
    'district_id' => $district_id,
    'city_id' => $city_id,
        'Pin' => $this->request->getPost('pin'),
        'Status' => $this->request->getPost('status'),
        'Dob'=>$this->request->getPost('birthday'), 
        'Created_at' => date('d/m/Y'),
    ];
   // print_r($data);exit;

    if ($adharfront->isValid()) {
        $adar = $adharfront->getRandomName();
        $adharfront->move('adhar/', $adar);
        $data['Adhar_card_front'] = $adar;
    }

    if ($adharback->isValid()) {
        $adaar = $adharback->getRandomName();
        $adharback->move('adhar/', $adaar);
        $data['Adhar_card_back'] = $adaar;
    }

    if ($pfront->isValid()) {
        $panf = $pfront->getRandomName();
        $pfront->move('pan/', $panf);
        $data['Pancard_front'] = $panf;
    }

    // Perform update
    $adminId = $this->request->getPost('admin_id');
  
    $admin->update($admin_id, $data);
   // dd($adminId);exit;
   $userData = [
    'username' => $data['username'],
    'password' => $data['password'],
   
];
//print_r($userData);exit;
//dd($admin_id);exit;
$user->set($userData)->where('users_id', $admin_id)->update();
  
        // Update user data
       
    



    return $this->response->redirect(site_url('Addwalls/admins'));
}
public function delete_admin($admin_id)
{
   
    $admin = new AdminModel();
    $user = new UserModel();
    $deleted =  $admin->delete($admin_id);
    $deleted_user = $user->where('users_id', $admin_id)->delete();

    // Check if the staff member was successfully deleted
    if ($deleted && $deleted_user) {
        // Redirect to a success page or return a success message
        return $this->response->redirect(site_url('/Addwalls/admins'));
    }
}

    
    }
    ?>