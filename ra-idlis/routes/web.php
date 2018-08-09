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
Route::match(['get', 'post'], '/store', 'ClientController@store');
Route::post('/getRPMB', ['as'=>'reancy','uses'=>'ClientController@loadAllRPMB']);
Route::get('loadTbl/{tbl}/{col}/{id}', 'ClientController@loadCurrTbl');
Route::get('/register/verify/{id}','ClientController@verify_account');
Route::get('/resend/{id}','MailController@resend_ver');
Route::get('client/deleteform/{id}','ClientController@del_form');
Route::get('client/deldraft','ClientController@del_draft')->name('client.deldraft');
Route::get('client/apply/form/{col}/{id}','ClientController@op_form');

Route::match(['get', 'post'], '/', 'ClientController@clientlogin')->name('client');
Route::match(['get', 'post'], '/register', 'MailController@auto_mailer');

Route::get('client/home', 'ClientController@home')->name('client.home');
Route::get('client/apply/lop','ClientController@LOP');
Route::match(['get', 'post'], '/client/apply/form/{id_type}', 'ClientController@FORM');
Route::match(['get', 'post'], '/client/personnel/form/{id_type}', 'ClientController@addpersonnel');
Route::view('/mailTest2', 'mail4SystemUsers');

// Route::match(['get', 'post'], '/client/apply/form', 'ClientController@FORM');
Route::match(['get', 'post'], '/client/apply/ptc', 'ClientController@PTC');
Route::match(['get', 'post'], '/client/apply/con', 'ClientController@CON');
Route::match(['get', 'post'], '/client/apply/lto', 'ClientController@LTO');
Route::match(['get', 'post'], '/client/apply/coa', 'ClientController@COA');
Route::match(['get', 'post'], '/client/apply/ato', 'ClientController@ATO');
Route::get('client/apply/sa','ClientController@SA');
Route::get('client/apply', 'ClientController@apply');
Route::get('client/status', 'ClientController@status');
Route::match(['get', 'post'], 'client/preassessment', 'ClientController@preassessment');
Route::match(['get', 'post'], 'client/preassessment2', 'ClientController@preassessment2');
Route::match(['get', 'post'], 'client/preassessment2/{status}', 'ClientController@preassesscompletion')->name('client.completion');
Route::match(['get', 'post'], 'client/preassessment2/draft/{draft}', 'ClientController@preassessdraft');
Route::get('client/evaluate', 'ClientController@evaluate');
Route::get('client/orderofpaymentc', 'ClientController@orderofpaymentc');
Route::get('client/inspection', 'ClientController@inspection');
Route::get('client/inspection2', 'ClientController@inspection2');
Route::get('client/inspection3', 'ClientController@inspection3');
Route::get('client/issuance', 'ClientController@issuance');
Route::post('client/logout', 'ClientController@logout');
Route::post('client/store', 'ClientController@store');
Route::match(['get', 'post'], 'client/payment', 'ClientController@payment');

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
//
Route::get('employee/verify/{id}', 'DOHController@verify_account');
Route::get('employee/resend/{id}','DOHController@resend_ver');
Route::match(['get', 'post'], '/employee/dashboard/act_logs', 'DOHController@ActLogs')->name('setActLogs');
Route::match(['get', 'post'], '/employee/', 'DOHController@login')->name('employee');
Route::match(['get', 'post'], '/employee/dashboard/manage/system_users', 'DOHController@SystemUsers')->name('mngSystemUsers');
Route::match(['get', 'post'], 'employee/dashboard/manage/applicants', 'DOHController@Applicants')->name('mngApplicants');
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
Route::match(['get', 'post'],'/employee/dashboard/mf/apptype','DOHController@FaServType')->name('mfAppType');
Route::match(['get', 'post'],'/employee/dashboard/mf/faciserv','DOHController@FaServ')->name('mfFaServ');
Route::match(['get', 'post'],'/employee/dashboard/mf/typefa','DOHController@TypeFacility')->name('mfTypeFacility');
// con
Route::match(['get', 'post'],'/employee/dashboard/mf/appstatus','DOHController@AppStatus')->name('mfAppStatus');
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
// Route::match(['get', 'post'],'/employee/dashboard/mf/pre-assessment', 'DOHController@PreAsMent')->name('mfPreAsMent');
Route::match(['get', 'post'],'/employee/dashboard/mf/personnel','DOHController@PerSoNel')->name('mfPersonnel');
Route::match(['get', 'post'],'/employee/dashboard/mf/eligibility','DOHController@Eligibility')->name('mfEligibility');
Route::match(['get', 'post'],'/employee/dashboard/mf/orderofpayment','DOHController@OrderOfPayment')->name('mfOrderOfPayment');
Route::match(['get','post'],'/employee/dashboard/mf/charges','DOHController@Charges')->name('mfCharges');
Route::match(['get','post'], '/employee/dashboard/mf/chg_oop','DOHController@ChgOop')->name('mfChargeOoP');
Route::match(['get', 'post'], '/employee/dashboard/mf/holidays', 'DOHController@Holidays');
Route::match(['get', 'post'], '/employee/dashboard/mf/mode_payment', 'DOHController@ModeOfPayment');
Route::match(['get', 'post'],'/employee/dashboard/pf/view','DOHController@PfView')->name('pfView');
Route::match(['get','post'], '/employee/dashboard/lps/evaluate/{appid}', 'DOHController@EvalOne');
Route::match(['get','post'], '/employee/dashboard/lps/evaluate/{appid}/{oop_id}/add', 'DOHController@EvalAddOOP');
Route::match(['get','post'], '/employee/dashboard/lps/evaluate/{appid}/{oop_id}/view', 'DOHController@EvalViewOOP');
Route::match(['get', 'post'], '/employee/dashboard/lps/assess', 'DOHController@Assess');
Route::match(['get', 'post'], '/employee/dashboard/lps/assess/{appid}', 'DOHController@AssessOne');
Route::match(['get','post'],'/employee/dashboard/mf/category','DOHController@Category')->name('mfCategory');
Route::match(['get','post'],'/employee/dashboard/mf/tstatus','DOHController@TransStatus')->name('mfTranStatus');
Route::match(['get', 'post'], '/employee/dashboard/mf/settings', 'DOHController@Settings')->name('mfSettings');
Route::match(['get', 'post'], '/employee/dashboard/manage/system_logs', 'DOHController@System_Logs')->name('SystemLogs');
Route::post('/employee/logout','DOHController@logout');
Route::post('employee/getRights', 'DOHController@getSettings2');
Route::post('/employee/grprights/check','DOHController@chckgr');

