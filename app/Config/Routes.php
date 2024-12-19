<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->get('/', 'LoginController::index');  // login page
$routes->get('/login', 'LoginController::index');  // Login page


$routes->post('login/authenticate', 'LoginController::authenticate');  
$routes->get('logout', 'LoginController::logout');  


$routes->get('admin/dashboard', 'AdminController::dashboard');  
$routes->get('user/dashboard', 'UserController::dashboard');  


$routes->get('admin/employee_create', 'EmployeeController::employee_create');
$routes->post('employee_create/save_employee', 'EmployeeController::save_employee');
$routes->get('/dashboard', 'EmployeeController::index');


$routes->get('admin/attendance', 'AttendanceController::index');
$routes->post('admin/attendance', 'AttendanceController::upload');
$routes->post('attendance/upload', 'AttendanceController::upload');


$routes->get('admin/leaves', 'LeaveCont::index');
$routes->match(['get', 'post'], 'leaves/applyLeave', 'LeaveCont::applyLeave');
$routes->get('leaves/acceptLeave/(:num)', 'LeaveCont::acceptLeave/$1');
$routes->get('leaves/rejectLeave/(:num)', 'LeaveCont::rejectLeave/$1');


$routes->get('admin/holiday', 'HolidayController::index');
$routes->post('admin/holiday', 'HolidayController::upload');
$routes->post('holiday/upload', 'HolidayController::upload');








