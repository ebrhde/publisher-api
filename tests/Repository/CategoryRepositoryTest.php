<?php

namespace App\Tests\Repository;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Tests\AbstractRepositoryTestCase;

class CategoryRepositoryTest extends AbstractRepositoryTestCase
{
    private CategoryRepository $categoryRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->categoryRepository = $this->getRepositoryForEntity(Category::class);
    }

    public function testFindAllSortedByTitle()
    {
        $devicesCategory = (new Category())->setTitle('Devices')->setSlug('devices');
        $androidCategory = (new Category())->setTitle('Android')->setSlug('android');
        $computerCategory = (new Category())->setTitle('Computer')->setSlug('computer');

        foreach ([$devicesCategory, $androidCategory, $computerCategory] as $category) {
            $this->em->persist($category);
        }

        $this->em->flush();

        $titles = array_map(
            function (Category $bookCategory) {
                return $bookCategory->getTitle();
            },
            $this->categoryRepository->findAllSortedByTitle()
        );

        $this->assertEquals(['Android', 'Computer', 'Devices'], $titles);
    }
}
