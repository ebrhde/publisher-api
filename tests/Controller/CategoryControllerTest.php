<?php

namespace App\Tests\Controller;

use App\Entity\Category;
use App\Tests\AbstractControllerTestCase;

class CategoryControllerTest extends AbstractControllerTestCase
{
    public function testCategories(): void
    {
        $this->em->persist((new Category())->setTitle('Devices')->setSlug('devices'));
        $this->em->flush();

        $this->client->request('GET', '/api/v1/book/categories');
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
                        'required' => ['id', 'title', 'slug'],
                        'properties' => [
                            'title' => ['type' => 'string'],
                            'slug' => ['type' => 'string'],
                            'id' => ['type' => 'integer'],
                        ]
                    ]
                ]
            ]
        ]);
    }
}
