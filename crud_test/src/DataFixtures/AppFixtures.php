<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Factory\UserFactory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        UserFactory::createOne([
            'username' => 'monday',
            'password' => 'monday',
            'role' => 'ROLE_ADMIN'
        ]);

        UserFactory::createOne([
            'username' => 'john',
            'password' => 'doe',
            'role' => 'ROLE_ADMIN'
        ]);

        UserFactory::createOne([
            'username' => 'sam',
            'password' => 'sale',
            'role' => 'ROLE_SALES'
        ]);

        UserFactory::createOne([
            'username' => 'customer',
            'password' => 'customer',
            'role' => 'ROLE_CUSTOMER'
        ]);
    }
}
