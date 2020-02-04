<?php




Route::group(['prefix' => 'vipshop'], function() {
	Route::get('/','VipshopController@Index')->name('shopIndex');


	Route::get('index','VipshopController@Index')->name('vipIndex');
	Route::get('page','VipshopController@Page')->name('vipPage');
	Route::get('details/{id}','VipshopController@Details')->name('vipDeails');
	Route::get('payvip','VipshopController@getPayvip')->name('payvip');
    Route::post('feedback','VipshopController@feedback')->name('addFeedback');
    Route::get('vipinfo','VipshopController@vipinfo')->name('vipinfo');
});

Route::group(['prefix' => 'vipshop', 'middleware' => 'auth'], function (){
    Route::post('payvip','VipshopController@postPayvip');
//    设计师凭证页面提交
    Route::post('/','VipshopController@postPayvipNew');
    Route::get('vipPayorder','VipshopController@vipPayorder')->name('vipPayorder');
//    设计师凭证页面付钱页面
    Route::get('vipPayorder/{code}','VipshopController@vipPayorderNew')->name('vipPayorder');
    Route::post('vipPayorder', 'VipshopController@postVipPayorder');
//    设计师凭证页面付钱提交
    Route::post('vipPayorderNew', 'VipshopController@postVipPayorderNew');
    Route::post('thirdPayorder', 'VipshopController@thirdPayorder');
//    设计师凭证页面付钱提交第三方
    Route::post('thirdPayorderNew', 'VipshopController@thirdPayorderNew');
    Route::get('vipsucceed','VipshopController@vipSucceed')->name('vipSucceed');
    Route::get('vipfailure','VipshopController@vipFailure')->name('vipFailure');

});
