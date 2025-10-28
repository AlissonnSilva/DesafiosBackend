<?php

// app/Http/Controllers/OrderController.php

namespace App\Http\Controllers;

use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected OrderService $orderService;

    // Injeta o Service
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function calculate(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'type' => 'required|in:fixed,percentage,vip',
        ]);

        // O Controller delega a lógica ao Service
        $result = $this->orderService->processOrder(
            $request->input('amount'),
            $request->input('type')
        );

        return response()->json($result);
    }
}
