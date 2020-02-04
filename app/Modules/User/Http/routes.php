<?php







Route::get('login', 'Auth\AuthController@getLogin')->name('loginCreatePage');
Route::post('login', 'Auth\AuthController@postLogin')->name('loginCreate');
Route::get('logout', 'Auth\AuthController@getLogout')->name('logout');


Route::get('oauth/{type}', 'Auth\AuthController@oauthLogin');
Route::get('oauth/{type}/callback', 'Auth\AuthController@handleOAuthCallBack');


Route::get('register', 'Auth\AuthController@getRegister')->name('registerCreatePage');
Route::post('register', 'Auth\AuthController@postRegister')->name('registerCreate');
Route::post('register/phone', 'Auth\AuthController@phoneRegister');
Route::post('auth/mobileCode', 'Auth\AuthController@sendMobileCode');
Route::post('checkMobile', 'IndexController@checkMobile');
Route::get('StartCaptchaServlet', 'UserCenterController@StartCaptchaServlet');



Route::get('activeEmail/{validationInfo}', 'EmailController@activeEmail');
Route::get('waitActive/{email}', 'Auth\AuthController@waitActive');


Route::get('password/email', 'Auth\PasswordController@getEmail')->name('getPasswordPage');
Route::post('password/email', 'Auth\PasswordController@postEmail')->name('passwordUpdate');
Route::get('password/reSendEmail/{email}', 'Auth\PasswordController@reSendPasswordEmail')->name('reSendPasswordEmail');
Route::post('password/checkEmail', 'Auth\PasswordController@checkEmail')->name('checkEmail');
Route::post('password/checkCode', 'Auth\PasswordController@checkCode')->name('checkCode');
Route::get('password/mobile', 'Auth\PasswordController@getMobile');
Route::post('password/mobile', 'Auth\PasswordController@postMobile');
Route::get('password/mobileReset', 'Auth\PasswordController@getMobileReset');
Route::post('password/mobileReset', 'Auth\PasswordController@postMobileReset');
Route::get('password/mobileResetSuccess', 'Auth\PasswordController@mobileResetSuccess');
Route::post('password/mobilePasswordCode', 'Auth\PasswordController@sendMobilePasswordCode');



