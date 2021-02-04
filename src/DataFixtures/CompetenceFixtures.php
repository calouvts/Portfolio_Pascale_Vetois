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
        for ($i = 1; $i <= 10; $i++) {
            $competence = new Competence();
            $competence->setName($faker->text(10));
            $image = 'https://loremflickr.com/g/350/250/logo';
            $photocomp = uniqid() . '.jpg';
            copy($image, __DIR__ . '/../../public/uploads/' . $photocomp);
            $competence->setPhotocomp($photocomp);
            $competence->setDescription($faker->text(200));

            $manager->persist($competence);

        }
            $manager->flush();
        }

}

