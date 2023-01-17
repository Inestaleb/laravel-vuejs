<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
//frontend
        Route::post('register', 'App\Http\Controllers\Api\AuthController@register');
        Route::post('login', 'App\Http\Controllers\Api\AuthController@login');
        Route::get('/search','App\Http\Controllers\Api\FrontendController@searchBasedOnName');
        Route::get('/chercher','App\Http\Controllers\Api\FrontendController@search');
        Route::get('/getspecialite','App\Http\Controllers\Api\AdminController@index');
        Route::get('/getTime','App\Http\Controllers\Api\TimeController@getTime');
        Route::post('/store','App\Http\Controllers\Api\InvoiceController@store');
//routes patient&doctor
Route::middleware('auth:api')->group(function () {
    Route::post('/logout', 'App\Http\Controllers\Api\AuthController@logout');
    Route::post('/change-password', 'App\Http\Controllers\Api\AuthController@change_password');
    Route::get('/contact-list/{id}', 'App\Http\Controllers\Api\ChatsController@getContactList');
    Route::get('/conversation/{id}', 'App\Http\Controllers\Api\ChatsController@getMessages');
    Route::post('/conversation/send', 'App\Http\Controllers\Api\ChatsController@sendNewMessage');
    Route::get('/video', 'App\Http\Controllers\Api\VideoChatController@index');
    Route::post('/video_chat', 'App\Http\Controllers\Api\VideoChatController@auth');
});


   //routes for admin
    Route::middleware(['auth','admin'])->group(function () {
        Route::get('/specialites','App\Http\Controllers\Api\AdminController@index');
        Route::get('/getSpecialites/{id}','App\Http\Controllers\Api\AdminController@getSpecialites');
        Route::post('/save_Specialites','App\Http\Controllers\Api\AdminController@save_Specialites');
        Route::post('/UpdateSpecialite/{id}','App\Http\Controllers\Api\AdminController@specialiteUpdate');
        Route::get('/getPatient','App\Http\Controllers\Api\AdminController@getPatient');
        Route::get('/getDoctor','App\Http\Controllers\Api\AdminController@getDoctor');
        Route::post('/DoctorUpdate/{id}','App\Http\Controllers\Api\AdminController@DoctorUpdate');
        Route::get('/getapptitude/{id}','App\Http\Controllers\Api\AdminController@getapptitude');

    });
      Route::post('paymeePost','App\Http\Controllers\Api\PaymentController@paymeePost'); 
    //routes for Patient
  Route::middleware(['auth','patient'])->group(function () {
        Route::post('/appointements','App\Http\Controllers\Api\AppointementController@store');
        Route::get('/getAppointement/{id}','App\Http\Controllers\Api\AppointementController@getAppointement');
        Route::get('doctor/{id}','App\Http\Controllers\Api\FrontendController@Doctor');
        Route::get('/Appointement','App\Http\Controllers\Api\AppointementController@appointement');
        Route::get('/getTime','App\Http\Controllers\Api\TimeController@getTime');
        Route::get('/time/{id}','App\Http\Controllers\Api\TimeController@time');
        Route::post('/UpdateProfil/{id}','App\Http\Controllers\Api\ProfilController@profilUpdate');
        Route::delete('/deleteAppointment/{id}','App\Http\Controllers\Api\AppointementController@destroy');
        Route::post('/AppointementUpdate/{id}','App\Http\Controllers\Api\AppointementController@AppointementUpdate');
        Route::get('/prescreption/{id}','App\Http\Controllers\Api\PrescriptionController@getprescreption');
        Route::get('/prescreption','App\Http\Controllers\Api\PrescriptionController@index');
        Route::get('/getinvoice','App\Http\Controllers\Api\InvoiceController@invoice');
        Route::get('/Others', 'App\Http\Controllers\Api\VideoChatController@Others');
    });
       Route::get('/invoice','App\Http\Controllers\Api\InvoiceController@getfacture');
       Route::get('/getAppointementID','App\Http\Controllers\Api\DoctorController@getAppointementID');
     
  ///////////////////api doctor
        Route::post('inscription', 'App\Http\Controllers\Api\DoctorController@register');
    Route::middleware(['auth','doctor'])->group(function () {
        Route::post('/setTime','App\Http\Controllers\Api\TimeController@setTime');
        Route::get('/getAppointement','App\Http\Controllers\Api\DoctorController@getAppointement');
        Route::get('/AllAppointement','App\Http\Controllers\Api\DoctorController@getAllAppointement');
        Route::get('/time','App\Http\Controllers\Api\TimeController@index');
        Route::delete('/deletetime/{id}','App\Http\Controllers\Api\TimeController@destroy');
        Route::get('/appointement/{id}','App\Http\Controllers\Api\DoctorController@AppointementID');
        Route::post('/addPrescription','App\Http\Controllers\Api\PrescriptionController@Store');
        Route::get('/getprescreption/{id}','App\Http\Controllers\Api\PrescriptionController@getprescreption');
        Route::get('/getprescreption','App\Http\Controllers\Api\PrescriptionController@index');
        Route::get('/getinvoice','App\Http\Controllers\Api\InvoiceController@invoice');
        Route::post('/Update/{id}','App\Http\Controllers\Api\ProfilController@profilUpdateDoctor');
        Route::post('/AccepterAppointement/{id}','App\Http\Controllers\Api\AppointementController@AccepterAppointement');
        Route::post('/RefuserAppointement/{id}','App\Http\Controllers\Api\AppointementController@RefuserAppointement');
        Route::get('/GetOthers', 'App\Http\Controllers\Api\VideoChatController@GetOthers');
       
    });
