<?php



Route::group(['namespace' => 'Servicepay'], function () {

/*
Route::get('/','ServicepayController@iranipayindex'); 
Route::get('/index','ServicepayController@iranipayindex'); 
Route::get('service/{id}','ServicepayController@serviceid'); 
Route::get('new/{id}','ServicepayController@newid'); 
*/

});


	
	

Route::group(['namespace' => 'Superadmin'], function () {
	

Route::get('superadmin/demothemmelody','SuperadminController@demothemmelody'); 
Route::get('superadmin/demopanel','SuperadminController@demopanel');  	
	
Route::get('superadmin','SuperadminController@superadminlogin');  
Route::get('superadmin/sign-in','SuperadminController@superadminlogin'); 
Route::post('superadmin/sign-in', 'SuperadminController@superadminPosts');
Route::get('superadmin/panel','SuperadminController@panel'); 
Route::get('superadmin/sign-out','SuperadminController@superadminsignout');
Route::get('superadmin/myprofile/edit/sup','SuperadminController@myprofile');
Route::post('superadmin/myprofile/edit/sup','SuperadminController@editmyprofilePost'); 
Route::post('superadmin/myprofile/dropzone/store', ['as'=>'dropzone.storesup','uses'=>'SuperadminController@dropzoneStoredmyprofile']);
Route::post('superadmin/myprofile/securityysup', ['as'=>'securityysup','uses'=>'SuperadminController@securityysup']); 
 
Route::get('superadmin/createform','SuperadminController@createform'); 
Route::post('superadmin/createform','SuperadminController@createformpost'); 
Route::get('superadmin/formtype/{id}','SuperadminController@formtypeid'); 
Route::post('superadmin/formtype/{id}','SuperadminController@formtypeidpost');
Route::get('superadmin/selectpriceform/{id}','SuperadminController@selectpriceformid'); 
Route::post('superadmin/selectpriceform/{id}','SuperadminController@selectpriceformidpost');  
Route::get('superadmin/viewsforms','SuperadminController@viewsforms');
Route::get('superadmin/viewsforms/edit/{id}','SuperadminController@viewsformseditid');
Route::post('superadmin/viewsforms/edit/{id}','SuperadminController@viewsformseditidpost');
Route::post('superadmin/viewsforms/edit/{id}/addfeild','SuperadminController@addfeild');
Route::post('superadmin/viewsforms/edit/{id}/sortfeild','SuperadminController@sortfeild');
Route::post('superadmin/viewsforms/edit/{id}/addselectfeild','SuperadminController@addselectfeild');
Route::get('superadmin/viewsforms/delet/{id}/feild/{idfeild}','SuperadminController@deletidfeild');
Route::post('superadmin/viewsforms/edit/{id}/feild','SuperadminController@editfeldformid'); 
Route::get('superadmin/viewsforms/edit/{stat}/{id}','SuperadminController@viewsformseditidstat');

Route::get('superadmin/viewsforms/editselectbox/{id}','SuperadminController@editselectbox');
Route::post('superadmin/viewsforms/editselectbox/{id}','SuperadminController@editselectboxpost');
Route::get('superadmin/viewsforms/editselectboxdelet/{id}','SuperadminController@deletselectbox');

Route::get('superadmin/viewsforms/editcheckbox/{id}','SuperadminController@editcheckbox');
Route::post('superadmin/viewsforms/editcheckbox/{id}','SuperadminController@editcheckboxpost');
Route::get('superadmin/viewsforms/editcheckboxdelet/{id}','SuperadminController@deletcheckbox');

Route::get('superadmin/addmak','SuperadminController@addmak'); 
Route::post('superadmin/addmak','SuperadminController@addmakpost'); 
Route::get('superadmin/viewsmaks','SuperadminController@viewsmaks'); 
Route::post('superadmin/viewsmaks/{id}','SuperadminController@viewsmakspostid'); 
Route::get('superadmin/viewsmaks/delet/{id}','SuperadminController@deletmakid');

Route::get('superadmin/settingrezervprice','SuperadminController@settingrezervprice'); 
Route::post('superadmin/settingrezervprice','SuperadminController@settingrezervpricepost'); 

Route::get('superadmin/adddiscount','SuperadminController@adddiscount'); 
Route::post('superadmin/adddiscount','SuperadminController@adddiscountpost'); 
Route::get('superadmin/mngdiscount','SuperadminController@mngdiscount');
Route::post('superadmin/mngdiscount/{id}','SuperadminController@mngdiscountpostid');
Route::get('superadmin/mngdiscount/{stat}/{id}','SuperadminController@mngdiscountstatid');
Route::get('superadmin/discount/delet/{id}','SuperadminController@discountdeletid');

Route::get('superadmin/adduser','SuperadminController@addusersup'); 
Route::post('superadmin/adduser','SuperadminController@addusertPost');
Route::get('superadmin/viewsusers','SuperadminController@viewsuserssup');
Route::get('superadmin/viewsusers/edituser/{id}','SuperadminController@editusersup');
Route::post('superadmin/viewsusers/edituser/{id}','SuperadminController@editusersupPost');
Route::post('superadmin/viewsusers/edituser/{id}/inccharge','SuperadminController@editusersupincchargePost'); 
Route::post('superadmin/viewsusers/edituser/{id}/odat','SuperadminController@chargeuserincpostodat');
Route::post('superadmin/viewsusers/dropzone/store', ['as'=>'dropzone.storeuser','uses'=>'SuperadminController@dropzoneStoreuser']);
Route::post('superadmin/viewsusers/securityystud', ['as'=>'securityystud','uses'=>'SuperadminController@securityystud']);
Route::get('superadmin/viewsusers/delet/{id}','SuperadminController@deletusersup');
Route::get('superadmin/viewsusers/edituser/acc/{id}','SuperadminController@accusersup');
Route::get('superadmin/viewsusers/edituser/rej/{id}','SuperadminController@rejusersup');
Route::get('superadmin/viewsusers/loginuser/{id}','SuperadminController@loginusersup'); 
Route::get('superadmin/viewsusers/edituser/accdoc/{id}','SuperadminController@accdocusersup');

Route::get('superadmin/xls/{list}','SuperadminController@xls');

Route::get('superadmin/createcatsform','SuperadminController@createcatsform'); 
Route::post('superadmin/createcatsform','SuperadminController@createcatsformPost');
Route::get('superadmin/viewscatsform','SuperadminController@viewscatsform'); 
Route::get('superadmin/viewscatsform/edit/{id}','SuperadminController@viewscatsformeditid'); 
Route::post('superadmin/viewscatsform/edit/{id}','SuperadminController@viewscatsformeditpostid'); 
Route::get('superadmin/viewscatsform/delet/{id}','SuperadminController@deletcatsformeditid'); 

Route::get('superadmin/addcurrencytransfer','SuperadminController@addcurrencytransfer'); 
Route::post('superadmin/addcurrencytransfer','SuperadminController@addcurrencytransferpost'); 
Route::get('superadmin/viewscurrencytransfer','SuperadminController@viewscurrencytransfer'); 
Route::get('superadmin/viewscurrencytransfer/{id}','SuperadminController@currencytransferid');
Route::post('superadmin/viewscurrencytransfer/{id}','SuperadminController@currencytransferidpost'); 
Route::get('superadmin/viewscurrencytransfer/acc/{id}','SuperadminController@currencytransferidacc'); 
Route::get('superadmin/viewscurrencytransfer/rej/{id}','SuperadminController@currencytransferidrej'); 
Route::get('superadmin/viewscurrencytransfer/delet/{id}','SuperadminController@currencytransferiddelet'); 

Route::get('superadmin/addcurrency','SuperadminController@addcurrency'); 
Route::post('superadmin/addcurrency','SuperadminController@addcurrencypost'); 
Route::get('superadmin/viewscurrency','SuperadminController@viewscurrency'); 
Route::get('superadmin/viewscurrency/{id}','SuperadminController@editcurrency'); 
Route::post('superadmin/viewscurrency/{id}','SuperadminController@editcurrencypost'); 
Route::get('superadmin/viewscurrency/acc/{id}','SuperadminController@acccurrency'); 
Route::get('superadmin/viewscurrency/rej/{id}','SuperadminController@rejcurrency'); 


Route::get('superadmin/addservice','SuperadminController@addservice'); 
Route::post('superadmin/addservice','SuperadminController@addservicepost'); 
Route::get('superadmin/viewsservice','SuperadminController@viewsservice'); 
Route::get('superadmin/viewsservice/{id}','SuperadminController@viewsserviceid'); 
Route::post('superadmin/viewsservice/{id}','SuperadminController@viewsserviceidpost'); 
Route::get('superadmin/viewsservice/acc/{id}','SuperadminController@accserviceid'); 
Route::get('superadmin/viewsservice/rej/{id}','SuperadminController@rejserviceid'); 
Route::get('superadmin/viewsservice/delet/{id}','SuperadminController@delserviceid'); 

Route::get('superadmin/manageindex','SuperadminController@manageindex'); 
Route::post('superadmin/manageindex','SuperadminController@manageindexpost'); 
Route::get('superadmin/mngindexedit','SuperadminController@mngindexedit');
Route::post('superadmin/mngindexedit','SuperadminController@mngindexeditpost');

Route::get('superadmin/viewsonlineshops','SuperadminController@viewsonlineshops'); 
Route::get('superadmin/viewsonlineshops/{id}/{req_id}','SuperadminController@viewsonlineshopsid'); 


Route::get('superadmin/settingrezerv','SuperadminController@settingrezerv');
Route::post('superadmin/settingrezerv','SuperadminController@settingrezervpost');
Route::get('superadmin/setrezerv','SuperadminController@setrezerv');
Route::get('superadmin/date/{year}/{month}','SuperadminController@dateyearmonth');
Route::get('superadmin/settingrezerv/edit/{id}','SuperadminController@settingrezerveditid');
Route::post('superadmin/settingrezerv/edit/{id}','SuperadminController@settingrezerveditidpost');

Route::get('superadmin/addnew','SuperadminController@addnew');
Route::post('superadmin/addnew','SuperadminController@addnewpost');
Route::get('superadmin/viewsnews','SuperadminController@viewsnews');
Route::get('superadmin/viewsnews/editnew/{id}','SuperadminController@editnew');
Route::post('superadmin/viewsnews/editnew/{id}','SuperadminController@editnewpost');
Route::get('superadmin/viewsnews/editnew/acc/{id}','SuperadminController@accnew');
Route::get('superadmin/viewsnews/editnew/rej/{id}','SuperadminController@rejnew');
Route::get('superadmin/viewsnews/delet/{id}','SuperadminController@deletnew');

Route::get('superadmin/addpage','SuperadminController@addpage');
Route::post('superadmin/addpage','SuperadminController@addpagepost');
Route::get('superadmin/viewspages','SuperadminController@viewspages');
Route::get('superadmin/viewspages/editpage/{id}','SuperadminController@editpage');
Route::post('superadmin/viewspages/editpage/{id}','SuperadminController@editpagepost');
Route::get('superadmin/viewspages/editpage/acc/{id}','SuperadminController@accpage');
Route::get('superadmin/viewspages/editpage/rej/{id}','SuperadminController@rejpage');
Route::get('superadmin/viewspages/delet/{id}','SuperadminController@deletpage');

Route::get('superadmin/addsocial','SuperadminController@addsocial');
Route::post('superadmin/addsocial','SuperadminController@addsocialpost');
Route::get('superadmin/mngsocial','SuperadminController@mngsocial');
Route::get('superadmin/mngsocial/editsocial/{id}','SuperadminController@editsocial');
Route::post('superadmin/mngsocial/editsocial/{id}','SuperadminController@editsocialpost');
Route::get('superadmin/mngsocial/editsocial/acc/{id}','SuperadminController@accsocial');
Route::get('superadmin/mngsocial/editsocial/rej/{id}','SuperadminController@rejsocial');
Route::get('superadmin/mngsocial/delet/{id}','SuperadminController@deletsocial');

Route::get('superadmin/finicals','SuperadminController@finicals'); 

Route::get('superadmin/fech/{id}','SuperadminController@fechpost'); 
Route::get('superadmin/fechcur/{id}','SuperadminController@fechcurpost'); 
 
Route::get('superadmin/form','SuperadminController@form');

Route::get('superadmin/testsms','SuperadminController@testsms');

Route::get('superadmin/viewsuserticketssup','SuperadminController@viewsuserticketssup');
Route::get('superadmin/viewsuserticketssup/ticket/{id}','SuperadminController@ticketsup'); 
Route::post('superadmin/viewsuserticketssup/ticket/{id}','SuperadminController@ticketusersupPost'); 
Route::get('superadmin/viewsuserticketssupactive','SuperadminController@viewsuserticketssupactive'); 
Route::get('superadmin/viewsuserticketssup/delet/{id}','SuperadminController@deletticketusersup');
Route::get('superadmin/viewsuserticketssup/close/{id}','SuperadminController@closeticketusersup'); 

Route::get('superadmin/addelanuser','SuperadminController@addelanuser'); 
Route::post('superadmin/addelanuser','SuperadminController@addelanuserPost'); 
Route::get('superadmin/viewselanats','SuperadminController@viewselanatsusers');
Route::get('superadmin/viewselanats/elanat/{id}','SuperadminController@elanattikuser');

Route::get('superadmin/viewsgetwaypays','SuperadminController@viewsgetwaypays');
Route::get('superadmin/viewsgetwaypays/getwaypay/{id}','SuperadminController@editgetwaypay'); 
Route::post('superadmin/viewsgetwaypays/getwaypay/{id}','SuperadminController@editgetwaypaypost');
Route::get('superadmin/viewsgetwaypays/getwaypay/acc/{id}','SuperadminController@accgetwaypay'); 
Route::get('superadmin/viewsgetwaypays/getwaypay/rej/{id}','SuperadminController@rejgetwaypay'); 

Route::get('superadmin/viewspanelsms','SuperadminController@viewspanelsms'); 
Route::get('superadmin/viewspanelsms/panelsms/{id}','SuperadminController@editpanelsms'); 
Route::post('superadmin/viewspanelsms/panelsms/{id}','SuperadminController@editpanelsmspost'); 

Route::get('superadmin/mngprice','SuperadminController@mngprice'); 
Route::post('superadmin/mngprice/{id}','SuperadminController@mngpriceid'); 

Route::get('superadmin/mngcurrency','SuperadminController@mngcurrency');
Route::post('superadmin/mngcurrency/{id}','SuperadminController@mngcurrencyidpost');
/*
Route::get('superadmin/viewsusers/edituser/charge/{id}','SuperadminController@chargeuserinc');
Route::post('superadmin/viewsusers/edituser/charge/{id}','SuperadminController@chargeuserincpost');
Route::get('superadmin/viewsusers/edituser/charge/odat/{id}','SuperadminController@chargeuserincodat');
Route::post('superadmin/viewsusers/edituser/charge/odat/{id}','SuperadminController@chargeuserincpostodat');
 	*/ 


Route::get('superadmin/success','SuperadminController@success'); 
 
 
Route::get('superadmin/viewsrezervmaks','SuperadminController@viewsrezervmakssup'); 

Route::get('superadmin/rezervmak/{idrezerv}/{id}','SuperadminController@rezervmaksupid');

Route::get('superadmin/calendar/delet/{id}','SuperadminController@deletcalendar');


Route::get('superadmin/setting_login','SuperadminController@setting_login');
Route::post('superadmin/setting_login','SuperadminController@setting_loginpost');



});







 

