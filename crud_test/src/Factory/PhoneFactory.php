<?php

namespace App\Factory;

use App\Entity\Phone;
use App\Repository\PhoneRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Phone>
 *
 * @method        Phone|Proxy create(array|callable $attributes = [])
 * @method static Phone|Proxy createOne(array $attributes = [])
 * @method static Phone|Proxy find(object|array|mixed $criteria)
 * @method static Phone|Proxy findOrCreate(array $attributes)
 * @method static Phone|Proxy first(string $sortedField = 'id')
 * @method static Phone|Proxy last(string $sortedField = 'id')
 * @method static Phone|Proxy random(array $attributes = [])
 * @method static Phone|Proxy randomOrCreate(array $attributes = [])
 * @method static PhoneRepository|RepositoryProxy repository()
 * @method static Phone[]|Proxy[] all()
 * @method static Phone[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Phone[]|Proxy[] createSequence(array|callable $sequence)
 * @method static Phone[]|Proxy[] findBy(array $attributes)
 * @method static Phone[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Phone[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class PhoneFactory extends ModelFactory
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
            'Model' => self::faker()->text(255),
            'memory' => self::faker()->randomNumber(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Phone $phone): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Phone::class;
    }
}
