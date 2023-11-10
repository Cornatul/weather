<?php


Route::group([
    'prefix' => 'api',
    'middleware' => ['api'],
    'namespace' => 'Cornatul\Weather\Http\Controllers',
], function () {
    Route::get('weather', 'WeatherController@getWeather');
    Route::get('location', 'WeatherController@getLocation');
});
