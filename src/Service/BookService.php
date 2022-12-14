<?php

namespace App\Service;

use App\Entity\Book;
use App\Exception\CategoryNotFoundException;
use App\Model\BookApiResponse;
use App\Model\BookApiResponseItem;
use App\Repository\BookRepository;
use App\Repository\CategoryRepository;

class BookService
{
    private BookRepository $bookRepository;
    private CategoryRepository $categoryRepository;

    public function __construct(BookRepository $bookRepository, CategoryRepository $categoryRepository)
    {
        $this->bookRepository = $bookRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function getBooksByCategory($categoryId): BookApiResponse
    {
        if (!$this->categoryRepository->existsById($categoryId)) {
            throw new CategoryNotFoundException();
        }

        return new BookApiResponse(array_map(
            [$this, 'map'],
            $this->bookRepository->findBooksByCategoryId($categoryId)
        ));
    }

    private function map(Book $book): BookApiResponseItem
    {
        return (new BookApiResponseItem())
            ->setId($book->getId())
            ->setTitle($book->getTitle())
            ->setSlug($book->getSlug())
            ->setImage($book->getImage())
            ->setAuthors($book->getAuthors())
            ->setMeap($book->isMeap())
            ->setPublicationDate($book->getPublicationDate()->getTimestamp());
    }
}
