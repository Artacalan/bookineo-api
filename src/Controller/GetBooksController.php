<?php

namespace App\Controller;

use App\BookRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GetBooksController extends AbstractController
{
    public function __construct(private BookRepository $repository)
    {

        }
    #[Route('/api/books', name: 'books', methods: ['GET'])]
    public function get(
        ): JsonResponse {
            $result = $this->repository->get();

            return $this->json($result);
        }
}
