<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();
Route::get('/user/verify/{token}', 'Auth\RegisterController@verifyUser');

Route::group(['middleware' => 'auth'], function () {

  // Advance Routes
Route::get('/students', 'StudentController@index')->name('index');
Route::resource('students', 'StudentController');
Route::get('students_data/get_data', 'StudentGetController@index');

//import excel to db
Route::get('import-export-csv-excel',array('as'=>'excel.import','uses'=>'StudentController@importExportExcelORCSV'));
Route::post('import-csv-excel',array('as'=>'import-csv-excel','uses'=>'StudentController@importFileIntoDB'));
Route::get('download-excel-file/{type}', array('as'=>'excel-file','uses'=>'StudentController@downloadExcelFile'));
});
