<?php

namespace App\Tests\Service;

use App\Entity\Category;
use App\Model\CategoryApiResponse;
use App\Model\CategoryApiResponseItem;
use App\Repository\CategoryRepository;
use App\Service\CategoryService;
use Doctrine\Common\Collections\Criteria;
use PHPUnit\Framework\TestCase;

class CategoryServiceTest extends TestCase
{

    public function testGetCategories(): void
    {
        $repository = $this->createMock(CategoryRepository::class);
        $repository->expects($this->once())
            ->method('findBy')
            ->with([], ['title' => Criteria::ASC])
            ->willReturn([(new Category())->setId(11)->setTitle('Test')->setSlug('test')]);

        $service = new CategoryService($repository);
        $expected = new CategoryApiResponse([new CategoryApiResponseItem(11, 'Test', 'test')]);

        $this->assertEquals($expected, $service->getCategories());
    }
}
