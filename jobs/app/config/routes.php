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


$route['default_controller'] = "home";
$route['404_override'] = '';

$route['login'] = "home/login";
$route['logout'] = "home/logout";
$route['forget'] = "home/forget";
$route['register'] = "home/register";
$route['register_success'] = "home/register_success";
$route['activate'] = "home/activate";
$route['password_reset'] = "home/password_reset";
$route['checkout'] = "home/checkout";
$route['news'] = "home/news";

$route['addtocart'] = "home/addtocart";
$route['cases'] = "home/cases";
$route['details'] = "home/details";
$route['create_case'] = "home/create_case";
$route['create'] = "home/create";
$route['companies'] = "home/companies";
$route['about'] = "home/about";
$route['contactus'] = "home/contactus";

$route['account'] = "account/index";
$route['account/update'] = "account/update";
$route['account/paid'] = "account/paid";
$route['account/cases'] = "account/cases";
$route['account/cart'] = "account/cart";
$route['account/changepw'] = "account/changepw";
$route['account/cart-empty'] = "account/cart_empty";
$route['account/cart-delete'] = "account/cart_delete";
$route['account/bought'] = "account/bought";
$route['account/view_invoice'] = "account/view_invoice";
$route['account/pdf'] = "account/pdf";


/* End of file routes.php */
/* Location: ./application/config/routes.php */