<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\ManagerModel;
use App\Models\TertiarymModel;
use App\Models\ParamModel;
use App\Models\AgentModel;
use App\Models\StaffModel;
use App\Models\AdminModel;
use App\Models\CountryModel;
use App\Models\StateModel;
use App\Models\DistrictModel;
use App\Models\CityModel;
use App\Models\UserModel;

class ManagerController extends BaseController
{
   


    public function __construct() {
        helper('text');
        $this->ManagerModel = new ManagerModel();
        $this->TertiarymModel = new TertiarymModel();
        $this->AdminModel = new AdminModel();
    }
    public function Add_manager()

    {
        $apt = new ParamModel();
        $data['pt'] = $apt->findAll();
        $data['password_length'] = 8; // Change this to your desired password length
        $data['password'] = random_string('alnum', $data['password_length']);

        $countryModel = new CountryModel();
        $data['countries'] = $countryModel->findAll();
       
        //print_r($data);exit;
    $data['pageTitle']='manager';
    return view('Admin/Manager/add_manager',$data);
    }
    public function manager_listall()
    {  
        $session = session();
        $isLoggedIn = $session->get('isLoggedIn');
        $users_id = $session->get('users_id');
    $data['pageTitle']='manager';
    $managers = new ManagerModel();
    $data['managers'] = $managers->where('admin_id', $users_id)->findAll();
    return view('Admin/Manager/manager',$data);
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
    public function manager_save()
    {
        $session = session();
        $isLoggedIn = $session->get('isLoggedIn');
        $users_id = $session->get('users_id');
      // dd($users_id);exit;
        if (!$session->has('users_id')) {
            return redirect()->to('adminlogin'); // Redirect to login page if admin is not logged in
        }
      
     

        $validation = \Config\Services::validation();

        $validation->setRules([
            'email' => 'required|valid_email|is_unique[awall_manager.email]',
            // Add other validation rules as needed
        ]);
        if (!$validation->withRequest($this->request)->run()) {
            // Validation failed
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
//          $email = \Config\Services::email();
         
//            $message='Dear '.$this->request->getPost('username').',
 
//  Congratulations from Add-Walls! 

//    We happily welcome you into the Add-Walls shareholder family! This is an exciting time for our company, and by registering to the share application form, you have successfully become a proud part of our company. 

// Kindly wait for the approval. We will be contacting you soon regarding the further procedures.

// Thank you!

// For more information: +91 8590562299,+91 4972557173

// Email: admin@addwalls.in

// www.addwalls.in

// WITH REGARDS, 
// ADD-WALLS INFRA SOLUTION LIMITED';
//         // Set email parameters
//         $email->setTo($this->request->getPost('email'));
//         $email->setFrom('admin@addwalls.com','Addwalls');
//         $email->setSubject('Congratulations from Add-Walls!');
//         $email->setMessage($message);
       
//        // Send email
//         if ($email->send()) {
//             //echo 'Email sent successfully.';
//         } else {
//             $data = $email->printDebugger(['headers', 'message']);
//             print_r($data);exit;
//         }
       
       // Send email
  
    $manager = new ManagerModel();
    $user = new UserModel();
    $apt = new ParamModel(); 
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


$a=$this->request->getVar('managercode');
//dd($a);exit;

    $data = ['manager_code'=> $this->request->getVar('managercode'),
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
    'admin_id' => $users_id,
    'Created_at'=>date('d/m/Y'),
    ];
    //print_r($data);exit;
        $manager->insert($data);
        $managerid = $manager->getInsertID();
        $apt->find('1');
        $id=['manager_code'=>$this->request->getVar('manager_id')];
        //dd($id);
        $apt->update('1',$id);
        $userData = [
            'username' => $data['username'],
            'password' => $data['password'],
            'user_type' => 'manager',
            'users_id' =>$managerid,
        ];
        $user->insert($userData);
        return $this->response->redirect(site_url('Addwalls/manager'));
       
    }
   
    public function edit_manager($manager_id)
    {
       // dd('d');
        
        $managermodel = new ManagerModel();
        $manager= $managermodel->find($manager_id);
        // Pass the selected names and ID to the view
        if ($manager) {
            // Get country name
            $countryName = $managermodel->getCountryNameById($manager['country_id']);
            $stateName = $managermodel->getStateNameById($manager['state_id']);
            $districtName = $managermodel->getDistrictNameById($manager['district_id']);
            $cityName = $managermodel->getCityNameById($manager['city_id']);
            
            
        
            // Pass data to the view
            return view('Admin/Manager/edit_manager', [
                'manager' => $manager,
                'countryName' => $countryName,
                'stateName' => $stateName,
                'districtName' => $districtName,
                'cityName' => $cityName,
            ]);
        } else {
            // Handle case where admin data is not found
            return redirect()->to('manager/list')->with('error', 'Admin not found.');
        }
    
    
   }
//     public function getRecord($id) {
//         $record = $this->yourModel->find($id);
//         $countryId = $record['country_id'];
//         $countryName = $this->countryModel->find($countryId)['name'];
//         $record['country_name'] = $countryName;
//         return $record;
//     }
//     public function fetchStates()
// {
//     // Fetch states based on the selected country ID sent via AJAX
//     $countryId = $this->request->getPost('country_id');
//     $stateModel = new StateModel();
//     $states = $stateModel->where('country_id', $countryId)->findAll();

//     // Return states as JSON response
//     return $this->response->setJSON($states);
// }
    public function update_manager($manager_id)
{
    $manager = new ManagerModel();
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
    $country_id = $manager->getCountryIdByName($countryName);
    $state_id = $manager->getStateIdByName($stateName);
    //dd($state_id);
    $district_id = $manager->getDistrictIdByName($districtName);
    $city_id = $manager->getCityIdByName($cityName);

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
        'Education'=>$this->request->getPost('education'),
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
    $manager->update($manager_id, $data);
    $userData = [
        'username' => $data['username'],
        'password' => $data['password'],
       
    ];
    //print_r($userData);exit;
    //dd($admin_id);exit;
    $user->set($userData)->where('users_id', $manager_id)->update();
    return $this->response->redirect(site_url('Addwalls/manager'));
}
public function delete_manager($manager_id)
{
    $user = new UserModel();
    $manager = new ManagerModel();
    $deleted =  $manager->delete($manager_id);
    $deleted_user = $user->where('users_id', $manager_id)->delete();

    // Check if the staff member was successfully deleted
    if ($deleted && $deleted_user) {
        // Redirect to a success page or return a success message
        return $this->response->redirect(site_url('/Addwalls/manager'));
    }


}


// public function index()
//     {
//         $session = session();
//         if (!$session->get('isLoggedIn')) {
//             return redirect()->to('adminlogin'); // Redirect to login if not logged in
//         }
    
//         return view('Admin/admin_dashboard');
//     }
    

    public function showmanagerlogin()
    {
        return view('Admin/Manager/manager_login');
    }
    
    public function login()
    {
       
        //dd('a');exit;
        $session = session();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
//dd($username);
        // Fetch user by username/email
        $userModel = new UserModel();
        $user = $userModel->where('username', $username)->where('password', $password)->first();
      //  $a=$user['password'];
       // dd($user );exit;
        if ($user !== null && $password === $user['password'] && $user['user_type'] == 'manager') {
            $ManagerModel = new ManagerModel(); // Assuming AgentModel is your model for agents
            $manager = $ManagerModel->where('manager_id', $user['users_id'])->first();

            $session->set('isLoggedIn', true);
            $session->set('username', $user['username']);
            $session->set('managercode', $manager['manager_code']);
           // dd($manager['manager_code']);exit;
            return redirect()->to('manager/dashboard');
            } else {
                // Invalid credentials, show error message
                return redirect()->to('manager_login')->with('error', 'Invalid username or password');
            }
         
        }
        public function index()
        {
            $session = session();
            if (!$session->get('isLoggedIn')) {
                return redirect()->to('manager_login'); // Redirect to login if not logged in
            }
        
            return view('Admin/Manager/dashboard');
        }





            public function logout()
            {
                $session = session();
            
                // Unset session data related to login status
                $session->remove('isLoggedIn');
                $session->remove('username');
            
                // Destroy the session
                $session->destroy();
            
                // Redirect to the login page or any other desired page
                return redirect()->to('manager_login');
            }
            

// ......................tertiary manager...............................
public function Add_Tmanager()

{
    $apts = new ParamModel();
    $data['pts'] = $apts->findAll();
    $data['password_length'] = 8; // Change this to your desired password length
    $data['password'] = random_string('alnum', $data['password_length']);

    $countryModel = new CountryModel();
    $data['countries'] = $countryModel->findAll();
   
    //print_r($data);exit;
$data['pageTitle']='tmanager';
return view('Admin/Manager/tertiary_manager/add_Tmanager',$data);
}
public function Tmanager_listall()
{  
   // dd('f');exit;
$data['pageTitle']='tmanager';
$tmanagers = new TertiarymModel();
$data['tmanagers'] = $tmanagers->orderBy('tmanager_id','ASC')->findAll();
return view('Admin/Manager/tertiary_manager/tertiary_manager',$data);
}

public function Tmanager_save()
{
    {
        $session = session();
        $isLoggedIn = $session->get('isLoggedIn');
        $managercode = $session->get('managercode');
    
        if (!$isLoggedIn || empty($managercode)) {
            return redirect()->to('manager_login')->with('error', 'Please log in to access the dashboard.');
        }
    //dd($managercode);exit;
       // $applicationModel = new ApplicationModel();
       // $applications = $applicationModel->where('referalcode', $agentCode)->where('status','verified')->findAll();
    
        // Pass the applications data to the separate view page
       
    }    $validation = \Config\Services::validation();

    $validation->setRules([
        'email' => 'required|valid_email|is_unique[tertiary_manager.email]',
        // Add other validation rules as needed
    ]);
    if (!$validation->withRequest($this->request)->run()) {
        // Validation failed
        return redirect()->back()->withInput()->with('errors', $validation->getErrors());
    }
//          $email = \Config\Services::email();
     
//            $message='Dear '.$this->request->getPost('username').',

//  Congratulations from Add-Walls! 

//    We happily welcome you into the Add-Walls shareholder family! This is an exciting time for our company, and by registering to the share application form, you have successfully become a proud part of our company. 

// Kindly wait for the approval. We will be contacting you soon regarding the further procedures.

// Thank you!

// For more information: +91 8590562299,+91 4972557173

// Email: admin@addwalls.in

// www.addwalls.in

// WITH REGARDS, 
// ADD-WALLS INFRA SOLUTION LIMITED';
//         // Set email parameters
//         $email->setTo($this->request->getPost('email'));
//         $email->setFrom('admin@addwalls.com','Addwalls');
//         $email->setSubject('Congratulations from Add-Walls!');
//         $email->setMessage($message);
   
//        // Send email
//         if ($email->send()) {
//             //echo 'Email sent successfully.';
//         } else {
//             $data = $email->printDebugger(['headers', 'message']);
//             print_r($data);exit;
//         }
   
   // Send email

$tmanager = new TertiarymModel();
$user = new UserModel();
$apts = new ParamModel(); 
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


$a=$this->request->getVar('tmanagercode');
//dd($a);exit;

$data = ['manager_code'=> $managercode,
'tmanager_code'=> $this->request->getVar('tmanagercode'),
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
//print_r($data);exit;
    $tmanager->insert($data);
    $tmanagerid = $tmanager->getInsertID();
        $apts->find('1');
        $id=['tmanager_code'=>$this->request->getVar('tmanager_id')];
        $apts->update('1',$id);
    $userData = [
        'username' => $data['username'],
        'password' => $data['password'],
        'user_type' => 'tmanager',
        'users_id' =>$tmanagerid,
    ];
    $user->insert($userData);
    return $this->response->redirect(site_url('Addwalls/Tertiarymanager'));
   
}

public function edit_Tmanager($tmanager_id)
{
   // dd('d');
    
    $tmanagermodel = new TertiarymModel();
    $tmanager= $tmanagermodel->find($tmanager_id);
    // Pass the selected names and ID to the view
    if ($tmanager) {
        // Get country name
        $countryName = $tmanagermodel->getCountryNameById($tmanager['country_id']);
        $stateName = $tmanagermodel->getStateNameById($tmanager['state_id']);
        $districtName = $tmanagermodel->getDistrictNameById($tmanager['district_id']);
        $cityName = $tmanagermodel->getCityNameById($tmanager['city_id']);
        
        
    
        // Pass data to the view
        return view('Admin/Manager/tertiary_manager/edit_Tmanager', [
            'tmanager' => $tmanager,
            'countryName' => $countryName,
            'stateName' => $stateName,
            'districtName' => $districtName,
            'cityName' => $cityName,
        ]);
    } else {
        // Handle case where admin data is not found
        return redirect()->to('Addwalls/Tertiarymanager')->with('error', 'Admin not found.');
    }


}

public function update_Tmanager($manager_id)
{
$manager = new TertiarymModel();
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
$country_id = $manager->getCountryIdByName($countryName);
$state_id = $manager->getStateIdByName($stateName);
//dd($state_id);
$district_id = $manager->getDistrictIdByName($districtName);
$city_id = $manager->getCityIdByName($cityName);

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
    'Education'=>$this->request->getPost('education'),
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
$manager->update($manager_id, $data);
$userData = [
    'username' => $data['username'],
    'password' => $data['password'],
   
];
//print_r($userData);exit;
//dd($admin_id);exit;
$user->set($userData)->where('users_id', $manager_id)->update();
return $this->response->redirect(site_url('Addwalls/Tertiarymanager'));
}
public function delete_Tmanager($manager_id)
{
    $user = new UserModel();
$manager = new TertiarymModel();
$deleted =  $manager->delete($manager_id);
$deleted_user = $user->where('users_id', $manager_id)->delete();
// Check if the staff member was successfully deleted
if ($deleted && $deleted_user) {
    // Redirect to a success page or return a success message
    return $this->response->redirect(site_url('Addwalls/Tertiarymanager'));
}


}


public function showtmanagerlogin()
{
    return view('Admin/Manager/tertiary_manager/tertiarymgr_login');
}

public function tmanager_login()
{
   
    //dd('a');exit;
    $session = session();

    $username = $this->request->getPost('username');
    $password = $this->request->getPost('password');
//dd($username);
    // Fetch user by username/email
    $userModel = new UserModel();
    $user = $userModel->where('username', $username)->where('password', $password)->first();
  //  $a=$user['password'];
   // dd($user );exit;
    if ($user !== null && $password === $user['password'] && $user['user_type'] == 'tmanager') {
        // Passwords match, user is authenticated
        $tManagerModel = new TertiarymModel(); // Assuming AgentModel is your model for agents
        $tmanager = $tManagerModel->where('Tmanager_id', $user['users_id'])->first();

        $session->set('isLoggedIn', true);
        $session->set('username', $user['username']);
        $session->set('tmanagercode', $tmanager['tmanager_code']);
       // dd($tmanager['tmanager_code']);exit;
        return redirect()->to('tertiarymanager/dashboard');
        } else {
            // Invalid credentials, show error message
            return redirect()->to('tertiary_manager_login')->with('error', 'Invalid username or password');
        }
     
    }
    public function tmanager_index()
    {
        $session = session();
        if (!$session->get('isLoggedIn')) {
            return redirect()->to('tertiary_manager_login'); // Redirect to login if not logged in
        }
    
        return view('Admin/Manager/tertiary_manager/dashboard');
    }





        public function tmanager_logout()
        {
            $session = session();
        
            // Unset session data related to login status
            $session->remove('isLoggedIn');
            $session->remove('username');
        
            // Destroy the session
            $session->destroy();
        
            // Redirect to the login page or any other desired page
            return redirect()->to('tertiary_manager_login');
        }


        public function showTertiaryManagers($manager_id) {
            // Fetch manager details using $manager_id
            $manager = $this->ManagerModel->getManagerById($manager_id);
        
            if ($manager) {
                // Fetch the manager's manager's code from $manager
                $manager_manager_code = $manager->manager_code;
        
                // Fetch tertiary managers under the manager's manager
                $tertiary_managers = $this->TertiarymModel->getTertiaryManagersByManagerManagerCode($manager_manager_code);
        
                $data['manager'] = $manager;
                $data['tertiary_managers'] = $tertiary_managers;
                return view('Admin/Manager/tertiary_manager/showTmanagers',$data);
            } else {
                echo "Manager not found.";
            }
        }
        
        public function view_tmanager($tmanager_id)
        {
            $tmanagermodel = new TertiarymModel();
            //$history = new PHistoryModel();
            $tmanager= $tmanagermodel->find($tmanager_id);
           // $data['tmanager']= $tmanagermodel->find($tmanager_id);
            $countryName = $tmanagermodel->getCountryNameById($tmanager['country_id']);
            $stateName = $tmanagermodel->getStateNameById($tmanager['state_id']);
            $districtName = $tmanagermodel->getDistrictNameById($tmanager['district_id']);
            $cityName = $tmanagermodel->getCityNameById($tmanager['city_id']);
            $data['pageTitle']='Tertiarymanager/view';
            return view('Admin/Manager/tertiary_manager/view_tmanager',[
                'tmanager' => $tmanager,
                'countryName' => $countryName,
                'stateName' => $stateName,
                'districtName' => $districtName,
                'cityName' => $cityName,
            ]);
        }

       // Admin Controller (Admin.php)

public function show_Managers($admin_id) {
    $managers = $this->ManagerModel->getManagersByAdminId($admin_id); // Fetch managers by admin ID
    $data['managers'] = $managers;

    // Load managers view (assuming you have a view file for managers)
    return view('Admin/Manager/show_managers', $data);
}

        



}
?>