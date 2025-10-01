<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;

class DetectarFraude extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function it_simulates_a_fraudulent_transaction()
    {
        // Simula resposta fraudulenta da API de pagamento
        Http::fake([
            'https://api.pagamentos.falsa/process' => Http::response([
                'status' => 'failed',
                'reason' => 'fraud_detected'
            ], 200),
        ]);

    
    $paymentRepository = new \App\Repositories\Eloquent\EloquentPaymentRepository();
    $service = new \App\Services\PaymentService($paymentRepository);
        $response = $service->process([
            'amount' => 100,
            'card_number' => '4111111111111111',
            'cvv' => '123',
            'expiry' => '12/25',
        ]);

    $this->assertEquals('failed', $response['status']);
    $this->assertEquals('fraud_detected', $response['reason']);
    }
}
