<?php

namespace App\Application\Controller;

use App\Infrastructure\UserRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GetUsersController extends AbstractController
{
    public function __construct(private UserRepository $repository)
    {

        }
    #[Route('/api/users', name: 'users', methods: ['GET'])]
    public function get(
        ): JsonResponse {
            $result = $this->repository->get();

            return $this->json($result);
        }
}
