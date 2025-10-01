<?php
namespace App\Services;
use App\Repositories\Contracts\PaymentRepositoryInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
class PaymentService
{
protected $paymentRepository;

/**
* Processa a transação completa, incluindo a lógica de negócio.
*/
public function processTransaction(array $data): array
{
// 1. Lógica de negócio: chamada à API externa
$apiResponse = Http::post('https://api.pagamentos.falsa/process', [
	'amount' => $data['amount'],
	'card' => $data['card_number'],
]);
$status = $apiResponse['status'] ?? ($apiResponse->successful() ? 'aprovado' : 'recusado');
// 2. Prepara os dados para o repositório
$paymentData = [
'amount' => $data['amount'],
'card_number' => Str::substr($data['card_number'], -4),
'status' => $status,
];
// 3. Persistência de dados: delega ao repositório
$payment = $this->paymentRepository->create($paymentData);
return [
	'message' => 'Transação processada com sucesso.',
	'status' => $status,
	'reason' => $apiResponse['reason'] ?? null,
	'payment_id' => $payment->id
];
}
	/**
	 * Compatibilidade: método process chamado nos testes
	 */
	public function process(array $data): array
	{
		return $this->processTransaction($data);
	}
// O serviço recebe o repositório via Injeção de Dependência.
// Ele não sabe como o repositório é implementado, apenas que ele
// atende ao contrato (a interface).
public function __construct(PaymentRepositoryInterface $paymentRepository)
{
$this->paymentRepository = $paymentRepository;
}

}