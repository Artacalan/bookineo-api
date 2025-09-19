<?php

namespace App\Application\Controller;

use App\Application\Query\Rent\RentBookHandler;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RentBookController extends AbstractController
{
    public function __construct(private RentBookHandler $handler)
    {
    }
    #[Route('/api/rent', name: 'rent', methods: ['POST'])]
    public function rentBook(request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        try {
            $books = $this->handler->handle($data);
            return $this->json(['status' => 'success', 'data' => $books]);
        } catch (\Exception $e) {
            return $this->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
    }
}
