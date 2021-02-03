<?php

namespace App\DataFixtures;

use App\Entity\Experience;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class Experiencefixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        {
            $faker = Faker\Factory::create('fr_FR');
            for ($i = 1; $i <= 5; $i++) {
                $experience = new Experience();
                $experience->setYear($faker->text(40));
                $experience->setName($faker->text(150));
                $experience->setCompany($faker->text(50));
                $experience->setDescription($faker->text(200));

                $manager->persist($experience);

                $manager->flush();
            }
        }
        $manager->flush();
    }
}
