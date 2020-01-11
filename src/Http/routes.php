<?php

Route::group([
    'namespace' => 'Seat\Akturis\Paps\Http\Controllers',
    'middleware' => ['web', 'auth'],
    'prefix' => 'character',
], function() {

    Route::get('/{character_id}/paps_main', [
        'as' => 'character.view.paps_main',
        'uses' => 'CharacterController@papsMain',
        'middleware' => 'characterbouncer:akturis_calendar_paps',
    ]);

});

Route::group([
    'namespace' => 'Seat\Akturis\Main\Http\Controllers',
    'middleware' => ['web', 'auth'],
    'prefix' => 'corporation',
], function() {

    Route::get('/{corporation_id}/paps_main', [
        'as' => 'corporation.view.paps_main',
        'uses' => 'CorporationController@getPapsMain',
        'middleware' => 'corporationbouncer:akturis_calendar_paps',
    ]);

    Route::get('/{corporation_id}/paps_main/json/year', [
        'as' => 'corporation.ajax.paps_main.year',
        'uses' => 'CorporationController@getYearPapsMainStats',
        'middleware' => 'corporationbouncer:akturis_calendar_paps',
    ]);

    Route::get('/{corporation_id}/paps_main/json/stacked', [
        'as' => 'corporation.ajax.paps_main.stacked',
        'uses' => 'CorporationController@getMonthlyStackedPapsMainStats',
        'middleware' => 'corporationbouncer:akturis_calendar_paps',
    ]);

});

Route::group([
    'namespace' => 'Seat\Kassie\Calendar\Http\Controllers',
    'middleware' => ['web', 'auth'],
    'prefix' => 'paps',
], function() {

    Route::get('/paps', [
        'as' => 'paps.view',
        'uses' => 'PapsController@getPaps',
        'middleware' => 'corporationbouncer:kassie_calendar_paps',
    ]);

});
