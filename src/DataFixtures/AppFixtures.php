<?php

namespace App\DataFixtures;

use App\Entity\Stats;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $product = new Stats();
        $product->setPartiesGagnees(0);
        $product->setPartiesPerdues(0);
        $product->setPartiesJouees(0);
        $manager->persist($product);

        $manager->flush();
    }
}
