<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


use Faker\Factory;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for($i=1; $i<=SeasonFixtures::$seasonIndex; $i++){

            for($j=1; $j<=10; $j++){
                $episode = new Episode();
                $episode->setTitle($faker->sentence(4))
                        ->setNumber($j)
                        ->setSynopsis($faker->paragraph())
                        ->setSeason($this->getReference('season_'.$i));
                $manager->persist($episode);
                
            }

        }

        $manager->flush();
    }


    public function getDependencies(){

        return [
            SeasonFixtures::class,
        ];
    }

}
