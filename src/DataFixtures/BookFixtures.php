<?php

namespace App\DataFixtures;

use App\Entity\Book;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use DateTime;

class BookFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $androidCategory = $this->getReference(CategoriesFixtures::ANDROID_CATEGORY);
        $devicesCategory = $this->getReference(CategoriesFixtures::DEVICES_CATEGORY);

        $book = (new Book())
            ->setTitle('RxJava for Android developers')
            ->setPublicationDate(new DateTime('2019-04-01'))
            ->setMeap(false)
            ->setAuthors(['Timo Tuominen'])
            ->setSlug('rx-java-for-android-developers')
            ->setCategories(new ArrayCollection([$androidCategory, $devicesCategory]))
            ->setImage('https://images.manning.com/264/352/resize/book/b/bc57fb7-b239-4bf5-bbf2-886be8936951/Tuominen-RxJava-HI.png');

        $manager->persist($book);
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CategoriesFixtures::class
        ];
    }
}
