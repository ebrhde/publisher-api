<?php

namespace App\Controller;

use App\Service\BookService;
use Symfony\Component\HttpFoundation\Response;
use App\Exception\CategoryNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;
use App\Model\BookApiResponse;
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
     * @Route("/api/v1/category/{id}/books", name="app_books", methods="GET")
     */
    public function booksByCategory(int $id): Response
    {
        try {
            return $this->json($this->bookService->getBooksByCategory($id));
        } catch (CategoryNotFoundException $exception) {
            throw new HttpException($exception->getCode(), $exception->getMessage());
        }
    }
}
