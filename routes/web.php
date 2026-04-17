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

Auth::routes();

Route::group(['middleware' => ['auth']], function () {

    // Dashboard routes
    Route::get('/', function () {
        return \Redirect::route('patients.index');
    })->name('home');
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    //Users routes
    Route::resource('/users', 'UserController');
    Route::get('users/{id}/delete', 'UserController@destroy')->name('users.delete');

    //Consultations routes
    Route::resource('patients', 'PatientController');
    Route::get('patients/{patient}/edit', 'PatientController@edit')->name('patients.edit');
    Route::get('patients/{patient}/delete', 'PatientController@destroy')->name('patients.delete');
    Route::post('patients/get_patients', 'PatientController@get_patients')->name('get_liste_patients');

    //Consultations routes
    Route::resource('consultations', 'ConsultationController');
//    Route::post('consultations/{consultation}/update', 'ConsultationController@update')->name('consultations.update');
    Route::get('consultations/create/{patient?}', 'ConsultationController@create')->name('consultations.create');
    Route::get('consultations/{consultation}/delete', 'ConsultationController@destroy')->name('consultations.delete');
    Route::get('consultations/{consultation}/terminer', 'ConsultationController@terminer_consultation')->name('consultations.terminer');

    // Roles routes
    Route::resource('roles', 'RoleController');
    Route::get('roles/{role}/delete', 'RoleController@destroy')->name('roles.delete');

    //Examens routes
    Route::resource('/examens', 'ExamenController');
    Route::get('examens/create/{consultation?}', 'ExamenController@create')->name('examens.create');
    Route::get('examens/{examen}/delete', 'ExamenController@destroy')->name('examens.delete');

    //Ordonnances routes
    Route::resource('ordonnances', 'OrdonnanceController');
    Route::get('ordonnances/create/{consultation?}', 'OrdonnanceController@create')->name('ordonnances.create');
    Route::get('ordonnances/{ordonnance}/delete', 'OrdonnanceController@destroy')->name('ordonnances.delete');

});
