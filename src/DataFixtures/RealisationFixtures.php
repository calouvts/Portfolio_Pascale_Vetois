<?php

namespace App\DataFixtures;

use App\Entity\Realisation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class RealisationFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        {
            $faker = Faker\Factory::create('fr_FR');
            for ($i = 1; $i <= 5; $i++) {
                $realisation = new Realisation();
                $realisation->setName($faker->text(40));
                $realisation->setDescription($faker->text(150));
                $realisation->setRealisationphoto($faker->imageUrl(200, 200));
                $realisation->setProjectlink($faker->text(200));

                $manager->persist($realisation);

                $manager->flush();
            }
        }
    }
}