Route::get('/employee/dashboard', 'DOHController@dashboard')->name('eDashboard');
Route::get('/employee/dashboard/lps','DOHController@lps');
Route::get('/employee/dashboard/lps/evaluate','DOHController@evalute');
Route::get('/employee/dashboard/lps/assign','DOHController@assignNow');
Route::get('/employee/dashboard/lps/evalute/ins/1','DOHController@ins1');
Route::get('/employee/dashboard/lps/evalute/ins/2','DOHController@ins2');
Route::get('/employee/dashboard/lps/evalute/ins/3','DOHController@ins3');
Route::get('/file/download/{id}','ajaxController@DownloadFile')->name('DownloadFile');
// ----------------------------------------------- DOH Controller
// ----------------------------------------------- Ajax Controller
// -------------------------------------- ADD
Route::post('/mf/add_typefa', ['as'=>'add-typefa','uses'=>'ajaxController@addTypeFa']);
// -------------------------------------- ADD
// -------------------------------------- GET
Route::post('/ph/get_province', ['as'=>'select-province','uses'=>'ajaxController@selectProvince']);
Route::post('/ph/get_brgy', ['as'=>'select-brgy','uses'=>'ajaxController@selectBrgy']);
Route::post('/mf/getUploads',['as'=>'select-uploads','uses'=>'ajaxController@selectUploads']);
Route::post('/mf/getClass', ['as'=>'get-class','uses'=>'ajaxController@getClass']);
Route::post('/mf/getTypeFaci', ['as'=>'get-typefacility','uses'=>'ajaxController@getTypeFaci']);
Route::post('/employee/get_rights', ['as'=>'get-rights','uses'=>'ajaxController@getRights']);
Route::post('/employee/get_date_actlogs', ['as'=>'get-ActLogs','uses'=>'ajaxController@getActLogs']);
Route::post('/mf/facility/getRequirements', ['as'=>'get-Requirements','uses'=>'ajaxController@getRequirements']);
Route::post('/lps/getLPS', ['as'=>'get-LPS','uses'=>'ajaxController@getLPS']);
Route::post('/lps/getLPS4Assigned', ['as'=>'get-LPS','uses'=>'ajaxController@getLPS4Assigned']);
Route::post('/lps/getLPSUploads', ['as'=>'get-LPS','uses'=>'ajaxController@getLPSUploads']);
Route::post('/lps/getEvalDetails', ['as'=>'get-EvalDetails','uses'=>'ajaxController@EvalDetails']);
Route::post('mf/getChgOOP',['as'=>'get-ChgOOP','uses'=>'ajaxController@getChgOOP']);
Route::post('mf/getGetLO',['as'=>'get-GetLO','uses'=>'ajaxController@getLO']);
Route::post('mf/getGetChangeHistory',['as'=>'get-GetChangeHistory','uses'=>'ajaxController@getChangeHistory']);
Route::post('/lps/getAssess', ['as'=>'getAssess', 'uses'=>'ajaxController@getAssess']);
Route::post('/mf/getCalendarEvents', ['as'=>'getCalendarEvents', 'uses'=>'ajaxController@getCalendarEvents']);
Route::post('/mf/getCalendarEvents2', ['as'=>'getCalendarEvents2', 'uses'=>'ajaxController@getCalendarEvents2']);
//getRequirements
// -------------------------------------- GET
// -------------------------------------- UPDATE
Route::post('/mf/save_phRegion', ['as'=>'save-phRegion','uses'=>'ajaxController@savePhRegion']);
Route::post('/mf/save_phProvince', ['as'=>'save-phProvince','uses'=>'ajaxController@savePhProvince']);
Route::post('/mf/save_phCmB', ['as'=>'save-phCmB','uses'=>'ajaxController@savePhCmB']);
Route::post('/mf/save_phBarangay', ['as'=>'save-phBarangay','uses'=>'ajaxController@savePhBarangay']);
Route::post('/employee/changepass', ['as'=>'change-pass','uses'=>'ajaxController@chngPass']);
Route::post('/employee/save_rights', ['as'=>'save-rights','uses'=>'ajaxController@saveRights']);
Route::post('/personnel/isActive', ['as'=>'isActive','uses'=>'ajaxController@isActive']);
Route::post('/mf/facility/isEnabled', ['as'=>'isEnabled','uses'=>'ajaxController@isEnabled']);
//mf/facility/isEnabled
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
Route::post('/mf/save_oop', ['as'=>'save-Oop', 'uses'=> 'ajaxController@saveOop']);
Route::post('/mf/save_chrg', ['as'=>'save-Chrg', 'uses'=> 'ajaxController@saveChrg']);
Route::post('/lsp/reject_app', ['as'=>'reject-app', 'uses'=> 'ajaxController@reject_app']);
Route::post('/lsp/accept_app', ['as'=>'accpet-app', 'uses'=> 'ajaxController@accept_app']);
Route::post('/mf/rearrange_oop', ['as'=>'rearrange_oop', 'uses'=> 'ajaxController@rearrange_oop']);
Route::post('/mf/save_amt', ['as'=>'save_amt', 'uses'=> 'ajaxController@SaveAmt']);
Route::post('/mf/save_rgnLo', ['as'=>'save_rgnLO', 'uses'=> 'ajaxController@saveRgnLO']);
Route::post('/mf/save_newLO', ['as'=>'save_newLO','uses' => 'ajaxController@saveNewLO']);
Route::post('/mf/save_holiday', ['as'=>'save_holiday', 'uses' => 'ajaxController@saveHoliday']);
Route::post('/mf/save_category', ['as'=>'save_category', 'uses' => 'ajaxController@saveCategory']);
Route::post('/mf/save_tstatus', ['as'=>'save_tstatus', 'uses'=> 'ajaxController@saveTStatus']);
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
Route::post('/mf/del_chrg',['as'=>'del-chrg','uses'=>'ajaxController@delChrg']);
Route::post('/mf/del_chrg_oop',['as'=>'del-chrg','uses'=>'ajaxController@delChrgOop']);
Route::post('/mf/del_holidays',['as'=>'del-holidays','uses'=>'ajaxController@delHolidays']);
Route::post('mf/del_category', ['as'=>'del-category', 'uses'=> 'ajaxController@delCategory']);
Route::post('/mf/del_tstatus', ['as'=>'del_tstatus', 'uses'=>'ajaxController@delTStatus']);
// -------------------------------------- DELETE
// ----------------------------------------------- Ajax Controller
Route::get('sendbasicemail','MailController@basic_email');
Route::get('sendhtmlemail','MailController@html_email');
Route::get('sendattachmentemail','MailController@attachment_email');