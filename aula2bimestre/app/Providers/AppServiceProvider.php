<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\PaymentRepositoryInterface;
use App\Repositories\Eloquent\EloquentPaymentRepository;
class AppServiceProvider extends ServiceProvider
{
/**
* Registra qualquer serviço da aplicação.
*
* @return void
*/
public function register()
{
// Registrando a dependência.
// Sempre que uma classe pedir a 'PaymentRepositoryInterface',
// o Laravel vai fornecer uma instância de 'EloquentPaymentRepository'.
$this->app->bind(
PaymentRepositoryInterface::class,
EloquentPaymentRepository::class
);
}
/**
* Inicia qualquer serviço da aplicação.
*
* @return void
*/
public function boot()
{
//
}
}