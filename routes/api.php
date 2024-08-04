<?php

use App\Http\Controllers\LicenseOfferController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    Route::get('/license-offers/{licenseGroup}', LicenseOfferController::class);
});
