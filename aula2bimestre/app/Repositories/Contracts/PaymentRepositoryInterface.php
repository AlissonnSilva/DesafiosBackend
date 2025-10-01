<?php
namespace App\Repositories\Contracts;
use App\Models\Payment;
// Esta é a interface (o contrato).
// Ela define quais métodos o repositório deve ter, mas não como eles são implementados.
interface PaymentRepositoryInterface
{
public function create(array $data): Payment;
public function findById(int $id): ?Payment;

}