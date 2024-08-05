<?php

use App\Http\Controllers\LicenseOfferController;
use App\Http\Controllers\TokenController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('/license-offers/{licenseGroup}', LicenseOfferController::class);
    Route::post('/token', TokenController::class);
});
