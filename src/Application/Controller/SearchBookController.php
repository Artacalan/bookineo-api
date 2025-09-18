<?php

namespace App\Application\Controller;

use App\Application\Query\Filter\SearchBookHandler;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SearchBookController extends AbstractController
{
    public function __construct(private SearchBookHandler $handler)
    {
    }

    #[Route('/api/book/search', name: 'search', methods: ['POST'])]
    public function search(Request $request): JsonResponse
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
