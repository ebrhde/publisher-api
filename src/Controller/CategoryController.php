<?php

namespace App\Controller;

use App\Service\CategoryService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Model\CategoryApiResponse;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Model;

class CategoryController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{
    private CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * @OA\Response(
     *     response=200,
     *     description="Returns book categories",
     *     @Model(type=CategoryApiResponse::class)
     * )
     * @Route("/api/v1/book/categories", name="app_categories", methods="GET")
     */
    public function categories(): Response
    {
        return $this->json($this->categoryService->getCategories());
    }
}
