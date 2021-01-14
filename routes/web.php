<?php

use Illuminate\Support\Facades\Auth;

// Route::get('/', [PosDeviceController::class, 'homeIndex'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');

Auth::routes(['register' => true]); //registeration turnedon
Route::group(['middleware'=>["auth"]], function (){


// Route::get('/', [PosDeviceController::class, 'homeIndex']);

Route::get('pos_device/createBulk', [PosDeviceController::class, 'createBulk'])->name('pos_device.createBulk');
Route::post('pos_device/importPos', [PosDeviceController::class, 'importPos'])->name('pos_device.importPos');
Route::resource('pos_device', PosDeviceController::class);

Route::get('fastlink_number/createBulk', [FastlinkNumberController::class, 'createBulk'])->name('fastlink_number.createBulk');
Route::post('fastlink_number/importFastlinkNumber', [FastlinkNumberController::class, 'importFastlinkNumber'])->name('fastlink_number.importFastlinkNumber');
Route::resource('fastlink_number', FastlinkNumberController::class);

Route::get('requisition/assign/{id}', [RequisitionController::class, 'assign'])->name('requisition.assign');
Route::post('requisition/assign/{id}/store', [RequisitionController::class, 'storeAssign'])->name('requisition.storeAssign');
Route::get('requisition/pdf/template/{id}', [RequisitionController::class, 'templatePdf'])->name('requisition.pdfTemplate');
Route::get('upload/{id}', [RequisitionController::class, 'uploadFile'])->name('upload');
Route::post('requisition/{id}/files', [RequisitionController::class, 'storeFile'])->name('storefile');
Route::resource('requisition', RequisitionController::class);


Route::resource('/roles', RoleController::class);
Route::resource('/users', UserController::class);
Route::resource('/posts', PostController::class);

});



