<?php

namespace App\Tests\Controller;

use App\Entity\Book;
use App\Entity\Category;
use App\Tests\AbstractControllerTestCase;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;

class BookControllerTest extends AbstractControllerTestCase
{
    public function testBooksByCategory()
    {
        $categoryId = $this->createCategory();

        $this->client->request('GET', '/api/v1/category/' . $categoryId .'/books');
        $responseContent = json_decode($this->client->getResponse()->getContent(), true);

        $this->assertResponseIsSuccessful();
        $this->assertJsonDocumentMatchesSchema($responseContent, [
            'type' => 'object',
            'required' => ['items'],
            'properties' => [
                'items' => [
                    'type' => 'array',
                    'items' => [
                        'type' => 'object',
                        'required' => ['id', 'title', 'slug', 'image', 'authors', 'meap', 'publicationDate'],
                        'properties' => [
                            'title' => ['type' => 'string'],
                            'slug' => ['type' => 'string'],
                            'image' => ['type' => 'string'],
                            'id' => ['type' => 'integer'],
                            'publicationDate' => ['type' => 'integer'],
                            'meap' => ['type' => 'boolean'],
                            'authors' => [
                                'type' => 'array',
                                'items' => ['type' => 'string']
                            ]
                        ]
                    ]
                ]
            ]
        ]);
    }

    private function createCategory(): int
    {
        $category = (new Category())->setTitle('Devices')->setSlug('devices');

        $this->em->persist($category);
        $this->em->persist(
            (new Book())
            ->setTitle('Test Book')
            ->setSlug('test-book')
            ->setImage('http://localhost/test.png')
            ->setMeap(true)
            ->setPublicationDate(new DateTime())
            ->setAuthors(['A.Tester'])
            ->setCategories(new ArrayCollection([$category]))
        );

        $this->em->flush();

        return $category->getId();
    }
}
