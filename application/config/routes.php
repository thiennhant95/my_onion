<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/



// デフォルト
$route['default_controller'] = "front/top";
$route['404_override'] = '';

// 管理画面
$route['admin'] = "admin/top";

$route['admin/login'] = "admin/auth";
$route['admin/logout'] = "admin/auth/logout";

//距離
$route['admin/bus-stop'] ="admin/bus_stop";
$route['admin/edit-bus-stop/(:num)'] = "admin/bus_stop/edit/$1";
$route['admin/create-bus-stop'] = "admin/bus_stop/create";

$route['admin/bus-routes'] ="admin/bus_route";
$route['admin/edit-bus-routes/(:num)'] = "admin/bus_route/edit/$1";
$route['admin/create-bus-routes'] = "admin/bus_route/create";

$route['admin/item'] ="admin/item";
$route['admin/edit-item/(:num)'] = "admin/item/edit/$1";
$route['admin/create-item'] = "admin/item/create";

$route['admin/subject'] ="admin/subject";
$route['admin/edit-subject/(:num)'] = "admin/subject/edit/$1";
$route['admin/create-subject'] = "admin/subject/create";

$route['admin/grade'] ="admin/grade";
$route['admin/edit-grade/(:num)'] = "admin/grade/edit/$1";
$route['admin/create-grade'] = "admin/grade/create";

$route['admin/style'] ="admin/style";
$route['admin/edit-style/(:num)'] = "admin/style/edit/$1";
$route['admin/create-style'] = "admin/style/create";

$route['admin/distance'] ="admin/distance";
$route['admin/edit-distance/(:num)'] = "admin/distance/edit/$1";
$route['admin/create-distance'] = "admin/distance/create";

$route['admin/course'] ="admin/course";
$route['admin/edit-course/(:num)'] = "admin/course/edit/$1";
$route['admin/create-course'] = "admin/course/create";

$route['admin/classes'] ="admin/classes";
$route['admin/edit-classes/(:num)'] = "admin/classes/edit/$1";
$route['admin/create-classes'] = "admin/classes/create";

$route['admin/(:any)'] = "admin/$1";

// API
$route['api/(:any)']   = "api/$1";

// バッチ
$route['batch/(:any)'] = "batch/$1";

// その他
$route['(:any)'] = "front/$1";  // この行は最後に書くこと

$route['login'] = "front/auth/login";
$route['logout']  = "front/auth/logout";
$route['auth/forgot-password'] = "front/auth/forgot_password";
/* End of file routes.php */
/* Location: ./application/config/routes.php */