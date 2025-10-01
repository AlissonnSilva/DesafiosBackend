<?php
namespace App\Http\Controllers;
use App\Services\PaymentService;
use Illuminate\Http\Request;
class PaymentController extends Controller
{
protected $paymentService;
// O Controller agora injeta o Service.
// A única responsabilidade dele é a validação e a delegação.
public function __construct(PaymentService $paymentService)
{
$this->paymentService = $paymentService;
}
/**
* Processa um pagamento.
*/
public function process(Request $request)
{
// 1. Validação dos dados
$request->validate([
'amount' => 'required|numeric|min:0.01',
'card_number' => 'required|string',
'card_holder' => 'required|string',
]);
// 2. Delega a lógica de negócio completa para o Service
$result = $this->paymentService->processTransaction($request->all());
// 3. Retorno da resposta
return response()->json($result, 200);
}
}