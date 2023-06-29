<?php

declare(strict_types=1);

namespace App\Controller;

use App\DTO\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

class PayloadController extends AbstractController
{
    #[Route(path: 'api/payload', name: 'payload', methods: ['POST'])]
    public function payloadAction(#[MapRequestPayload] User $user): JsonResponse
    {
        return new JsonResponse($user->getEmail());
    }
}
