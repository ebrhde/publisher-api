<?php

namespace App\Tests\Service;

use App\Entity\Book;
use App\Entity\Category;
use App\Exception\CategoryNotFoundException;
use App\Model\BookApiResponse;
use App\Model\BookApiResponseItem;
use App\Repository\BookRepository;
use App\Repository\CategoryRepository;
use App\Service\BookService;
use App\Tests\AbstractTestCase;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;

class BookServiceTest extends AbstractTestCase
{
    public function testGetBooksByCategoryNotFound(): void
    {
        $bookRepository = $this->createMock(BookRepository::class);
        $categoryRepository = $this->createMock(CategoryRepository::class);
        $categoryRepository->expects($this->once())
            ->method('find')
            ->with(189)
            ->willThrowException(new CategoryNotFoundException());

        $this->expectException(CategoryNotFoundException::class);

        (new BookService($bookRepository, $categoryRepository))->getBooksByCategory(189);
    }

    public function testGetBooksByCategory(): void
    {
        $bookRepository = $this->createMock(BookRepository::class);
        $bookRepository->expects($this->once())
            ->method('findBooksByCategoryId')
            ->with(189)
            ->willReturn([$this->createBookEntity()]);

        $categoryRepository = $this->createMock(CategoryRepository::class);
        $categoryRepository->expects($this->once())
            ->method('find')
            ->with(189)
            ->willReturn(new Category());

        $service = new BookService($bookRepository, $categoryRepository);
        $expected = new BookApiResponse([$this->createBookItemModel()]);

        $this->assertEquals($expected, $service->getBooksByCategory(189));
    }

    private function createBookEntity(): Book
    {
        $book = (new Book())
            ->setTitle('Test Book')
            ->setSlug('test-book')
            ->setMeap(false)
            ->setAuthors(['A. Tester'])
            ->setImage('http://localhost/test.png')
            ->setCategories(new ArrayCollection())
            ->setPublicationDate(new DateTime('2020-10-10'));

        $this->setEntityId($book, 123);
        return $book;

    }

    private function createBookItemModel(): BookApiResponseItem
    {
        return (new BookApiResponseItem())
            ->setId(123)
            ->setTitle('Test Book')
            ->setSlug('test-book')
            ->setMeap(false)
            ->setAuthors(['A. Tester'])
            ->setImage('http://localhost/test.png')
            ->setPublicationDate(1602288000);
    }
}
