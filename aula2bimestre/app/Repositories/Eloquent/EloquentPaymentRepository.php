<?php
namespace App\Repositories\Eloquent;
use App\Models\Payment;
use App\Repositories\Contracts\PaymentRepositoryInterface;
// Esta é a implementação do repositório.
// Ela usa o Eloquent para realizar as operações de persistência definidas no contrato.
class EloquentPaymentRepository implements PaymentRepositoryInterface
{
/**
* Cria um novo registro de pagamento no banco de dados.
*/
public function create(array $data): Payment
{
return Payment::create($data);
}
/**
* Encontra um pagamento pelo ID.
*/
public function findById(int $id): ?Payment
{
return Payment::find($id);
}
}