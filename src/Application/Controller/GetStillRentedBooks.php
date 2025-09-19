<?php

namespace App\Application\Controller;

use App\Infrastructure\RentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class GetStillRentedBooks extends AbstractController
{
    public function __construct(private RentRepository $repository)
    {

    }

    #[Route('/api/rent/still', name: 'renting', methods: ['GET'])]
    public function get(): JsonResponse {
        try {
            $result = $this->repository->getStillRentedBooks();
            return $this->json($result, 200, [], ['groups' => 'rent:read']);
        } catch (\Exception $e) {
            return $this->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
    }
}
