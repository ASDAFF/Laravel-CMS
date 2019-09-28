<?php

Route::group(['prefix' => 'blog', 'as' => 'blog.'], function () {
	Route::get('', 'BlogController@index')->name('index');
	Route::get('categories', 'BlogController@getCategories')->name('categories');
	Route::get('categories/{category_url}', 'BlogController@getCategory')->name('category');
	Route::get('tags', 'BlogController@getTags')->name('tags');
	Route::get('tags/{tag_url}', 'BlogController@getTag')->name('tag');
	Route::get('{blog_url}', 'BlogController@show')->name('show');
});
Route::post('subscribe', 'PageController@postSubscribe')->name('page.subscribe')->middleware('throttle:4,2');
Route::get('{page_url?}', 'PageController@getIndex')->name('page.index');



Route::group(['prefix' => 'test-map', 'as' => 'test.map.'], function () {
	Route::get('offline', 'TestMapController@getOffline')->name('offline');
});

Route::group(['prefix' => 'test-eric', 'as' => 'test.eric.'], function () {
	Route::get('upload-image', 'TestController@getUploadImage')->name('upload-image');
	Route::get('access-token', 'TestController@getAccessToken')->name('access-token');
	Route::get('new-job', 'TestController@getNewJob')->name('new-job');
	Route::post('new-job', 'TestController@postNewJob')->name('post-new-job');
	Route::get('url-parameter', 'TestController@getParameter')->name('url-parameter');
	Route::get('thank-you', 'TestController@getThankYou')->name('thank-you');
	Route::get('redirected', 'TestController@getRedirected')->name('redirected');
});