<?php

namespace App\Factory;

use App\Entity\Make;
use App\Repository\MakeRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Make>
 *
 * @method        Make|Proxy create(array|callable $attributes = [])
 * @method static Make|Proxy createOne(array $attributes = [])
 * @method static Make|Proxy find(object|array|mixed $criteria)
 * @method static Make|Proxy findOrCreate(array $attributes)
 * @method static Make|Proxy first(string $sortedField = 'id')
 * @method static Make|Proxy last(string $sortedField = 'id')
 * @method static Make|Proxy random(array $attributes = [])
 * @method static Make|Proxy randomOrCreate(array $attributes = [])
 * @method static MakeRepository|RepositoryProxy repository()
 * @method static Make[]|Proxy[] all()
 * @method static Make[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Make[]|Proxy[] createSequence(array|callable $sequence)
 * @method static Make[]|Proxy[] findBy(array $attributes)
 * @method static Make[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Make[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class MakeFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'name' => self::faker()->text(255),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Make $make): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Make::class;
    }
}
