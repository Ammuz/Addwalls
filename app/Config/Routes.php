<?php

use CodeIgniter\Router\RouteCollection;


/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('Applications', 'ApplicationController::index' ,['as'=>'Applications']);
$routes->post('shareholder/save', 'ApplicationController::save',['as'=>'shareholder/save']);
$routes->get('Applications/view/(:any)','ApplicationController::view/$1');
$routes->post('Applicationss/update/(:any)','ApplicationController::update/$1');
// $routes->post('Applications/checkEmail', 'ApplicationController::checkEmail',['as'=>'Applications/checkEmail']);
$routes->post('Applications/checkMobile', 'ApplicationController::checkMobile',['as'=>'Applications/checkMobile']);
$routes->post('Applications/checkUsername', 'ApplicationController::checkUsername',['as'=>'Applications/checkUsername']);
$routes->get('shareholder/view/(:any)','ApplicationController::view_shareholder/$1');
$routes->get('Applications/delete/(:num)', 'ApplicationController::delete_application/$1');




$routes->get('Addwalls/Agent','ApplicationController::A_Add',['as'=>'Addwalls.Agent']);
$routes->post('Agents/asave','ApplicationController::asave',['as'=>'Agents/asave']);
$routes->get('Addwalls/Agents','ApplicationController::A_listall',['as'=>'Addwalls/Agents']);
$routes->post('Addwalls/getAgents', 'ApplicationController::getAgents');
$routes->get('agent/edit/(:num)', 'ApplicationController::edit_agent/$1');
$routes->post('agent/update/(:num)', 'ApplicationController::update_agent/$1');
$routes->get('agent/delete/(:num)', 'ApplicationController::delete_agent/$1');
$routes->get('show/agents/(:num)', 'ApplicationController::showAgents/$1');
$routes->get('show/shareholders/(:num)', 'ApplicationController::showShareholdres/$1');
$routes->get('agent/view/(:any)','ApplicationController::view_agent/$1');

// ........................Agent-login...........................
$routes->get('agents/login', 'ApplicationController::showagentlogin');
$routes->post('agent/login', 'ApplicationController::agent_login');
$routes->get('agent/dashboard', 'ApplicationController::agent_index');
$routes->get('agent/logout', 'ApplicationController::agent_logout');
$routes->get('agent/applications', 'ApplicationController::agent_applications');






// ........................Superadmin-login...........................
// $routes->get('adminlogin', 'AdminController::showadminlogin');
// $routes->post('admin/login', 'AdminController::login');
$routes->get('superadmin/dashboard', 'Superadmin\SadminController::index');
$routes->get('admin/logout', 'AdminController::logout');






// .................................staffcategory..........................................
$routes->get('Addwalls/staffcategory','ApplicationController::staff_Add',['as'=>'Addwalls.staff']);
$routes->post('staff/save','ApplicationController::staffsave',['as'=>'staff/ssave']);
$routes->get('Addwalls/staffcategorys','ApplicationController::staff_listall',['as'=>'Addwalls/staffcategorys']);
$routes->post('Addwalls/getAgents', 'ApplicationController::getAgents');
$routes->get('staffcategorys/edit/(:num)', 'ApplicationController::edit_staffcategorys/$1');
$routes->post('staff/update/(:num)', 'ApplicationController::updateStaff/$1');
$routes->get('staff/delete/(:num)', 'ApplicationController::delete_staff/$1');


// .............................admin....................................
$routes->get('Addwalls/Admin','ApplicationController::admin_Add',['as'=>'Addwalls.admin']);
$routes->post('Admin/save','ApplicationController::adminsave',['as'=>'admin/ssave']);
$routes->get('Addwalls/admins','ApplicationController::admin_listall',['as'=>'Addwalls/admins']);
$routes->get('admin/edit/(:num)', 'ApplicationController::edit_admin/$1');
$routes->post('admin/update/(:num)', 'ApplicationController::update_admin/$1');
$routes->get('admin/delete/(:num)', 'ApplicationController::delete_admin/$1');
$routes->post('admin/get_states', 'ApplicationController::getStates');
$routes->post('admin/get_districts', 'ApplicationController::getDist');
$routes->post('admin/get_cities', 'ApplicationController::getcity');
$routes->post('admin/checkEmail', 'ApplicationController::checkEmail');


