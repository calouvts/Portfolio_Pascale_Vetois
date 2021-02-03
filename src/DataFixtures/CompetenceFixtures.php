<?php

namespace App\DataFixtures;

use App\Entity\Competence;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class CompetenceFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($i = 1; $i <= 5; $i++) {
            $competence = new Competence();
            $competence->setName($faker->text(150));
            $competence->setPhotocomp($faker->imageUrl(200, 200));
            $competence->setDescription($faker->text(200));

            $manager->persist($competence);

            $manager->flush();
        }
    }
}

