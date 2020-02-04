<?php




Route::group(['prefix' => 'bre'], function() {
    Route::get('/', 'IndexController@index')->name('indexList');

    
    Route::get('/service', 'IndexController@getService')->name('serviceList');
    Route::post('/feedbackInfo', 'IndexController@creatInfo')->name('feedbackCreate');
    Route::get('/serviceCaseList/{uid}', 'ServiceController@serviceCaseList')->name('serviceCaseList');
    Route::get('/serviceEvaluateDetail/{uid}', 'ServiceController@serviceEvaluateDetail')->name('serviceEvaluateDetail');
    Route::get('/serviceCaseDetail/{id}/{uid}', 'ServiceController@serviceCaseDetail')->name('serviceCaseDetail');
    Route::get('/ajaxAdd', 'ServiceController@ajaxAdd')->name('ajaxCreateAttention');
    Route::get('/ajaxDel', 'ServiceController@ajaxDel')->name('ajaxDeleteAttention');
    Route::post('/contactMe', 'ServiceController@contactMe')->name('messageCreate');

    //新增的下载购买页面
    Route::get('shop/buyGoodsNew/{id}','IndexController@buyGoodsNew')->name('buyGoodsNew');
    
    Route::get('/agree/{code_name}', 'AgreementController@index')->name('agreementDetail');

    
    Route::get('/shop', 'IndexController@shop')->name('shopList');
    
    Route::get('/changeUrl', 'IndexController@changeUrl')->name('changeUrl');

    
    Route::post('/ajaxGoodsList', 'IndexController@ajaxGoodsList')->name('ajaxGoodsList');

});


Route::group(['prefix' => 'bre','middleware' => 'auth'], function() {
//    设计师空间评论ajax
    Route::post('/ajaxComment','TaskController@ajaxComment')->name('ajaxCreateComment');
//    设计师作品评论ajax
    Route::post('/ajaxCommentGoods','TaskController@ajaxCommentGoods')->name('ajaxCommentGoods');
//    删除设计师空间评论
    Route::post('/ajaxCommentDel', 'ServiceController@ajaxCommentDel')->name('ajaxCommentDel');
//    删除设计师作品评论
    Route::post('/ajaxCommentGoodsDel', 'ServiceController@ajaxCommentGoodsDel')->name('ajaxCommentGoodsDel');

});


Route::group(['prefix' => 'bre', 'middleware' => ['ruleengine']], function () {
	

	

    
    
});
