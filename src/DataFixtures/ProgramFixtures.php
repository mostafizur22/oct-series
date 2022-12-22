<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    const PROGRAMS = [
        [ 'Planet Earth II', 'Life in a variety of habitats', 'https://i.ibb.co/Kbgf2t4/Adobe-Stock-430355929.jpg', 'Aventure' ], 
        ['Breaking Bad', 'A teacher selling meth', 'https://i.ibb.co/0rn0hFL/Adobe-Stock-463917493.jpg', 'Action' ], 
        ['Band of Brothers', 'U.S. Army, mission in World War II Europe', 'https://i.ibb.co/92JLmMX/Adobe-Stock-463917635.jpg', 'Fantastique' ],
        ['Chernobyl', 'In April 1986, an explosion at the Chernobyl nuclear power plant', 'https://i.ibb.co/cLzDK8g/Adobe-Stock-369709001.jpg', 'Horreur' ],
        ['Rick and Morty', 'The exploits of a super scientist and his not-so-bright grandson.', 'https://i.ibb.co/6B06b8x/Adobe-Stock-368638765.jpg', 'Animation' ] 
    ];
    public function load(ObjectManager $manager)
    {
        foreach(self::PROGRAMS as  $key => [$title, $synopsis, $poster, $category] ){
            $program = new Program;
            $program->setTitle($title);
            $program->setSynopsis($synopsis);
            $program->setPoster($poster);
            $program->setCategory($this->getReference("category_$category"));
            $manager->persist($program);
        }
        $manager->flush();

        // $program = new Program();
        // $program->setTitle('Walking dead');
        // $program->setSynopsis('Des zombies envahissent la terre');
        // $program->setCategory($this->getReference('category_Action'));
        // $manager->persist($program);
        // $manager->flush();
    }

    public function getDependencies()
    {
        return [
          CategoryFixtures::class,
        ];
    }


}