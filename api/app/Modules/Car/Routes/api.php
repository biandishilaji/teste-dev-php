<?php

Route::namespace('App\Modules\Car\Controllers')->group(function () {

    Route::group(['middleware' => ['api']], function () {

        Route::group(['prefix' => 'cars'], function () {

            Route::get('/', 'CarsController@getIndex');

            Route::get('/list', 'CarsController@getListPaginate');
            Route::get('/widgets', 'CarsController@getWidgets');

            Route::get('/{id}', 'CarsController@getCar');
            Route::put('/{id}', 'CarsController@putEditCar');

            Route::post('/', 'CarsController@postCreateCar');

            Route::delete('/{id}', 'CarsController@deleteRemoveCar');

        });

        Route::group(['prefix' => 'brands'], function () {

            Route::get('/', 'BrandsController@getBrands');
            Route::get('/list', 'BrandsController@getAllBrands');
            Route::post('/', 'BrandsController@postCreateBrand');

            Route::post('/generate', 'BrandsController@generateBrandsWithoutDbSeed');

        });


    });
});
