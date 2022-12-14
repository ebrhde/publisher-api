<?php

namespace App\Controller;

use App\Service\BookService;
use Symfony\Component\HttpFoundation\Response;
use App\Exception\CategoryNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;
use App\Model\BookApiResponse;
use App\Model\ErrorResponse;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Model;

class BookController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{
    private BookService $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    /**
     * @OA\Response(
     *     response=200,
     *     description="Returns books by category",
     *     @Model(type=BookApiResponse::class)
     * )
     * @OA\Response(
     *     response=404,
     *     description="Category was not found",
     *     @Model(type=ErrorResponse::class)
     * )
     * @Route("/api/v1/category/{id}/books", name="app_books", methods="GET")
     */
    public function booksByCategory(int $id): Response
    {
        return $this->json($this->bookService->getBooksByCategory($id));
    }
}
