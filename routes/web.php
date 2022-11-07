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

Route::view('/','accueil')->name('PageAccueil');
Route::post('AuthentificationCompteUtilisateur','AuthentificationController@authentificationCompteUtilisateur')->name('AuthentificationCompteUtilisateur');
Route::group(['prefix' => 'reservation'], function(){
    Route::get('SaisirReservation', 'ReservationController@saisirReservation')->name('SaisirReservation');
});
Route::post('AjouterReservation', 'ReservationController@ajouterReservation')->name('AjouterReservation');
Route::post('AjouterLigneReservation', 'ReservationController@ajouterLigneReservation')->name('AjouterLigneReservation');
