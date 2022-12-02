<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoriesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $manager->persist((new Category())->setTitle('Java')->setSlug('java'));
        $manager->persist((new Category())->setTitle('Networking')->setSlug('networking'));
        $manager->persist((new Category())->setTitle('Android')->setSlug('android'));

        $manager->flush();
    }
}
