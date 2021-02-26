<?php

Route::namespace('App\Modules\Account\Controllers')->group(function () {

    Route::post('/login', 'CarsController@login');


    Route::group(['middleware' => 'guest:api'], function () {
        Route::post('/register', 'CarsController@register');
    });



    Route::group(['middleware' => ['api']], function () {

        Route::post('/logout', 'CarsController@logout');
        Route::post('/refresh', 'CarsController@refresh');

        Route::group(['middleware' => ['jwt.auth']], function () {

            Route::get('/user-profile', 'CarsController@userProfile');
        });
    });
});
