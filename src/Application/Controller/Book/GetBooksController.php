<?php

namespace App\Application\Controller;


use App\Application\Query\Book\GetBooksHandler;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GetBooksController extends AbstractController
{
    public function __construct(private GetBooksHandler $handler)
    {

        }
    #[Route('/api/books', name: 'books', methods: ['GET'])]
    public function get(
        ): JsonResponse {
            $result = $this->handler->handle();

            return $this->json($result);
        }
}
