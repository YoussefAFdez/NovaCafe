<?php

namespace App\Factory;

use App\Entity\Cliente;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Cliente>
 *
 * @method static Cliente|Proxy createOne(array $attributes = [])
 * @method static Cliente[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Cliente|Proxy find(object|array|mixed $criteria)
 * @method static Cliente|Proxy findOrCreate(array $attributes)
 * @method static Cliente|Proxy first(string $sortedField = 'id')
 * @method static Cliente|Proxy last(string $sortedField = 'id')
 * @method static Cliente|Proxy random(array $attributes = [])
 * @method static Cliente|Proxy randomOrCreate(array $attributes = [])
 * @method static Cliente[]|Proxy[] all()
 * @method static Cliente[]|Proxy[] findBy(array $attributes)
 * @method static Cliente[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Cliente[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method Cliente|Proxy create(array|callable $attributes = [])
 */
final class ClienteFactory extends ModelFactory
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
            'nombre' => self::faker()->text(),
            'apellido' => self::faker()->text(),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Cliente $cliente): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Cliente::class;
    }
}
