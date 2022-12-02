<?php

namespace App\Controller;

use App\Service\CategoryService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{
    private CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * @Route("/api/v1/book/categories", name="app_categories")
     */
    public function categories(): Response {
        return $this->json($this->categoryService->getCategories());
    }
}
