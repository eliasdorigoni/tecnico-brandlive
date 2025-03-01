<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Customer;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 25; $i++) {
            $customer = new Customer();
            $customer->setFirstName($faker->firstName());
            $customer->setLastName($faker->lastName());
            $customer->setEmail($faker->email());
            $customer->setObservations(
                $faker->optional(0.5, null) // 50% probabilidad de null
                    ->sentence(mt_rand(10, 20))
            );

            $shouldAddGroups = (bool) mt_rand(0, 1);
            if ($shouldAddGroups) {
                $groups = array_rand([0, 1, 2], mt_rand(1, 3));
                if (!is_array($groups)) {
                    $groups = [$groups];
                }
                $customer->setGroups($groups);
            }

            $manager->persist($customer);
        }

        $manager->flush();
    }
}
