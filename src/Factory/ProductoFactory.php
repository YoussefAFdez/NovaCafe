<?php

namespace App\Factory;

use App\Entity\Producto;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Producto>
 *
 * @method static Producto|Proxy createOne(array $attributes = [])
 * @method static Producto[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Producto|Proxy find(object|array|mixed $criteria)
 * @method static Producto|Proxy findOrCreate(array $attributes)
 * @method static Producto|Proxy first(string $sortedField = 'id')
 * @method static Producto|Proxy last(string $sortedField = 'id')
 * @method static Producto|Proxy random(array $attributes = [])
 * @method static Producto|Proxy randomOrCreate(array $attributes = [])
 * @method static Producto[]|Proxy[] all()
 * @method static Producto[]|Proxy[] findBy(array $attributes)
 * @method static Producto[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Producto[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method Producto|Proxy create(array|callable $attributes = [])
 */
final class ProductoFactory extends ModelFactory
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
            'codigo' => self::faker()->unique()->numerify('CO#####'),
            'nombre' => self::faker()->boolean() ? self::faker()->sentence(1) : self::faker()->boolean(60) ? self::faker()->sentence(2) : self::faker()->sentence(3),
            'descripcion' => self::faker()->text(),
            'precio' => self::faker()->randomFloat(2, 1, 10),
            'stock' => self::faker()->numberBetween(0, 50),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Producto $producto): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Producto::class;
    }
}
