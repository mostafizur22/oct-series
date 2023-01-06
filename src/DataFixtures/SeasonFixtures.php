<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

use Faker\Factory;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{

    public static $seasonIndex = 0;
    public function load(ObjectManager $manager,): void
    {

        $faker = Factory::Create();

        foreach (ProgramFixtures::PROGRAMS as $key=>[$programName])
        {
            for ($i = 1; $i <= 5; $i++){
                $season = new Season();
                $season->setNumber($i)
                        ->setYear($faker->year())
                        ->setDescription($faker->paragraphs(3, true))
                        ->setProgram($this->getReference('program_'.$programName));
                $manager->persist($season);
                self::$seasonIndex++;
                $this->addReference('season_'.self::$seasonIndex, $season);
            }

        }
        
        $manager->flush();

    }


    public function getDependencies(): array
    {
        return [
            ProgramFixtures::class,
        ];
    }

}