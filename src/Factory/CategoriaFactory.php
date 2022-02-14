<?php

namespace App\Factory;

use App\Entity\Categoria;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Categoria>
 *
 * @method static Categoria|Proxy createOne(array $attributes = [])
 * @method static Categoria[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Categoria|Proxy find(object|array|mixed $criteria)
 * @method static Categoria|Proxy findOrCreate(array $attributes)
 * @method static Categoria|Proxy first(string $sortedField = 'id')
 * @method static Categoria|Proxy last(string $sortedField = 'id')
 * @method static Categoria|Proxy random(array $attributes = [])
 * @method static Categoria|Proxy randomOrCreate(array $attributes = [])
 * @method static Categoria[]|Proxy[] all()
 * @method static Categoria[]|Proxy[] findBy(array $attributes)
 * @method static Categoria[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Categoria[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method Categoria|Proxy create(array|callable $attributes = [])
 */
final class CategoriaFactory extends ModelFactory
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
            'codigo' => self::faker()->text(),
            'nombre' => self::faker()->text(),
            'descripcion' => self::faker()->text(),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Categoria $categoria): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Categoria::class;
    }
}
