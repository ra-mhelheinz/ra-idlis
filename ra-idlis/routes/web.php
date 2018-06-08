<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::match(['get', 'post'], '/', 'ClientController@clientlogin')->name('client');
Route::match(['get', 'post'], '/register', 'ClientController@registerclient');

Route::get('client/home', 'ClientController@home');
Route::get('client/apply/lop','ClientController@LOP');
Route::get('client/apply/sa','ClientController@SA');
Route::get('client/apply', 'ClientController@apply');
Route::get('client/evaluate', 'ClientController@evaluate');
Route::get('client/orderofpaymentc', 'ClientController@orderofpaymentc');
Route::get('client/inspection', 'ClientController@inspection');
Route::get('client/inspection2', 'ClientController@inspection2');
Route::get('client/inspection3', 'ClientController@inspection3');
Route::get('client/issuance', 'ClientController@issuance');
Route::post('client/logout', 'ClientController@logout');

Route::get('/LOdashboard', 'LOController@LOdashboard');
Route::get('/LOprocess', 'LOController@LOprocess');
Route::get('/LOevaluate', 'LOController@LOevaluate');
Route::get('/LOinspection', 'LOController@LOinspection');
Route::get('/LOinspection2', 'LOController@LOinspection2');
Route::get('/LOinspection3', 'LOController@LOinspection3');
Route::get('/LOorderofpayment', 'LOController@LOorderofpayment');
Route::get('/LOorderofpayment2', 'LOController@LOorderofpayment2');
Route::get('/LOorderofpayment3', 'LOController@LOorderofpayment3');
Route::get('/LOorderofpayment4', 'LOController@LOorderofpayment4');
Route::get('/LOorderofpayment5', 'LOController@LOorderofpayment5');
Route::get('/LOorderofpayment6', 'LOController@LOorderofpayment6');
Route::get('/headashboard', 'headController@headash');
Route::get('/LOaccount', 'headController@LOaccount');
Route::get('/headprocess', 'headController@headprocess');
Route::get('/headevaluate', 'headController@headevaluate');
Route::get('/headorderofpayment', 'headController@headorderofpayment');
Route::get('/headorderofpayment2', 'headController@headorderofpayment2');
Route::get('/headorderofpayment3', 'headController@headorderofpayment3');
Route::get('/headorderofpayment4', 'headController@headorderofpayment4');
Route::get('/headorderofpayment5', 'headController@headorderofpayment5');
Route::get('/headorderofpayment6', 'headController@headorderofpayment6');
Route::get('/headinspection', 'headController@headinspection');
Route::get('/headinspection2', 'headController@headinspection2');
Route::get('/headinspection3', 'headController@headinspection3');

Route::match(['get', 'post'], '/employee/', 'DOHController@login')->name('employee');
Route::get('/employee/dashboard', 'DOHController@dashboard')->name('eDashboard');
Route::match(['get', 'post'], 'employee/dashboard/personnel/regional', 'DOHController@regionalAdmins')->name('regAdmins');
Route::match(['get', 'post'], 'employee/dashboard/personnel/lo', 'DOHController@LOfficers')->name('regAdmins');
Route::match(['get', 'post'],'employee/dashboard/grouprights','DOHController@groupRights')->name('grpRights');
Route::post('/employee/logout','DOHController@logout');
Route::match(['get', 'post'],'/employee/dashboard/ph/regions','DOHController@regions')->name('philRegions');
Route::match(['get', 'post'],'/employee/dashboard/ph/provinces','DOHController@provinces')->name('philProvinces');
Route::post('employee/getRights', 'DOHController@getSettings2');
Route::post('/employee/grprights/check','DOHController@chckgr');
Route::get('/employee/dashboard/lps','DOHController@lps');
Route::get('/employee/dashboard/lps/evalute','DOHController@evalute');
Route::get('/employee/dashboard/lps/evalute/ins/1','DOHController@ins1');
Route::get('/employee/dashboard/lps/evalute/ins/2','DOHController@ins2');
Route::get('/employee/dashboard/lps/evalute/ins/3','DOHController@ins3');
// -----------------------------------------------
Route::post('/ph/get_province', ['as'=>'select-province','uses'=>'ajaxController@selectProvince']);
Route::post('/employee/get_rights', ['as'=>'get-rights','uses'=>'ajaxController@getRights']);
Route::post('/employee/save_rights', ['as'=>'save-rights','uses'=>'ajaxController@saveRights']);
