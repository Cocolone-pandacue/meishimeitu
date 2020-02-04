<?php




Route::group(['prefix' => 'task','middleware' => 'auth'], function() {

//选择发布项目的类别
    Route::get('/type/{orderNumber?}','IndexController@type')->name('taskType');
//    发布项目的详情内容
    Route::get('/createnewdetail/{id}/{orderNumber?}','IndexController@createnewdetail')->name('taskcreatenewdetail');
//    发布项目的详情内容提交
    Route::post('/createnewdetail','IndexController@createnewdetailpost')->name('createnewdetailpost');
//    发布项目类型
    Route::get('/createnew/{orderNumber?}','IndexController@createnew')->name('taskCreateNewPage');
//    发布类型提交
    Route::post('/createnew','IndexController@createnewpost')->name('createnew');
//    删除发布任务的图片
    Route::get('/taskFileDelet','IndexController@taskFileDelet')->name('taskFileDelet');
//    及时搜索路由
//    Route::get('publishajax/','IndexController@publishajax')->name('taskPublishajax');
	Route::get('/create','IndexController@create')->name('taskCreatePage');
//    Route::get('/audit/{jsid?}','IndexController@audit')->name('auditCreatePage');
//    经纪人代发项目
    Route::get('/brokerSuccess/{id}','IndexController@brokerSuccess')->name('taskBrokerSuccess');
	Route::post('/createTask','IndexController@createTask')->name('taskCreate');
    Route::post('/createTaskNew','IndexController@createTaskNew')->name('taskCreateTaskNew');
	Route::post('/fileUpload','IndexController@fileUpload')->name('fileCreate');
	Route::get('/fileDelet','IndexController@fileDelet')->name('fileDelete');
//	发布项目付款页面
	Route::get('/bounty/{id}','IndexController@bounty')->name('bountyPage');
	Route::get('/getTemplate','IndexController@getTemplate')->name('ajaxTemplate');
	Route::get('/preview','IndexController@preview')->name('previewPage');
	Route::get('/release/{id}','IndexController@release')->name('releaseDetail');
	Route::get('/tasksuccess/{id}','IndexController@tasksuccess')->name('tasksuccess');

//	申请项目ajax
    Route::post('/myTasksAsk','DetailController@myTasksAsk')->name('taskmyTasksAsk');

	Route::post('/workCreate','DetailController@workCreate')->name('workCreate');
	Route::get('/workdelivery/{id}','DetailController@work')->name('workdeliveryPage');

	Route::post('/ajaxAttatchment','DetailController@ajaxWorkAttatchment')->name('ajaxCreateAttatchment');
	Route::get('/delAttatchment','DetailController@delAttatchment')->name('attatchmentDelete');
	Route::get('/winBid/{work_id}/{task_id}','DetailController@winBid')->name('winBid');
	Route::get('/download/{id}','DetailController@download')->name('download');
	Route::get('/delivery/{id}','DetailController@delivery')->name('taskdeliveryPage');
	Route::post('/deliverCreate','DetailController@deliverCreate')->name('deliverCreate');
	Route::get('/check','DetailController@workCheck')->name('check');
	Route::get('/lostCheck','DetailController@lostCheck')->name('lostCheck');
	Route::get('/evaluate','DetailController@evaluate')->name('evaluatePage');
	Route::post('/evaluateCreate','DetailController@evaluateCreate')->name('evaluateCreate');
//	项目结款
    Route::get('/check/{id}','DetailController@workCheckId')->name('checkId');
    Route::post('/checkAjax','DetailController@workCheckIdAjax')->name('checkId');
	
	Route::post('/ajaxRights','DetailController@ajaxRights')->name('ajaxCreateRights');
	
	Route::post('/report','DetailController@report')->name('reportCreate');

    //收藏设计师作品ajax
    Route::get('/ajaxGoodAdd', 'IndexController@ajaxGoodAdd')->name('ajaxGoodAdd');
    //取消收藏设计师作品ajax
    Route::get('/ajaxGoodDel', 'IndexController@ajaxGoodDel')->name('ajaxGoodDel');
	
	Route::get('/getComment/{id}','DetailController@getComment')->name('commentList');
	Route::post('/ajaxComment','DetailController@ajaxComment')->name('ajaxCreateComment');

//	发布项目post提交付款
	Route::post('/bountyUpdate','IndexController@bountyUpdate')->name('bountyUpdate');
	Route::get('/result','IndexController@result')->name('resultCreate');
	Route::post('/notify','IndexController@notify')->name('notifyCreate');
	
	Route::get('/weixinNotify','IndexController@weixinNotify')->name('weixinNotifyCreate');

	
	Route::get('/ajaxcity','IndexController@ajaxcity')->name('ajaxcity');
	Route::get('/ajaxarea','IndexController@ajaxarea')->name('ajaxarea');

	
	Route::get('/imgupload','IndexController@imgupload')->name('imgupload');

	
	
	Route::post('/checkDeadlineByBid','IndexController@checkDeadlineByBid')->name('checkDeadlineByBid');
	
	Route::get('/buyServiceTaskBid/{id}','IndexController@buyServiceTaskBid')->name('buyServiceTaskBid');
	
	Route::post('/buyServiceTaskBid','IndexController@postBuyServiceTaskBid')->name('postBuyServiceTaskBid');

	
	Route::get('/tenderWork/{id}','DetailController@tenderWork')->name('tenderWork');
	
	Route::get('/bidWinBid/{work_id}/{task_id}','DetailController@bidWinBid')->name('bidWinBid');
	
	Route::get('/bidBounty/{id}','IndexController@bidBounty')->name('bidBounty');
	
	Route::post('/bidBountyUpdate','IndexController@bidBountyUpdate')->name('bidBountyUpdate');
	
	Route::get('/payType/{id}','DetailController@payType')->name('payType');
	
	Route::get('/ajaxPaySection','DetailController@ajaxPaySection')->name('ajaxPaySection');
	
	Route::post('/postPayType','DetailController@postPayType')->name('postPayType');
	
	Route::get('/checkPayType/{taskid}/{status}','DetailController@checkPayType')->name('checkPayType');
	
	Route::get('/payTypeAgain/{id}','DetailController@payTypeAgain')->name('payTypeAgain');
	
	Route::get('/bidDelivery/{id}','DetailController@bidDelivery')->name('bidDelivery');
	Route::post('/bidDeliverCreate','DetailController@bidDeliverCreate')->name('bidDeliverCreate');
	
	Route::get('/bidWorkCheck','DetailController@bidWorkCheck')->name('bidWorkCheck');
	
	Route::post('/ajaxBidRights','DetailController@ajaxBidRights')->name('ajaxBidRights');

	
	Route::get('/toKee/{id}','DetailController@toKee')->name('toKee');
//智能工具

	// 保存收藏logo
	Route::post('/brainpower/processsave', 'SuccessCaseController@processsave')->name('processsave');

	// 购买套餐
	Route::get('/brainpower/purchaseLogo', 'SuccessCaseController@purchaseLogo')->name('purchaseLogo');

	// 检测是否已支付
	Route::get('/brainpower/checkPay', 'SuccessCaseController@checkPay')->name('checkPay');
//智能工具
//    Route::get('/brainpower','SuccessCaseController@brainpower')->name('brainpower');
//    调查问卷
    Route::get('/brainpower/questionnaire','SuccessCaseController@questionnaire')->name('questionnaire');
//    Route::post('/brainpower/questionnaire','SuccessCaseController@questionnairepost')->name('questionnairepost');
//    处理过程动画
//    Route::get('/brainpower/processing','SuccessCaseController@processing')->name('processing');
//    处理过程动画ajax
    Route::post('/brainpower/processingajax','SuccessCaseController@processingajax')->name('processingajax');
    Route::post('/brainpower/processingajaxtwo','SuccessCaseController@processingajaxtwo')->name('processingajaxtwo');
    Route::post('/brainpower/processingajaxdown','SuccessCaseController@processingajaxdown')->name('processingajaxdown');
    Route::post('/brainpower/processingajaxshow','SuccessCaseController@processingajaxshow')->name('processingajaxshow');
//    接受图片路径存入数据库
//    Route::post('/brainpower/processingget','SuccessCaseController@processingget')->name('processingget');
//    结果
    Route::get('/brainpower/result','SuccessCaseController@result')->name('result');
    Route::post('/brainpower/result','SuccessCaseController@result')->name('result');
});


