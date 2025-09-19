<?php

namespace App\Application\Controller;

use App\Infrastructure\RentRepository;
use Doctrine\ORM\AbstractQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class GetRents extends AbstractController
{
    public function __construct(private RentRepository $repository)
    {

    }

    #[Route('/api/rents', name: 'rents', methods: ['GET'])]
    public function get(): JsonResponse {
        try {
            $result = $this->repository->get();
            return $this->json($result, 200, [], ['groups' => 'rent:read']);
        } catch (\Exception $e) {
            return $this->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
    }
}
