<?php

namespace App\DataFixtures;

use App\Factory\CategoriaFactory;
use App\Factory\ClienteFactory;
use App\Factory\EmpleadoFactory;
use App\Factory\ProductoFactory;
use App\Factory\VentaFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $gerente = EmpleadoFactory::new()->create([
           'gerente' => true
        ]);

        $administrador = EmpleadoFactory::new()->create([
            'administrador' => true
        ]);

        EmpleadoFactory::createMany(2);

        ClienteFactory::createMany(50);

        CategoriaFactory::createMany(10, function() use ($gerente, $administrador) {
           return [
               'creadaPor' => CategoriaFactory::faker()->boolean(75) ? $gerente : $administrador
           ];
        });

        ProductoFactory::createMany(50, function() {
           return [
               'categoria' => CategoriaFactory::random()
           ];
        });

        VentaFactory::createMany(100, function() {
            return [
                'cliente' => ClienteFactory::random(),
                'productos' => ProductoFactory::randomRange(1, 10),
                'empleado' => ClienteFactory::random()
            ];
        });

        $manager->flush();
    }
}
