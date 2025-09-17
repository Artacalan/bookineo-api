<?php

namespace App\Application\Controller;

use App\Application\Query\Book\DeleteBookHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class DeleteBookController extends AbstractController
{
    public function __construct(private DeleteBookHandler $handler)
    {
    }

    #[Route('/api/book/{id}', name: 'delete_book', methods: ['DELETE'])]
    public function delete(Request $request, $id): JsonResponse
    {
        try {
            $this->handler->handle($id);
            return $this->json(['status' => 'success', 'message' => 'Book deleted successfully']);
        } catch (\Exception $e) {
            return $this->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
    }
}
