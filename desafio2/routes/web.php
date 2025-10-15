<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ReportController;


Route::get('/', function () {
    return view('welcome');
});

// Exemplo de rota: GET /api/reports/pdf ou GET /api/reports/csv
Route::get('/reports/{type}', [ReportController::class, 'download']);
