<?php

namespace App\Factory;

use App\Entity\Venta;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Venta>
 *
 * @method static Venta|Proxy createOne(array $attributes = [])
 * @method static Venta[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Venta|Proxy find(object|array|mixed $criteria)
 * @method static Venta|Proxy findOrCreate(array $attributes)
 * @method static Venta|Proxy first(string $sortedField = 'id')
 * @method static Venta|Proxy last(string $sortedField = 'id')
 * @method static Venta|Proxy random(array $attributes = [])
 * @method static Venta|Proxy randomOrCreate(array $attributes = [])
 * @method static Venta[]|Proxy[] all()
 * @method static Venta[]|Proxy[] findBy(array $attributes)
 * @method static Venta[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Venta[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method Venta|Proxy create(array|callable $attributes = [])
 */
final class VentaFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [
            // TODO add your default values here (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories)
            'codigo' => self::faker()->unique()->numerify('VE#####'),
            'fechaVenta' => self::faker()->dateTimeBetween('-1 year'),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Venta $venta): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Venta::class;
    }
}
