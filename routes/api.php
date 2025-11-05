<?php

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Route;

Route::post('/getLoginCarouselHtml', [ApiController::class, 'getLoginCarouselHtml'])->name('api.getLoginCarouselHtml');