Route::get('resetValidation/{validationInfo}', 'Auth\PasswordController@resetValidation')->name('passwordResetValidation');
Route::get('passwordFail', 'Auth\PasswordController@passwordFail');
Route::get('waitValidation/{email}', 'Auth\PasswordController@waitValidation')->name('waitValidationPage');
Route::get('password/reset', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset')->name('nameResetCreate');

Route::get('flushCode', 'Auth\AuthController@flushCode')->name('flushCode');
Route::post('checkUserName', 'Auth\AuthController@checkUserName')->name('checkUserName');
Route::post('checkEmail', 'Auth\AuthController@checkEmail')->name('checkEmail');
Route::get('reSendActiveEmail/{email}', 'Auth\AuthController@reSendActiveEmail')->name('reSendActiveEmail');

Route::get('user/getZone', 'AuthController@getZone')->name('zoneDetail');

Route::get('/user/promote/{param}', 'PromoteController@promote')->name('promote'); 

Route::get('/reSendEmailAuth/{email}', 'AuthController@reSendEmailAuth');

Route::get('user/checkInterVal','UserCenterController@checkInterVal')->name('checkInterVal');

Route::group(['prefix' => 'user', 'middleware' => 'auth'], function () {
    Route::get('/index','UserCenterController@index')->name('indexPage');

    Route::get('/paylist', 'AuthController@getPayList')->name('paylist');

    
    Route::get('/emailAuth', 'AuthController@getEmailAuth')->name('emailAuthPage');
    Route::get('/sendEmailAuth', 'AuthController@sendEmailAuth')->name('sendEmailAuth');
    Route::get('/reSendEmailAuthBand/{email}', 'AuthController@reSendEmailAuthBand')->name('reSendEmailAuthBand');

    Route::get('verifyEmail/{validationInfo}', 'AuthController@verifyEmail')->name('verifyEmail');


    
    Route::get('phoneAuth', 'AuthController@getPhoneAuth')->name('phoneAuthPage');
    Route::post('phoneAuth', 'AuthController@postPhoneAuth');
    Route::post('sendBindSms', 'AuthController@sendBindSms');
    Route::get('unbindMobile', 'AuthController@getUnbindMobile');
    Route::post('sendUnbindSms', 'AuthController@sendUnbindSms');
    Route::post('unbindMobile', 'AuthController@postUnbindMobile');

    
    Route::get('/realnameAuth', 'AuthController@getRealnameAuth')->name('realnameAuthCreatePage');
    Route::post('/realnameAuth', 'AuthController@postRealnameAuth')->name('realnameAuthCreate');
    Route::get('/reAuthRealname', 'AuthController@reAuthRealname')->name('reAuthRealnamePage');

    
    Route::get('/alipayAuth', 'AuthController@getAlipayAuth')->name('alipayAuthCreatePage');
    Route::post('/alipayAuth', 'AuthController@postAlipayAuth')->name('alipayAuthCreate');
    Route::get('/alipayAuthList', 'AuthController@listAlipayAuth')->name('alipayAuthList');
    Route::get('/alipayAuthSchedule/{alipayAuthId}', 'AuthController@getAlipayAuthSchedule')->name('alipayAuthSchedule');
    Route::post('/verifyAlipayAuthCash', 'AuthController@verifyAlipayAuthCash')->name('verifyAlipayAuthCash');
    Route::post('changeAlipayAuth', 'AuthController@changeAlipayAuth')->name('alipayAuthStatusUpdate');

    
    Route::get('/bankAuth', 'AuthController@getBankAuth')->name('bankAuthCreatePage');
    Route::post('/bankAuth', 'AuthController@postBankAuth')->name('bankAuthCreate');
    Route::get('/bankAuthList', 'AuthController@listBankAuth')->name('bankAuthList');
    Route::get('/bankAuthSchedule/{bankAuthId}', 'AuthController@getBankAuthSchedule')->name('waitBankAuthPage');
    Route::post('/verifyBankAuthCash', 'AuthController@verifyBankAuthCash')->name('verifyBankAuthCash');
    Route::get('/unBindBankAuth/{id}', 'AuthController@unBindBankAuth')->name('');

//    抽奖
    Route::get('/reward','UserMoreController@reward')->name('reward');
    Route::post('/rewardajax', 'UserMoreController@rewardajax')->name('postRewardajax');

//    轮训
    Route::post('/inquire', 'UserMoreController@postInquire')->name('postInquire');
    Route::get('/myshop','UserMoreController@myshop')->name('myshop');
//    我的任务收藏
    Route::get('/myfocustask','UserMoreController@myTocusTask')->name('myfocusList');
//    我的作品收藏
    Route::get('/myfocus','UserMoreController@myTocusGoods')->name('myfocusgoods');
    Route::get('/ajaxDeleteFocus/{id}','UserMoreController@ajaxDeleteFocus')->name('ajaxDeleteFocus');
    Route::get('/userfocus','UserMoreController@userFocus')->name('userFocusList');
    Route::get('/userfocuspeople','UserMoreController@userFocusPeople')->name('userFocusPeopleList');
    Route::get('/userFocusDelete/{id}','UserMoreController@userFocusDelete')->name('userFocusDelete');
    Route::get('/userNotFocus/{uid}','UserMoreController@userNotFocus')->name('userNotFocus');
    
    Route::get('/userfans','UserMoreController@userFans')->name('userfans');

    //    经纪人
    Route::get('/broker', 'UserMoreController@broker')->name('broker');

//    我的发布项目删除
    Route::post('/myTasksListDel','UserMoreController@postmyTasksListDel')->name('postmyTasksListDel');
//    我的发布项目取消
    Route::post('/myTasksListCancel','UserMoreController@postmyTasksListCancel')->name('postmyTasksListCancel');
//    雇佣设计师
    Route::post('/hireStylist','UserMoreController@posthireStylist')->name('posthireStylist');
//    拒绝设计师
    Route::post('/refuseStylist','UserMoreController@postrefuseStylist')->name('postrefuseStylist');
//    接受项目
    Route::post('/hireProject','UserMoreController@posthireProject')->name('posthireProject');
//    拒绝项目
    Route::post('/refuseProject','UserMoreController@postrefuseProject')->name('postrefuseProject');
//    设置验收方式
    Route::post('/wayProject','UserMoreController@postwayProject')->name('postwayProject');
//    接受项目的文件ajax
    Route::post('/fileAjax','UserMoreController@postfileAjax')->name('postfileAjax');
    Route::get('/myTasksList','UserMoreController@myTasksList')->name('myTasksList');
    Route::get('/myTaskAxis','UserMoreController@myTaskAxis')->name('myTaskAxis');
    Route::get('/myTaskAxisAjax','UserMoreController@myTaskAxisAjax')->name('myTaskAxisAjax');
    Route::get('/myTask','UserMoreController@myTask')->name('myTask');
    Route::get('/acceptTasksList','UserMoreController@acceptTasksList')->name('acceptTasksList');
    Route::get('/acceptBroker','UserMoreController@acceptBroker')->name('acceptBroker');
    Route::get('/myAjaxTask','UserMoreController@myAjaxTask')->name('myAjaxTask');
//  作品上传
    Route::get('/productionUploading','UserMoreController@getProductionUploading')->name('getproductionUploading');
    Route::post('/productionUploading','UserMoreController@postProductionUploading')->name('postproductionUploading');
    Route::get('/productionSucceed','UserMoreController@getProductionUploading')->name('getproductionSucceed');
    Route::get('/productionWait','UserMoreController@getProductionUploading')->name('getproductionWait');
    Route::get('/productionDefeated','UserMoreController@getProductionUploading')->name('getproductionDefeated');
    Route::get('/productionFeatedNew','UserMoreController@productionFeatedNew')->name('productionFeatedNew');


    
    Route::get('/myCommentOwner','UserMoreController@myCommentOwner')->name('myCommentList');
    Route::get('/myWorkHistory','UserMoreController@myWorkHistory')->name('myWorkList');
    Route::get('/myWorkHistoryAxis','UserMoreController@myWorkHistoryAxis')->name('myWorkHistoryAxis');
    Route::get('/workComment','UserMoreController@workComment')->name('workCommentList');
    
    Route::get('/unreleasedTasks','UserMoreController@unreleasedTasks')->name('unreleasedTasksList');
    Route::get('/unreleasedTasksDelete/{id}','UserMoreController@unreleasedTasksDelete')->name('unreleasedTasksDelete');

    Route::post('changeBankAuth', 'AuthController@changeBankAuth')->name('bankStatusUpdate');


//    个人资料
    Route::get('/info','UserCenterController@info')->name('infoUpdatePage');
    Route::post('/infoUpdate','UserCenterController@infoUpdate')->name('infoUpdate');
    Route::post('/infoExtendUpdate','UserCenterController@infoExtendUpdate')->name('infoExtendUpdate');
    
    Route::get('/loginPassword','UserCenterController@loginPassword')->name('passwordUpdatePage');
    Route::post('/passwordUpdate','UserCenterController@passwordUpdate')->name('passwordUpdate');
    
    Route::get('/payPassword','UserCenterController@payPassword')->name('payPasswordUpdatePage');
    Route::post('/payPasswordUpdate','UserCenterController@payPasswordUpdate')->name('payPasswordUpdate');
    Route::post('/sendEmail','UserCenterController@sendEmail')->name('sendEmail');
    Route::post('/checkEmail','UserCenterController@checkEmail')->name('checkEmail');
    Route::post('/validate','UserCenterController@validateCode')->name('validateCodePage');
    
    Route::get('/skill','UserCenterController@skill')->name('skillUpdatePage');
    Route::post('/skillSave','UserCenterController@skillSave')->name('skillCreate');
    
    Route::get('/skillUpdata/{id}','UserCenterController@skillUpdata')->name('skillUpdate');
    Route::post('/tagUpdate','UserCenterController@tagUpdate')->name('tagUpdate');
    Route::get('/delTag','UserCenterController@delTag')->name('tagDelete');
    Route::get('/hotTag','UserCenterController@hotTag');
    
    Route::get('/avatar','UserCenterController@userAvatar')->name('userAvatarPage');
    Route::post('/ajaxAvatar','UserCenterController@ajaxAvatar')->name('headUpdate');
    Route::post('/headEdit','UserCenterController@AvatarEdit')->name('headEdit');
    
    Route::get('/ajaxcity','UserCenterController@ajaxCity')->name('ajaxcity');
    Route::get('/ajaxarea','UserCenterController@ajaxArea')->name('ajaxarea');
    
//    我的会员
    Route::get('/member','UserCenterController@member')->name('member');
//    我的下载
    Route::get('/download','UserCenterController@download')->name('download');
//    我的下载智能工具
    Route::get('/DownloadBrainpower','UserCenterController@DownloadBrainpower')->name('DownloadBrainpower');

    
    Route::get('/personCase', 'UserController@getPersonCase')->name('personCasePage');
    
    Route::get('/addpersoncase/{id}', 'UserController@getAddPersonCase')->name('caseCreatePage');
    
    Route::post('/addCase', 'UserController@postAddCase')->name('caseCreate');
    
    Route::get('/personevaluation', 'UserController@getPersonEvaluation')->name('');
    Route::get('/ajaxUpdateCase','UserController@ajaxUpdateCase')->name('ajaxUpdateCase');
    Route::get('/ajaxUpdateBack','UserController@ajaxUpdateBack')->name('ajaxUpdateBack');

    Route::post('/ajaxUpdatePic','UserController@ajaxUpdatePic')->name('ajaxUpdatePic');
    Route::get('/ajaxDelPic','UserController@ajaxDelPic')->name('ajaxDeletePic');

    
    Route::get('/personevaluationdetail/{id}','UserController@getPersonEvaluationDetail')->name('personevaluationPage');
    
    Route::get('/','UserCenterController@assetdetail')->name('successCaseList');

    
    Route::get('/messageList/{type}', 'MessageReceiveController@messageList')->name('messageList'); 
    Route::post('/allChange', 'MessageReceiveController@allChange')->name('allMessageStatusUpdate'); 
    Route::post('/contactMe', 'MessageReceiveController@contactMe')->name('messageCreate'); 
    Route::post('/changeStatus', 'MessageReceiveController@postChangeStatus')->name('messageStatusUpdate'); 

    
    Route::post('/changeAvatar', 'IndexController@ajaxChangeAvatar')->name('changeAvatar'); 

    
    Route::post('/ajaxDeleteSuccess', 'UserController@ajaxDeleteSuccess')->name('UserController');

    
    Route::get('/editpersoncase/{id}', 'UserController@getEditPersonCase')->name('caseUpdatePage');
    
    Route::post('/editCase', 'UserController@postEditCase')->name('caseUpdate');

    
    Route::post('/updateTips', 'IndexController@updateTips')->name('updateTips');






    
    Route::get('/shop', 'ShopController@getShop')->name('userShop');
    
    Route::post('/shop', 'ShopController@postShopInfo')->name('postShop');
    
    Route::post('/ajaxGetCity', 'ShopController@ajaxGetCity')->name('ajaxGetCity');
    
    Route::post('/ajaxGetArea', 'ShopController@ajaxGetArea')->name('ajaxGetArea');
    
    Route::post('/ajaxGetSecondCate', 'ShopController@ajaxGetSecondCate')->name('ajaxGetSecondCate');
    
    Route::get('/enterpriseAuth', 'ShopController@getEnterpriseAuth')->name('enterpriseAuth');
    
    Route::post('/enterpriseAuth', 'ShopController@postEnterpriseAuth')->name('postEnterpriseAuth');
    Route::post('/fileUpload','ShopController@fileUpload')->name('enterpriseAuthFileCreate');
    Route::get('/fileDelete','ShopController@fileDelete')->name('enterpriseAuthFileDelete');
    Route::get('/enterpriseAuthAgain', 'ShopController@enterpriseAuthAgain')->name('enterpriseAuthAgain');
    
    Route::get('/myShopSuccessCase', 'ShopController@shopSuccessCase')->name('shopSuccessCase');
    Route::get('/addShopSuccess', 'ShopController@addShopSuccess')->name('addShopSuccess');
    Route::post('/postAddShopSuccess','ShopController@postAddShopSuccess')->name('postAddShopSuccess');
    Route::get('/editShopSuccess/{id}', 'ShopController@editShopSuccess')->name('editShopSuccess');
    Route::post('/postEditShopSuccess','ShopController@postEditShopSuccess')->name('postEditShopSuccess');
    Route::post('/deleteShopSuccess','ShopController@deleteShopSuccess')->name('deleteShopSuccess');

    Route::get('/serviceCreate', 'ServiceController@serviceCreate')->name('serviceCreate');
    Route::post('/serviceUpdate','ServiceController@serviceUpdate')->name('serviceUpdate');
    Route::get('/serviceBounty/{id}','ServiceController@serviceBounty')->name('serviceBounty');
    Route::post('/serviceBountyPay','ServiceController@serviceBountyPay')->name('serviceBountyPay');
    Route::get('/serviceList', 'ServiceController@serviceList')->name('serviceList');
    Route::get('/serviceAdded/{id}', 'ServiceController@serviceAdded')->name('serviceAdded');
    Route::get('/serviceDelete/{id}', 'ServiceController@serviceDelete')->name('serviceDelete');
    Route::get('/serviceMine', 'ServiceController@serviceMine')->name('serviceMine');
    Route::get('/serviceMyJob', 'ServiceController@serviceMyJob')->name('serviceMyJob');
    Route::get('/serviceEdit/{id}', 'ServiceController@serviceEdit')->name('serviceEdit');
    Route::post('/serviceEditUpdate', 'ServiceController@serviceEditUpdate')->name('serviceEditUpdate');
    Route::get('/serviceAttchDelete', 'ServiceController@serviceAttchDelete')->name('serviceAttchDelete');
    Route::post('/serviceEditCreate', 'ServiceController@serviceEditCreate')->name('serviceEditCreate');
    Route::get('/serviceEditNew/{id}', 'ServiceController@serviceEditNew')->name('serviceEditNew');
    Route::get('/shopcommentowner', 'ServiceController@shopcommentowner')->name('shopcommentowner');
    Route::get('/waitServiceHandle/{id}', 'ServiceController@waitServiceHandle')->name('waitServiceHandle');
    Route::post('/servicecashvalid', 'ServiceController@serviceCashValid')->name('serviceCashValid');

    
    Route::get('/pubGoods', 'GoodsController@getPubGoods')->name('getPubGoods');

//    原post请求
//    Route::post('/pubGoods', 'GoodsController@postPubGoods')->name('postPubGoods');
    Route::post('/pubGoods', 'GoodsController@postNewPubGoods')->name('postPubGoods');
//    软性删除
    Route::get('/goodsShopdel/{id}', 'GoodsController@goodsShopdel')->name('goodsShopdel');
//    我的作品编辑
    Route::get('/goodsShopedit/{id}', 'GoodsController@goodsShopedit')->name('goodsShopedit');

    Route::get('waitGoodsHandle/{id}', 'GoodsController@waitGoodsHandle');
    
    Route::get('/goodsShop', 'GoodsController@shopGoods')->name('shopGoods');
    
    Route::get('/editGoods/{id}', 'GoodsController@editGoods')->name('editGoods');
    
    Route::post('/postEditGoods', 'GoodsController@postEditGoods')->name('postEditGoods');
    Route::post('/goodsCashValid', 'GoodsController@goodsCashValid')->name('goodsCashValid');

    
    Route::get('/myBuyGoods', 'GoodsController@myBuyGoods')->name('myBuyGoods');

    
    Route::get('/mySellGoods', 'GoodsController@mySellGoods')->name('mySellGoods');

    
    Route::get('/myCollectShop', 'ShopController@myCollectShop')->name('myCollectShop');
    Route::post('/cancelCollect', 'ShopController@cancelCollect')->name('cancelCollect'); 

    
    Route::get('/myShopHint', 'ShopController@myShopHint')->name('myShopHint');


    Route::post('/changeGoodsStatus', 'GoodsController@changeGoodsStatus')->name('changeGoodsStatus'); 

    
    Route::get('/switchUrl', 'ShopController@switchUrl')->name('switchUrl');

    
    Route::get('/userShopBefore', 'ShopController@userShopBefore')->name('userShopBefore');

    
    Route::get('/myAnswer', 'QuestionController@myAnswer')->name('myAnswer');
    
    Route::get('/myquestion', 'QuestionController@myQuestion')->name('myquestion');


    
    Route::get('/promoteUrl', 'PromoteController@promoteUrl')->name('promoteUrl');
    
    Route::get('/promoteProfit', 'PromoteController@promoteProfit')->name('promoteUrl');


    
    Route::get('/vippaylist', 'ShopController@vippaylist')->name('vippaylist');

    Route::get('/vippaylog/{id}', 'ShopController@vippaylog')->name('vippaylog'); 


    Route::get('/vipshopbar', 'ShopController@vipshopbar')->name('vipshopbar'); 
    Route::post('/vipshopbar', 'ShopController@postVipshopbar'); 

    Route::get('delVipshopFile', 'ShopController@delVipshopFile');
});


