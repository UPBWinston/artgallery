<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Factory\UserFactory;
use App\Factory\PhoneFactory;
use App\Factory\MakeFactory;
use App\Entity\Hobby;
use App\Entity\Intensity;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $intensity1 = new Intensity();
        $intensity1->setName('low');

        $intensity2 = new Intensity();
        $intensity2->setName('moderate');

        $intensity3 = new Intensity();
        $intensity3->setName('high');

        $hobby1 = new Hobby();
        $hobby1->setName('yoga');
        $hobby1->setIsIndoors(true);
        $hobby1->setWeeklyCost(15);
        $hobby1->setIntensity($intensity1);


        $hobby2 = new Hobby();
        $hobby2->setName('running');
        $hobby2->setIsIndoors(false);
        $hobby2->setWeeklyCost(0);
        $hobby2->setIntensity($intensity3);


        $manager->persist($intensity1);
        $manager->persist($intensity2);
        $manager->persist($intensity3);
        $manager->persist($hobby1);
        $manager->persist($hobby2);


        $manager->flush();

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


        MakeFactory::createOne(['name' => 'Apple']);
        MakeFactory::createOne(['name' => 'Samsung']);
        MakeFactory::createOne(['name' => 'Sony']);

        PhoneFactory::createOne([
            'model' => 'iPhone X',
            'memory' => '128',
            'manufacturer' => MakeFactory::find(['name' => 'Apple']),
        ]);

        PhoneFactory::createOne([
            'model' => 'Galaxy 21',
            'memory' => '256',
            'manufacturer' => MakeFactory::find(['name' => 'Samsung']),
        ]);
    }
}
