<?php

namespace App\Controller;

use App\ArgumentResolver\RequestBodyArgumentResolver;
use App\Model\SubscriptionRequest;
use App\Service\SubscriberService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Annotation\RequestBody;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Model;

class SubscribeController extends AbstractController
{
    private SubscriberService $subscriberService;

    public function __construct(SubscriberService $subscriberService)
    {
        $this->subscriberService = $subscriberService;
    }

    /**
     * @OA\Response(
     *     response=200,
     *     description="Subscribe email to a newsletter mailing list",
     *     @Model(type=SubscriptionRequest::class)
     * )
     * @Route("/api/v1/subscribe", name="subscribe", methods="POST")
     */
    public function action(SubscriptionRequest $subscriptionRequest): Response
    {
//        $requestContent = json_decode($request->getContent(), true);
//        $subscriptionRequest->setEmail($requestContent['email']);
//        $subscriptionRequest->setAgreed($requestContent['agreed']);

        $this->subscriberService->subscribe($subscriptionRequest);

        return $this->json(null);
    }
}
