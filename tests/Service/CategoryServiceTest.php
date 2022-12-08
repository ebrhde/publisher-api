<?php

namespace App\Tests\Service;

use App\Entity\Category;
use App\Model\CategoryApiResponse;
use App\Model\CategoryApiResponseItem;
use App\Repository\CategoryRepository;
use App\Service\CategoryService;
use App\Tests\AbstractTestCase;
use Doctrine\Common\Collections\Criteria;

class CategoryServiceTest extends AbstractTestCase
{

    public function testGetCategories(): void
    {
        $category = (new Category())->setTitle('Test')->setSlug('test');
        $this->setEntityId($category, 11);

        $repository = $this->createMock(CategoryRepository::class);
        $repository->expects($this->once())
            ->method('findAllSortedByTitle')
            ->willReturn([$category]);

        $service = new CategoryService($repository);
        $expected = new CategoryApiResponse([new CategoryApiResponseItem(11, 'Test', 'test')]);

        $this->assertEquals($expected, $service->getCategories());
    }
}
