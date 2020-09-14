<?php

namespace App\DataFixtures;

use App\Entity\Quack;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class QuackFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $Quack1 = new Quack();

        $Quack1->setContent("Quack Quack Quack");
        $Quack1->setCreatedAt();
        $manager->persist($Quack1);

        $Quack2 = new Quack();
        $Quack2->setContent("Quack Coin Quack Coin ?");
        $Quack2->setCreatedAt();
        $manager->persist($Quack2);

        $Quack3 = new Quack();
        $Quack3->setContent("Quack Quack Coin Quack");
        $Quack3->setCreatedAt();
        $manager->persist($Quack3);

        $Quack4 = new Quack();
        $Quack4->setContent("Ouaf ouaf ouaf");
        $Quack4->setCreatedAt();
        $manager->persist($Quack4);

        $Quack5 = new Quack();
        $Quack5->setContent("Bonjour je suis le chasseur.");
        $Quack5->setCreatedAt();
        $manager->persist($Quack5);

        $manager->flush();
    }
}
