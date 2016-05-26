<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('index');
});
Route::get('/country',array(
    'as'=>'country',
    'uses'=>'CountryController@datatables'
));
Route::get('tabletwo',array(
    'as'=>'tabletwo',
    'uses'=>'CountryController@tabletwo'));
Route::post('deleteRow','CountryController@deleteRow');
Route::any('edit/{id}',array(
    'as'=>'edit',
    'uses'=>'CountryController@editRow'));
Route::post('/EditRow',array(
    'as'=>'editedRow',
    'uses'=>'CountryController@editedRow'));
Route::get('ajaxcall',array(
    'as'=>'ajaxcall',
    'uses'=>'CountryController@ajaxcall'
));
Route::get('/continent',array(
    'as'=>'continent',
    'uses'=>'CountryController@continent'
));
Route::get('continentcall',array(
    'as'=>'continentcall',
    'uses'=>'CountryController@continentcall'
));
Route::any('editcontinent/{id}',array(
    'as'=>'editcontinent',
    'uses'=>'CountryController@editcontinent'));

Route::post('/editedContinent',array(
    'as'=>'editedContinent',
    'uses'=>'CountryController@editedContinent'));
Route::get('/models',array(
    'as'=>'models',
    'uses'=>'CountryController@modal'
));
Route::post('deletecontinent','CountryController@deletecontinent');
Route::get('validator',array(
    'as'=>'validator',
    'uses'=>'validController@index'
));
Route::get('practisemodel',array(
    'as'=>'practisemodel',
    'uses'=>'validController@pract'
));
Route::post('practise',array(
    'as'=>'practise',
    'uses'=> 'validController@create'));
