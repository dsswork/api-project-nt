<?php

use App\Http\Controllers\Web\DocsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DocsController::class, 'index']);
