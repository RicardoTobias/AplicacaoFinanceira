<?php

declare(strict_types = 1);

namespace SONFin\Plugins;

use SONFin\ServiceContainerInterface;
use Illuminate\Database\Capsule\Manager as Capsule;
use Interop\Container\ContainerInterface;
use SONFin\Repository\RepositoryFactory;
use SONFin\Models\User;
use SONFin\Models\BillReceive;
use SONFin\Models\BillPay;
use SONFin\Repository\StatementRepository;
use SONFin\Repository\CategoryCostRepository;

class DbPlugin implements PluginInterface
{

    public function register(ServiceContainerInterface $container) 
    {

        $capsule = new Capsule();

        $config = include __DIR__ . '/../../config/db.php';

        $capsule->addConnection($config['default_connection']);
        $capsule->bootEloquent();

        $container->add('repository.factory', new RepositoryFactory());

        $container->addLazy(
            'category-cost.repository', function () {
                return new CategoryCostRepository();
            }
        );

        $container->addLazy(
            'user.repository', function (ContainerInterface $container) {
                return $container->get('repository.factory')->factory(User::class);
            }
        );

        // Registrando serviço no modo Lazy
        $container->addLazy(
            'bill-receive.repository', function (ContainerInterface $container) {
                return $container->get('repository.factory')->factory(BillReceive::class);
            }
        );

        $container->addLazy(
            'bill-pay.repository', function (ContainerInterface $container) {
                return $container->get('repository.factory')->factory(BillPay::class);
            }
        );

        $container->addLazy(
            'statement.repository', function () {
                return new StatementRepository();
            }
        );
    }

}