Route::group(['namespace' => 'user'], function () {
	
	 

Route::get('/','UserController@userlogin');
Route::get('user','UserController@userlogin');
Route::get('user/sign-in','UserController@userlogin');
Route::post('user/sign-in','UserController@userloginpost');
Route::post('user/login_pas','UserController@login_paspost');
Route::get('user/verfylogin','UserController@verfylogin');
Route::post('user/verfylogin','UserController@verfyloginpost');
Route::get('user/panel','UserController@paneluser');
Route::get('user/panel/{id}','UserController@paneluserid');

Route::get('user/registeruser','UserController@adduserfruser');
Route::post('user/registeruser','UserController@adduserfruserPost'); 

Route::post('user/registeruser_pas','UserController@registeruser_paspost'); 

Route::get('user/forgetpas','UserController@forgetpasword');
Route::post('user/forgetpas','UserController@forgetpaswordpost');

Route::post('user/repeatverify','UserController@repeatverify'); 

Route::get('user/sign-out','UserController@usersignout');	
Route::get('user/myprofile/edit','UserController@editprofileuser');	
Route::get('user/myprofile/charge','UserController@editprofileusercharge');	
Route::get('user/myprofile/viewscharge/detcharge/{id}','UserController@editprofiledetcharge');	
Route::get('user/inccharge','UserController@inccharge');	
Route::post('user/inccharge','UserController@incchargepost');	
Route::post('user/myprofile/edit','UserController@editprofileuserPost');	
Route::post('user/myprofile/dropzone/storeuserprofile', ['as'=>'dropzone.storeuserprofile','uses'=>'UserController@dropzoneStoreuserprofile']);
Route::post('user/myprofile/securityuserprofile', ['as'=>'securityuserprofile','uses'=>'UserController@securityuserprofile']);
Route::get('user/myprofile/webservice','UserController@webservicemyuser');
Route::post('user/myprofile/webservice','UserController@webservicemyuserpost');


Route::get('user/verificationdoc','UserController@verificationdoc');
Route::post('user/verificationdoc','UserController@verificationdocpost');
Route::post('user/verificationdoc/dropzone/storeusercardmel', ['as'=>'dropzone.storeusercardmel','uses'=>'UserController@dropzoneStoreusercardmel']);
Route::post('user/verificationdoc/post','UserController@verificationdocimgpost');	

Route::get('user/activition','UserController@activitionuser');
Route::post('user/activition/emailuseractivitionverfy', ['as'=>'emailuseractivitionverfy','uses'=>'UserController@emailuseractivitionverfy']);
Route::post('user/activition/emailuseractivition', ['as'=>'emailuseractivition','uses'=>'UserController@emailuseractivition']);
Route::post('user/activition/telluseractivitionverfy', ['as'=>'telluseractivitionverfy','uses'=>'UserController@telluseractivitionverfy']);
Route::post('user/activition/telluseractivition', ['as'=>'telluseractivition','uses'=>'UserController@telluseractivition']);


Route::get('user/currencytransfer/{id}','UserController@prodcurrencytransferid');
Route::post('user/currencytransfer/{id}','UserController@prodcurrencytransferidpost');


Route::get('user/service/{id}','UserController@prodserviceid');
Route::post('user/service/{id}','UserController@prodserviceidpost');
Route::get('user/viewsprodbuy','UserController@viewsprodbuy');
Route::get('user/viewsprodbuy/{id}','UserController@viewsprodserviceid');
Route::get('user/viewsprodservice','UserController@viewsprodservice');
Route::get('user/viewsprodservice/{id}','UserController@viewsprodserviceid');
Route::post('user/viewsprodservice/{id}/pay','UserController@viewsprodserviceidacc');
Route::get('user/viewsprodservice/delet/{id}','UserController@viewsprodserviceiddel');
Route::get('user/finicals','UserController@viewsfinicals');

Route::get('user/trakings','UserController@trakings');


Route::post('user/rezervd','UserController@rezervdpost');

Route::post('user/rezervmakpers','UserController@rezervmakpers');

Route::get('user/rezervdmak','UserController@rezervdmak');

Route::get('user/viewsrezervmaks','UserController@viewsrezervmaks');

Route::get('user/rezervmak/{idrezerv}/{id}','UserController@rezervmakid');

Route::get('user/rezervmak/{id}','UserController@rezervmakid');

Route::get('user/date/{year}/{month}','UserController@dateyearmonthuser');

Route::get('user/onlineshops','UserController@onlineshops');
Route::get('user/onlineshops/{id}','UserController@onlineshopsid');
Route::post('user/onlineshops/{id}/post','UserController@onlineshopsidpost');

Route::post('user/callback/payping/{id}','UserController@callback_payping');


Route::get('user/test_zarinpal','UserController@test_zarinpal');
Route::get('user/zarinpal_pay/{req_rnd}','UserController@zarinpal_pay');
Route::get('user/verify_buy.php','UserController@verify_buy');

Route::get('user/addticket','UserController@addticketuser'); 
Route::post('user/addticket','UserController@addticketuserPost');
Route::get('user/viewstickets','UserController@viewsticketsuser');  
Route::get('user/viewstickets/ticket/{id}','UserController@ticketuser'); 
Route::post('user/viewstickets/ticket/{id}','UserController@ticketuserPost'); 
Route::get('user/viewstickets/delet/{id}','UserController@deletticketuser');

Route::get('user/viewselanats','UserController@viewselanatsuser'); 
Route::get('user/viewselanats/elanat/{id}','UserController@elanatuser');  


Route::get('user/viewsonlineshops','UserController@viewsonlineshopsuser');
Route::get('user/viewsonlineshops/{id}/{req_id}','UserController@viewsonlineshopsuserid');
Route::post('user/viewsonlineshops/{id}/{req_id}','UserController@viewsonlineshopsuseridpost');

Route::get('user/error/{id}','UserController@errorid');
Route::get('user/success/{id}','UserController@successid');
 
Route::get('user/error/mak/{id}','UserController@errormakid');
Route::get('user/success/mak/{id}','UserController@successmakid'); 
 

Route::get('user/regord/{id}','UserController@regordid');

Route::get('user/testcurl/{id}/{token}/{status}','UserController@testcurlid');
Route::get('user/fetch/{id}','UserController@testfetchid');

Route::get('user/verfypayment/{id}','UserController@shaparakid');


Route::get('user/makcurl/{id}/{token}/{status}','UserController@makcurlid');
Route::get('user/fetchmak/{id}','UserController@fetchmak');
 
});
  
 
 