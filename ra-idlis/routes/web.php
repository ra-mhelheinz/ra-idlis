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

Route::post('/getRPMB', ['as'=>'reancy','uses'=>'ClientController@loadAllRPMB']);
Route::get('loadTbl/{tbl}/{col}/{id}', 'ClientController@loadCurrTbl');

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
Route::get('client/apply2', 'ClientController@apply2');

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
// ----------------------------------------------- DOH Controller
Route::match(['get', 'post'], '/employee/', 'DOHController@login')->name('employee');
Route::match(['get', 'post'], '/employee/dashboard/personnel/regional', 'DOHController@regionalAdmins')->name('regAdmins');
Route::match(['get', 'post'], '/employee/dashboard/personnel/lo', 'DOHController@LOfficers')->name('regOfficer');
Route::match(['get', 'post'], '/employee/dashboard/personnel/fda', 'DOHController@FDAs')->name('regFDA');
Route::match(['get', 'post'],'/employee/dashboard/grouprights','DOHController@groupRights')->name('grpRights');
Route::match(['get', 'post'],'/employee/dashboard/ph/regions','DOHController@regions')->name('philRegions');
Route::match(['get', 'post'],'/employee/dashboard/ph/provinces','DOHController@provinces')->name('philProvinces');
Route::match(['get', 'post'],'/employee/dashboard/ph/citymuni','DOHController@CityMuni')->name('philCityMuni');
Route::match(['get', 'post'],'/employee/dashboard/ph/barangay','DOHController@Brgy')->name('philBarangay');
Route::match(['get', 'post'],'/employee/dashboard/mf/class','DOHController@ClassType')->name('mfClass');
Route::match(['get', 'post'],'/employee/dashboard/mf/facility','DOHController@FaType')->name('mfFacility');
Route::match(['get', 'post'],'/employee/dashboard/mf/faciservtype','DOHController@FaServType')->name('mfFaServType');
//
Route::match(['get', 'post'],'/employee/dashboard/mf/apptype','DOHController@AppType')->name('mfAppType');
Route::match(['get', 'post'],'/employee/dashboard/mf/ownership','DOHController@OwnShip')->name('mfOwnShip');
Route::match(['get', 'post'],'/employee/dashboard/mf/litype','DOHController@LiType')->name('mfLiType');
Route::match(['get', 'post'],'/employee/dashboard/mf/training','DOHController@Train')->name('mfTrain');
Route::match(['get', 'post'],'/employee/dashboard/mf/department','DOHController@Dept')->name('mfDept');
Route::match(['get', 'post'],'/employee/dashboard/mf/section','DOHController@Sec')->name('mfSec');
Route::match(['get', 'post'],'/employee/dashboard/mf/uploads','DOHController@Upload')->name('mfUpload');
Route::match(['get', 'post'],'/employee/dashboard/mf/work_status','DOHController@WorkStatus')->name('mfWorkStatus');
Route::match(['get', 'post'],'/employee/dashboard/mf/work','DOHController@Work')->name('mfWork');
Route::match(['get', 'post'],'/employee/dashboard/mf/part','DOHController@Part')->name('mfPart');
Route::match(['get', 'post'],'/employee/dashboard/mf/assessment','DOHController@AsMent')->name('mfAsMent');
Route::match(['get', 'post'],'/employee/dashboard/mf/personnel','DOHController@PerSoNel')->name('mfPersonnel');
Route::match(['get', 'post'],'/employee/dashboard/pf/view','DOHController@PfView')->name('pfView');
Route::post('/employee/logout','DOHController@logout');
Route::post('employee/getRights', 'DOHController@getSettings2');
Route::post('/employee/grprights/check','DOHController@chckgr');
Route::get('/employee/dashboard', 'DOHController@dashboard')->name('eDashboard');
Route::get('/employee/dashboard/lps','DOHController@lps');
Route::get('/employee/dashboard/lps/evalute','DOHController@evalute');
Route::get('/employee/dashboard/lps/evalute/ins/1','DOHController@ins1');
Route::get('/employee/dashboard/lps/evalute/ins/2','DOHController@ins2');
Route::get('/employee/dashboard/lps/evalute/ins/3','DOHController@ins3');
// ----------------------------------------------- DOH Controller
// ----------------------------------------------- Ajax Controller
// -------------------------------------- GET
Route::post('/ph/get_province', ['as'=>'select-province','uses'=>'ajaxController@selectProvince']);
Route::post('/ph/get_brgy', ['as'=>'select-brgy','uses'=>'ajaxController@selectBrgy']);
Route::post('mf/getUploads',['as'=>'select-uploads','uses'=>'ajaxController@selectUploads']);
Route::post('/mf/getClass', ['as'=>'get-class','uses'=>'ajaxController@getClass']);\
Route::post('/employee/get_rights', ['as'=>'get-rights','uses'=>'ajaxController@getRights']);
// -------------------------------------- GET
// -------------------------------------- UPDATE
Route::post('/employee/save_rights', ['as'=>'save-rights','uses'=>'ajaxController@saveRights']);
Route::post('/personnel/isActive', ['as'=>'isActive','uses'=>'ajaxController@isActive']);
Route::post('/mf/save_aptype', ['as'=>'save-AppType','uses'=>'ajaxController@saveAppType']);
Route::post('/mf/save_class', ['as'=>'save-Class','uses'=>'ajaxController@saveClass']);
Route::post('/mf/save_faaptype', ['as'=>'save-FaType','uses'=>'ajaxController@saveFaType']);
Route::post('/mf/save_oship', ['as'=>'save-OShip','uses'=>'ajaxController@saveOShip']);
Route::post('/mf/save_plicense', ['as'=>'save-PLicense','uses'=>'ajaxController@savePLicense']);
Route::post('/mf/save_ptrain', ['as'=>'save-PTrain','uses'=>'ajaxController@savePTrain']);
Route::post('/mf/save_upload', ['as'=>'save-Upload','uses'=>'ajaxController@saveUpload']);
Route::post('/mf/save_dept', ['as'=>'save-Dept','uses'=>'ajaxController@saveDept']);
Route::post('/mf/save_section', ['as'=>'save-Sec', 'uses'=> 'ajaxController@saveSect']);
Route::post('/mf/save_pworkstats', ['as'=>'save-PworkStats', 'uses'=> 'ajaxController@saveWorkStats']);
Route::post('/mf/save_pwork', ['as'=>'save-Pwork', 'uses'=> 'ajaxController@saveWork']);
Route::post('/mf/save_part', ['as'=>'save-Part', 'uses'=> 'ajaxController@savePart']);
Route::post('/mf/save_asmt', ['as'=>'save-AsMt', 'uses'=> 'ajaxController@saveAsMt']);
Route::post('/mf/save_hfst', ['as'=>'save-HfsT', 'uses'=> 'ajaxController@saveHfst']);
// -------------------------------------- UPDATE
// -------------------------------------- DELETE
Route::post('/mf/del_aptype', ['as'=>'del-AppType','uses'=>'ajaxController@delAppType']);
Route::post('/mf/del_class', ['as'=>'del-Class','uses'=>'ajaxController@delClass']);
Route::post('/mf/del_FaType', ['as'=>'del-FaType','uses'=>'ajaxController@delFaType']);
Route::post('/mf/del_oship', ['as'=>'del-OShip','uses'=>'ajaxController@delOShip']);
Route::post('/mf/del_plicense', ['as'=>'del-PLicense','uses'=>'ajaxController@delPLicense']);
Route::post('/mf/del_ptrain', ['as'=>'del-PTrain','uses'=>'ajaxController@delTrain']);
Route::post('/mf/del_upload', ['as'=>'del-Upload','uses'=>'ajaxController@delUpload']);
Route::post('/mf/del_dept', ['as'=>'del-Dept','uses'=>'ajaxController@delDept']);
Route::post('/mf/del_sec', ['as'=>'del-Sec','uses'=>'ajaxController@delSect']);
Route::post('/mf/del_pworkstats', ['as'=>'del-PworkStats','uses'=>'ajaxController@delWorkStats']);
Route::post('/mf/del_pwork', ['as'=>'del-Pwork','uses'=>'ajaxController@delWork']);
Route::post('/mf/del_part', ['as'=>'del-Part','uses'=>'ajaxController@delPart']);
Route::post('/mf/del_asmt', ['as'=>'del-AsMt','uses'=>'ajaxController@delAsMt']);
Route::post('/mf/del_hfst', ['as'=>'del-HfsT','uses'=>'ajaxController@delHfst']);
// -------------------------------------- DELETE
// ----------------------------------------------- Ajax Controller
