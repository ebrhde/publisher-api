<?php

namespace App\Tests;

use App\Repository\BookRepository;
use App\Repository\CategoryRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\Mixed_;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class AbstractRepositoryTestCase extends KernelTestCase
{
    protected ?EntityManagerInterface $em;

    protected function setUp(): void
    {
        parent::setUp();

        $this->em = self::getContainer()->get('doctrine.orm.entity_manager');
    }

    protected function getRepositoryForEntity(string $entityClass): object
    {
        return $this->em->getRepository($entityClass);
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $this->em->close();
        $this->em = null;
    }
}
