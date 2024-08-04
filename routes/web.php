<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShipmentController;


Route::get('/shipments/{shipment}', [ShipmentController::class, 'show'])->name('shipments.show');
