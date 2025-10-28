<?php

use App\Discount\Strategies\SeasonalDiscount;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;
use App\Discount\Strategies\FixedDiscount;
use App\Discount\Strategies\PercentageDiscount;
use App\Discount\Strategies\VipDiscount;

Route::get('/', function () {
    return view('welcome');
});
Route::post('/calculate-discount', [OrderController::class, 'calculate']);

Route::get('/calculate-discount/{total}/{type}', [OrderController::class, 'calculate']);


Route::get('/desconto', function (Request $request) {
    $valor = (float) $request->query('valor', 0);
    $tipo = $request->query('tipo', 'fixed');

    $strategy = match ($tipo) {
        'fixed' => new FixedDiscount(),
        'percentage' => new PercentageDiscount(),
        'seasonal' => new SeasonalDiscount(),
        'vip' => new VipDiscount(),
        default => new FixedDiscount(),
    };

    $valorComDesconto = $strategy->calculate($valor);

    return response()->json([
        'tipo_desconto' => $tipo,
        'valor_original' => $valor,
        'valor_com_desconto' => $valorComDesconto,
        'desconto_aplicado' => $valor - $valorComDesconto,
    ]);
});
//desconto?valor=250&tipo=seasonal
