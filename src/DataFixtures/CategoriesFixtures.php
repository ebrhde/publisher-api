<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoriesFixtures extends Fixture
{
    public const ANDROID_CATEGORY = 'android';
    public const DEVICES_CATEGORY = 'devices';

    public function load(ObjectManager $manager): void
    {
        $categories = [
            self::ANDROID_CATEGORY => (new Category())->setTitle('Android')->setSlug('android'),
            self::DEVICES_CATEGORY => (new Category())->setTitle('Devices')->setSlug('devices')
        ];

        foreach ($categories as $category) {
            $manager->persist($category);
        }

        $manager->persist((new Category())->setTitle('Networking')->setSlug('networking'));

        $manager->flush();

        foreach ($categories as $key => $category) {
            $this->addReference($key, $category);
        }
    }
}
