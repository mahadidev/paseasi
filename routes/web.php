<?php

use App\Http\Controllers\NeedHelpController;
use Illuminate\Support\Facades\Route;

Route::get("/", [NeedHelpController::class, "index"]);
Route::resource("/need-help", NeedHelpController::class);
