<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
/**
 * ------------------------------------------------------------------
 * LavaLust - an opensource lightweight PHP MVC Framework
 * ------------------------------------------------------------------
 *
 * MIT License
 * 
 * Copyright (c) 2020 Ronald M. Marasigan
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package LavaLust
 * @author Ronald M. Marasigan <ronald.marasigan@yahoo.com>
 * @copyright Copyright 2020 (https://ronmarasigan.github.io)
 * @since Version 1
 * @link https://lavalust.pinoywap.org
 * @license https://opensource.org/licenses/MIT MIT License
 */

/*
| -------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------
| Here is where you can register web routes for your application.
|
|
*/

//$router->get('/', 'Welcome::index');
$router->get('/try', 'Main::try');

$router->get('/', 'Main::index');
$router->get('about', 'Main::about');
$router->get('book/(:num)', 'Main::book');
$router->get('appointment/(:num)', 'Main::appointment');
$router->get('spa', 'Main::spa');
$router->get('resorts', 'Main::resorts');
$router->get('apartments', 'Main::apartments');
$router->get('admin', 'Main::admin');
$router->get('admin_register', 'Main::admin_register');
$router->get('login', 'Main::login');
$router->get('register', 'Main::register');
$router->get('verify', 'Main::verify');
$router->get('recovery', 'Main::recovery');

$router->post('query', 'Mailing::query');
$router->post('subscribe', 'Mailing::subscribe');
$router->get('admin_emails_send', 'Mailing::email');
$router->post('send_an_email', 'Mailing::send');
$router->get('admin_subscription_subscribers', 'Mailing::subs');
$router->post('subscription_email', 'Mailing::subs_send');
$router->match('(:any)/subscriber/(:num)', 'Mailing::update', 'GET|POST');
$router->match('(:any)/subscriber/(:num)', 'Mailing::update', 'GET|POST');

$router->post('verifying', 'Authentication::verify');
$router->match('auth', 'Authentication::login', 'GET|POST');
$router->match('registernew', 'Authentication::register', 'GET|POST');
$router->get('logout', 'Authentication::logout');
$router->post('recovering', 'Authentication::recovering');
$router->post('recover', 'Authentication::recover');

$router->match('account', 'Account_Info::get_userinfo', 'GET|POST');
$router->get('bookings', 'Account_Info::bookings');
$router->get('booking/(:any)', 'Account_Info::booking');
$router->get('booking/cancelled/(:any)', 'Account_Info::cancel');
$router->get('booking/reapplied/(:any)', 'Account_Info::reapply');
$router->get('payment/(:any)', 'Account_Info::payment');
$router->post('pay', 'Account_Info::pay');
$router->match('book_save', 'Account_Info::book', 'GET|POST');
$router->match('appointment_save', 'Account_Info::appointment', 'GET|POST');
$router->match('editprofile', 'Account_Info::edit_info', 'GET|POST');
$router->match('admin_account', 'Account_Info::get_userinfo', 'GET|POST');


$router->get('admin_apartment_manage', 'Apartment::manage');
$router->get('admin_apartment_reservations', 'Apartment::reservation'); 
$router->get('editroom_ap/(:num)', 'Apartment::edit');
$router->get('delroom_ap/(:num)', 'Apartment::delete');
$router->match('managerooms_ap', 'Apartment::save', 'GET|POST');
$router->get('editres_ap/(:num)', 'Apartment::res');
$router->match('manageres_ap', 'Apartment::save_res', 'GET|POST');

$router->get('admin_resort_manage', 'resort::manage');
$router->get('admin_resort_reservations', 'resort::reservation'); 
$router->get('editroom_res/(:num)', 'resort::edit');
$router->get('delroom_res/(:num)', 'resort::delete');
$router->match('managerooms_res', 'resort::save', 'GET|POST');
$router->get('editres_res/(:num)', 'resort::res');
$router->match('manageres_res', 'resort::save_res', 'GET|POST');


$router->get('admin_spa_manage', 'spa::manage');
$router->get('admin_spa_reservations', 'spa::reservation'); 
$router->get('editservices/(:num)', 'spa::edit');
$router->get('delservices/(:num)', 'spa::delete');
$router->match('manageservices', 'spa::save', 'GET|POST');
$router->get('editappointments/(:num)', 'spa::app');
$router->match('manageappointments', 'spa::save_app', 'GET|POST');

$router->get('admin_tourists_manage', 'Users::t_manage');
$router->match('active/(:num)', 'Users::active', 'GET|POST');
$router->match('ban/(:num)', 'Users::ban', 'GET|POST');
$router->get('admin_admin_manage', 'Users::a_manage');


