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


Route::match(['get', 'post'], '/', 'ClientController@clientlogin');
Route::match(['get', 'post'], '/register', 'ClientController@registerclient');
Route::get('/home', 'ClientController@home');
Route::get('/apply', 'ClientController@apply');
Route::get('/evaluate', 'ClientController@evaluate');
Route::get('/inspection', 'ClientController@inspection');
Route::get('/inspection2', 'ClientController@inspection2');
Route::get('/inspection3', 'ClientController@inspection3');
Route::get('/issuance', 'ClientController@issuance');
Route::match(['get', 'post'], '/employeelogin', 'LOController@employeelogin');
Route::get('/LOdashboard', 'LOController@LOdashboard');
Route::get('/LOprocess', 'LOController@LOprocess');
Route::get('/LOevaluate', 'LOController@LOevaluate');
Route::get('/LOinspection', 'LOController@LOinspection');
Route::get('/LOinspection2', 'LOController@LOinspection2');
Route::get('/LOinspection3', 'LOController@LOinspection3');
Route::get('/headashboard', 'headController@headash');
Route::get('/LOaccount', 'headController@LOaccount');
Route::get('/headprocess', 'headController@headprocess');
Route::get('/headevaluate', 'headController@headevaluate');
Route::get('/headinspection', 'headController@headinspection');
Route::get('/headinspection2', 'headController@headinspection2');
Route::get('/headinspection3', 'headController@headinspection3');