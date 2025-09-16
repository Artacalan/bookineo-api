<?php

namespace App\Application\Controller;

use App\Application\Query\Book\CreateBookHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;


class CreateBookController extends AbstractController
{
    public function __construct(private CreateBookHandler $handler)
    {

    }
    #[Route('/api/book', name: 'create_book', methods: ['POST'])]
    public function create(Request $request): JsonResponse {
        $data = json_decode($request->getContent(), true);

        try {
            $this->handler->handle($data);
            return $this->json(['status' => 'success', 'message' => 'Book created successfully']);
        } catch (\Exception $e) {
            return $this->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
    }
}
