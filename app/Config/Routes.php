<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

<<<<<<< HEAD
$routes->group('backend', function ($routes) {
$routes->get('/', 'Home::index');
$routes->post('authenticate', 'CoreController::authenticate');
$routes->post('upload_excel', 'CoreController::upload_excel');
$routes->post('searchLeave', 'CoreController::searchLeave');
$routes->get('userdashboard', 'CoreController::userdashboard');
$routes->get('userleaves', 'CoreController::userleaves');
$routes->post('applyLeave', 'CoreController::applyLeave');
$routes->get('applyLeave', 'CoreController::applyLeave');
$routes->post('createEmployee', 'CoreController::createEmployee');
=======

$routes->get('/', 'LoginController::index');  // login page
$routes->get('/login', 'LoginController::index');  // Login page


$routes->post('login/authenticate', 'LoginController::authenticate');  
$routes->get('logout', 'LoginController::logout');  


$routes->get('admin/dashboard', 'AdminController::dashboard');  
$routes->get('user/dashboard', 'UserController::dashboard');  


$routes->get('admin/employee_create', 'EmployeeController::employee_create');
$routes->post('employee_create/save_employee', 'EmployeeController::save_employee');
$routes->get('employee_create/save_employee', 'EmployeeController::save_employee');  
$routes->get('/dashboard','EmployeeController::index');


$routes->get('admin/employeeview', 'AdminController::view'); 
$routes->get('employee_delete/(:num)', 'AdminController::delete_employee/$1');
$routes->get('employee_edit/(:num)', 'AdminController::edit_employee/$1');
$routes->post('employee_update/(:num)', 'AdminController::employee_update/$1');


$routes->get('admin/attendance', 'AttendanceController::index');
$routes->post('admin/attendance', 'AttendanceController::upload');
$routes->post('attendance/upload', 'AttendanceController::upload');


$routes->get('/admin/search_employees', 'AdminController::search_employees');


$routes->get('admin/leaves', 'LeaveCont::index');
$routes->match(['get', 'post'], 'leaves/applyLeave', 'LeaveCont::applyLeave');
$routes->get('leaves/acceptLeave/(:num)', 'LeaveCont::acceptLeave/$1');
$routes->get('leaves/rejectLeave/(:num)', 'LeaveCont::rejectLeave/$1');


$routes->get('admin/holiday', 'HolidayController::index');
$routes->post('admin/holiday', 'HolidayController::upload');
$routes->post('holiday/upload', 'HolidayController::upload');


$routes->get('admin/logout', 'AdminController::logout');
$routes->post('admin/logout', 'AdminController::logout');




>>>>>>> 850ee1497789adeffdc38680989f18a9f64a3c26




<<<<<<< HEAD
$routes->get('admin/dashboard', 'CoreController::admindashboard');
// $routes->get('admin/employee_create','CoreController::create');
$routes->get('admin/employee_create','CoreController::employee_create');
$routes->post('employee_create/save_employee', 'CoreController::save_employee');
$routes->get('employee_create/save_employee', 'CoreController::save_employee');  
$routes->post('employee_create/upload_excel', 'CoreController::upload_excel');
$routes->get('employee_create/upload_excel', 'CoreController::upload_excel');

$routes->get('admin/attendance', 'CoreController::attendance');
$routes->post('admin/attendance', 'CoreController::attendance');
$routes->post('admin/attendance/upload', 'CoreController::upload');
$routes->match(['get', 'post'], 'admin/monthly-attendance/(:num)/(:any)/(:num)','CoreController::monthlyAttendance/$1/$2/$3');

$routes->get('admin/adminleaves','CoreController::adminleaves');


});


$routes->group('api', function ($routes) {
    $routes->post('login', 'AuthController::login'); // Public login route

    $routes->group('', ['filter' => 'csrfAuth'], function ($routes) {
        $routes->get('example', 'ExampleController::index'); // Protected route
        $routes->post('example', 'ExampleController::create'); // Protected route
    });
});
=======
>>>>>>> 850ee1497789adeffdc38680989f18a9f64a3c26