// .................................divident.............................
$routes->get('Addwalls/dividend','Admin\DividendController::dividend_listall');
$routes->get('Addwalls/dividends','Admin\DividendController::dividend_add');
$routes->post('dividend/save','Admin\DividendController::dividend_save');
$routes->get('dividend/edit/(:num)', 'Admin\DividendController::edit_dividend/$1');
$routes->post('dividend/update/(:num)', 'Admin\DividendController::update_dividend/$1');
$routes->get('dividend/delete/(:num)', 'Admin\DividendController::delete_dividend/$1');


// .................................agent bonus.............................
$routes->get('Addwalls/agentbonus','Admin\AgentbonusController::bonus_listall');
$routes->get('Addwalls/agents_bonus','Admin\AgentbonusController::bonus_add');
$routes->post('bonus/save','Admin\AgentbonusController::bonus_save');
$routes->get('bonus/edit/(:num)', 'Admin\AgentbonusController::edit_bonus/$1');
$routes->post('bonus/update/(:num)', 'Admin\AgentbonusController::update_bonus/$1');
$routes->get('bonus/delete/(:num)', 'Admin\AgentbonusController::delete_bonus/$1');



// ........................admin-login...........................
$routes->get('adminlogin', 'AdminController::showadminlogin');
$routes->post('admin/login', 'AdminController::login');
$routes->get('admin/dashboard', 'AdminController::index');
$routes->get('admin/logout', 'AdminController::logout');


// .............................Manager....................................
$routes->get('Addwalls/manager','Admin\ManagerController::manager_listall');
$routes->get('Addwalls/managers','Admin\ManagerController::Add_manager');
$routes->post('manager/save','Admin\ManagerController::manager_save');
$routes->get('manager/edit/(:num)', 'Admin\ManagerController::edit_manager/$1');
$routes->post('manager/update/(:num)', 'Admin\ManagerController::update_manager/$1');
$routes->get('manager/delete/(:num)', 'Admin\ManagerController::delete_manager/$1');
$routes->post('manager/get_states', 'Admin\ManagerController::getStates');
$routes->post('manager/get_districts', 'Admin\ManagerController::getDist');
$routes->post('manager/get_cities', 'Admin\ManagerController::getcity');
$routes->post('manager/checkEmail', 'Admin\ManagerController::checkEmail');
$routes->get('show/tmanager/(:num)', 'Admin\ManagerController::showTertiaryManagers/$1');
$routes->get('tmanager/view/(:any)','Admin\ManagerController::view_tmanager/$1');
$routes->get('show_manager/(:num)', 'Admin\ManagerController::show_Managers/$1');


// ........................manager-login...........................
$routes->get('manager/login', 'Admin\ManagerController::showmanagerlogin');
$routes->post('manager/login', 'Admin\ManagerController::login');
$routes->get('manager/dashboard', 'Admin\ManagerController::index');
$routes->get('manager/logout', 'Admin\ManagerController::logout');



// .............................tertiary_Manager....................................
$routes->get('Addwalls/Tertiarymanager','Admin\ManagerController::Tmanager_listall');
$routes->get('Addwalls/tertiary_managers','Admin\ManagerController::Add_Tmanager');
$routes->post('tertiary_manager/save','Admin\ManagerController::Tmanager_save');
$routes->get('tertiarymanager/edit/(:num)', 'Admin\ManagerController::edit_Tmanager/$1');
$routes->post('tertiary_manager/update/(:num)', 'Admin\ManagerController::update_Tmanager/$1');
$routes->get('tertiarymanager/delete/(:num)', 'Admin\ManagerController::delete_Tmanager/$1');
$routes->post('manager/get_states', 'Admin\ManagerController::getStates');
$routes->post('manager/get_districts', 'Admin\ManagerController::getDist');
$routes->post('manager/get_cities', 'Admin\ManagerController::getcity');
$routes->post('manager/checkEmail', 'Admin\ManagerController::checkEmail');

// ........................tertiary_manager-login...........................
$routes->get('tertiarymanagers/login', 'Admin\ManagerController::showtmanagerlogin');
$routes->post('tertiarymanager/login', 'Admin\ManagerController::tmanager_login');
$routes->get('tertiarymanager/dashboard', 'Admin\ManagerController::tmanager_index');
$routes->get('tertiarymanager/logout', 'Admin\ManagerController::tmanager_logout');






if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

?>
