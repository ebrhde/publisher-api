<?php

namespace App\Service;

use App\Entity\Category;
use App\Model\CategoryApiResponse;
use App\Model\CategoryApiResponseItem;
use App\Repository\CategoryRepository;

class CategoryService
{
    private CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getCategories(): CategoryApiResponse
    {
        $categories = $this->categoryRepository->findAllSortedByTitle();
        $items = array_map(
            function (Category $category) {
                return new CategoryApiResponseItem(
                    $category->getId(),
                    $category->getTitle(),
                    $category->getSlug()
                );
            },
            $categories
        );

        return new CategoryApiResponse($items);
    }
}