Route::group(['prefix'=>'task'],function(){
	
	Route::get('/','IndexController@tasks')->name('taskList');
	
	Route::get('/{id}','DetailController@index')->name('taskDetailPage')->where('id', '[0-9]+');
//    项目库ajax详情
    Route::post('/taskAjax','IndexController@taskAjax')->name('taskAjax');

//私人订制
    Route::get('/privateDesign/{id}','IndexController@privatedesign')->name('taskPrivateDesign');

//    专栏
    Route::get('/column/{id}','IndexController@column')->name('taskcolumn');

	Route::get('/successCase','SuccessCaseController@index')->name('successCaseList');
	Route::get('/successDetail/{id}','SuccessCaseController@detail')->name('successDetail');
	Route::get('/successJump/{id}','SuccessCaseController@jump')->name('successJump');
	
	Route::post('/checkbounty','IndexController@checkBounty')->name('checkbounty');
	Route::post('/checkdeadline','IndexController@checkDeadline')->name('checkdeadline');

	
	Route::get('/ajaxPageWorks/{id}','DetailController@ajaxPageWorks')->name('ajaxPageWorks');
	Route::get('/ajaxPageDelivery/{id}','DetailController@ajaxPageDelivery')->name('ajaxPageDelivery');
	Route::get('/ajaxPageComment/{id}','DetailController@ajaxPageComment')->name('ajaxPageComment');

	
	Route::get('/collectionTask/{task_id}','IndexController@collectionTask');
	Route::post('/collectionTask','IndexController@postCollectionTask');
	
	Route::get('/rememberTable','DetailController@rememberTable');


});
