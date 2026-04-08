<?php

defined('BASEPATH') or exit('No direct script access allowed');



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

|	https://codeigniter.com/user_guide/general/routing.html

|

| -------------------------------------------------------------------------

| RESERVED ROUTES

| -------------------------------------------------------------------------

|

| There are three reserved routes:

|

|	$route['default_controller'] = 'welcome';

|

| This route indicates which controller class should be loaded if the

| URI contains no data. In the above example, the "welcome" class

| would be loaded.

|

|	$route['404_override'] = 'errors/page_missing';

|

| This route will tell the Router which controller/method to use if those

| provided in the URL cannot be matched to a valid route.

|

|	$route['translate_uri_dashes'] = FALSE;

|

| This is not exactly a route, but allows you to automatically route

| controller and method names that contain dashes. '-' isn't a valid

| class or method name character, so it requires translation.

| When you set this option to TRUE, it will replace ALL dashes in the

| controller and method URI segments.

|

| Examples:	my-controller/index	-> my_controller/index

|		my-controller/my-method	-> my_controller/my_method

*/

$route['master']  = 'master/controller_ctl';

$route['master/(:any)'] = 'master/controller_ctl/$1';

$route['master/(:any)/(:any)'] = 'master/controller_ctl/$1/$2';


$route['master_function']  = 'master/function_ctl';

$route['master_function/(:any)'] = 'master/function_ctl/$1';

$route['master_function/(:any)/(:any)'] = 'master/function_ctl/$1/$2';

$route['master_function/(:any)/(:any)/(:any)'] = 'master/function_ctl/$1/$2/$3';




$route['submission']  = 'submission/controller_ctl';

$route['submission/(:any)'] = 'submission/controller_ctl/$1';

$route['submission/(:any)/(:any)'] = 'submission/controller_ctl/$1/$2';


$route['submission_function']  = 'submission/function_ctl';

$route['submission_function/(:any)'] = 'submission/function_ctl/$1';

$route['submission_function/(:any)/(:any)'] = 'submission/function_ctl/$1/$2';

$route['submission_function/(:any)/(:any)/(:any)'] = 'submission/function_ctl/$1/$2/$3';





$route['dashboard']  = 'dashboard/controller_ctl/index';

$route['dashboard/(:any)'] = 'dashboard/controller_ctl/$1';

$route['dashboard/(:any)/(:any)'] = 'dashboard/controller_ctl/$1/$2';

$route['report']  = 'dashboard/controller_ctl/report';

$route['report/(:any)'] = 'dashboard/controller_ctl/report/$1';

$route['report/(:any)/(:any)'] = 'dashboard/controller_ctl/report/$1/$2';

$route['dashboard_function']  = 'dashboard/function_ctl';

$route['dashboard_function/(:any)'] = 'dashboard/function_ctl/$1';

$route['dashboard_function/(:any)/(:any)'] = 'dashboard/function_ctl/$1/$2';


// GUEST MANIPUULATION


$route['logout'] = 'guest/function_ctl/logout';

$route['download'] = 'setting/controller_ctl/download';

$route['setting']  = 'setting/controller_ctl';

$route['setting/(:any)'] = 'setting/controller_ctl/$1';

$route['setting/(:any)/(:any)'] = 'setting/controller_ctl/$1/$2';



$route['table']  = 'setting/table_ctl';

$route['table/(:any)'] = 'setting/table_ctl/$1';

$route['table/(:any)/(:any)'] = 'setting/table_ctl/$1/$2';



$route['setting_function']  = 'setting/function_ctl';

$route['setting_function/(:any)'] = 'setting/function_ctl/$1';

$route['setting_function/(:any)/(:any)'] = 'setting/function_ctl/$1/$2';

$route['setting_function/(:any)/(:any)/(:any)'] = 'setting/function_ctl/$1/$2/$3';

$route['setting_function/(:any)/(:any)/(:any)/(:any)'] = 'setting/function_ctl/$1/$2/$3/$4';

$route['setting_function/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'setting/function_ctl/$1/$2/$3/$4/$5';




$route['profile']  = 'setting/controller_ctl/profile';

$route['profile/(:any)'] = 'setting/controller_ctl/profile/$1';

$route['profile/(:any)/(:any)'] = 'setting/controller_ctl/profile/$1/$2';



$route['log']  = 'dashboard/controller_ctl/log';

$route['log/(:any)'] = 'dashboard/controller_ctl/log/$1';

$route['log/(:any)/(:any)'] = 'dashboard/controller_ctl/log/$1/$2';



$route['auth']  = 'auth/controller_ctl/index';

$route['auth/(:any)'] = 'auth/controller_ctl/$1';

$route['auth/(:any)/(:any)'] = 'auth/controller_ctl/$1/$2';

$route['auth_function']  = 'auth/function_ctl';

$route['auth_function/(:any)'] = 'auth/function_ctl/$1';

$route['auth_function/(:any)/(:any)'] = 'auth/function_ctl/$1/$2';

$route['login'] = 'auth/controller_ctl/login';

$route['logqr'] = 'auth/function_ctl/login_qr';
$route['logqr/(:any)'] = 'auth/function_ctl/login_qr/$1';

$route['logout'] = 'auth/function_ctl/logout';


$route['default_controller'] = 'auth/controller_ctl/login';
// DEFAULT PAGE


$route['404_override'] = '';


$route['translate_uri_dashes'] = TRUE;
