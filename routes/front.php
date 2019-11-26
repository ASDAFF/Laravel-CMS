<?php

Route::group(['prefix' => 'blog', 'as' => 'blog.'], function () {
	Route::get('', 'BlogController@index')->name('index');
	Route::get('categories', 'BlogController@getCategories')->name('categories');
	Route::get('categories/{category_url}', 'BlogController@getCategory')->name('category');
	Route::get('tags', 'BlogController@getTags')->name('tags');
	Route::get('tags/{tag_url}', 'BlogController@getTag')->name('tag');
	Route::get('{blog_url}', 'BlogController@show')->name('show');
});
Route::post('subscribe', 'PageController@postSubscribe')->name('page.subscribe')->middleware('throttle:2,1');
Route::get('{page_url?}', 'PageController@getIndex')->name('page.index');

Route::group(['prefix' => 'test-windy', 'as' => 'test.windy.'], function () {
	// Route::get('image', 'TestMapController@getImage')->name('images');
	
	// Route::group(['prefix' => 'ecmwf-hres/{year}/{month}/{day}/{hour}/{zoom}/{x}/{y}/'], function () {
	// 	// Route::get('wind-surface.jpg', 'TestMapController@getWindSurface')->name('wind');
	// 	Route::get('temp-surface.jpg', 'TestMapController@getTempSurface')->name('temp');
	// 	Route::get('pressure-surface.png', 'TestMapController@getPressureSurface')->name('pressure');
	// 	Route::get('pressure-surface.json', 'TestMapController@getPressureSurface')->name('pressure');
	// 	Route::get('cloudsrain-surface.jpg', 'TestMapController@getCloudSurface')->name('cloud');
	// });
	
	// /siw0/0/0/pressure-surface.json?reftime=2019062112
	// Route::get('tiles/v9.0/darkmap/{zoom}/{x}/{y}', 'TestMapController@getTitlesImages')->name('tiles-images');
	// Route::get('labels/v1.3/en/{zoom}/{x}/{y}', 'TestMapController@getTitlesLabels')->name('tiles-labels');
	Route::get('capalerts/{lat}/{lng}', 'TestMapController@getNodeCapalerts')->name('node.capalerts');
	Route::get('node/connection', 'TestMapController@getNodeConnection')->name('node.connection');
	Route::get('users/info', 'TestMapController@getUsersInfo')->name('users.info');
	Route::get('sedlina/ga/{id}', 'TestMapController@getSedlinaGa')->name('sedlina.ga');
	Route::get('forecast/citytile/v1.3/ecmwf/{zoom}/{lat}/{lng}', 'TestMapController@getForecastCitytile')->name('forecast.citytile.ecmwf');
	Route::get('node/geoip', 'TestMapController@getNodeGeoip')->name('node.geoip');
	Route::get('Zm9yZWNhc3Q/ZWNtd2Y/cG9pbnQvZWNtd2YvdjIuNS8zNS42OTYxLzUxLjQyMzE/c291cmNlPWhwJnNldHVwPXN1bW1hcnkmaW5jbHVkZU5vdz10cnVl', 'TestMapController@getToken')->name('token');
	Route::get('reverse/v3/{lat}/{lng}/{zoom}', 'TestMapController@getReverse')->name('reverse');
	// Route::get('payments/total', 'TestMapController@getNodeConnection')->name('node.connection');
	// Route::get('rplanner/v1/elevation/{coordinate}', 'TestMapController@getAltitude')->name('altitude');
	// Route::get('gfs/{year}/{month}/{day}/{hour}/{zoom}/{x}/{y}/wind-surface.jpg', 'TestMapController@getWindSurface')->name('ims.ecmwf-hres');
	// Route::get('node/reverse/v3/{lat}/{lng}/{zoom}', 'TestMapController@getNodeReverse')->name('node.reverse');
	// Route::get('node/forecast/v2.4/ecmwf/{lat}/{lng}', 'TestMapController@getNodeForecast')->name('node.forecast');
	// Route::get('ecmwf-hres/minifest2.json', 'TestMapController@getMinifest2Ecmwf')->name('ecmswf.mini');
	// Route::get('gfs/minifest2.json', 'TestMapController@getMinifest2Gfs')->name('gfs.mini');
	// Route::get('forecast/citytile/v1.3/gfs/{zoom}/{lat}/{lng}', 'TestMapController@getForecastCitytile')->name('forecast.citytile.gfs');
	// Route::post('sedlina/err', 'TestMapController@getNodeConnection')->name('sedlina.err');
});

// windy map
Route::get('distance/{coordinate}', 'PageController@getIndex')->name('distance.coordinate');
Route::get('-Show-add-more-layers/overlays', 'PageController@getIndex')->name('layers.overlays');


// Route::group(['prefix' => 'test-eric', 'as' => 'test.eric.'], function () {
// 	Route::get('upload-image', 'TestController@getUploadImage')->name('upload-image');
// 	Route::get('access-token', 'TestController@getAccessToken')->name('access-token');
// 	Route::get('new-job', 'TestController@getNewJob')->name('new-job');
// 	Route::post('new-job', 'TestController@postNewJob')->name('post-new-job');
// 	Route::get('url-parameter', 'TestController@getParameter')->name('url-parameter');
// 	Route::get('thank-you', 'TestController@getThankYou')->name('thank-you');
// 	Route::get('redirected', 'TestController@getRedirected')->name('redirected');
// });