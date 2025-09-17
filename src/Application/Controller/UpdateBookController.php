<?php

namespace App\Application\Controller;

use App\Application\Query\Book\UpdateBookHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class UpdateBookController extends AbstractController
{
    public function __construct(private UpdateBookHandler $handler)
    {

    }
    #[Route('/api/book/{id}', name: 'update_book', methods: ['PUT'])]
    public function update(Request $request, $id): JsonResponse {
        $data = json_decode($request->getContent(), true);
        $data['id'] = $id; // Ensure the ID from the URL is included in the data array

        try {
            $this->handler->handle($data);
            return $this->json(['status' => 'success', 'message' => 'Book updated successfully']);
        } catch (\Exception $e) {
            return $this->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
    }
}

