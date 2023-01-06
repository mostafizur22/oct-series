<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    const PROGRAMS = [
        [ 'Planet Earth II', 'Life in a variety of habitats', 'https://cdn.pixabay.com/photo/2018/03/12/04/00/mammal-3218712_1280.jpg', 'Aventure' ], 
        ['Breaking Bad', 'A teacher selling meth', 'https://cdn.pixabay.com/photo/2022/11/04/15/21/money-7570157_1280.jpg', 'Action' ], 
        ['Band of Brothers', 'U.S. Army, mission in World War II Europe', 'https://p4.wallpaperbetter.com/wallpaper/362/506/513/nazi-ambush-tank-machine-gun-wallpaper-preview.jpg', 'Fantastique' ],
        ['Chernobyl', 'In April 1986, an explosion at the Chernobyl nuclear power plant', 'https://cdn.pixabay.com/photo/2021/01/01/21/31/halloween-5880068_1280.jpg', 'Horreur' ],
        ['Rick and Morty', 'The exploits of a super scientist and his not-so-bright grandson.', 'https://www.freepnglogos.com/uploads/rick-and-morty-png/rick-and-morty-wazzaldorp-deviantart-34.png', 'Animation' ] 
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
            $this->addReference('program_'.$title, $program);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
          CategoryFixtures::class,
        ];
    }


}