<?php

namespace App\Service;

use App\Entity\Subscriber;
use App\Exception\SubscriberAlreadyExistsException;
use App\Model\SubscriptionRequest;
use App\Repository\SubscriberRepository;
use Doctrine\ORM\EntityManagerInterface;

class SubscriberService
{
    private SubscriberRepository $repository;
    private EntityManagerInterface $entityManager;

    public function __construct(SubscriberRepository $repository, EntityManagerInterface $entityManager)
    {
        $this->repository = $repository;
        $this->entityManager = $entityManager;
    }

    public function subscribe(SubscriptionRequest $request): void
    {
        if ($this->repository->existsByEmail($request->getEmail())) {
            throw new SubscriberAlreadyExistsException();
        }

        $subscriber = new Subscriber();
        $subscriber->setEmail($request->getEmail());

        $this->entityManager->persist($subscriber);
        $this->entityManager->flush();
    }
}
