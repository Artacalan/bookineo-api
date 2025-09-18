<?php

namespace App\Application\Controller;

use App\Application\Query\Filter\FilterStatusHandler;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FilterStatusBookController extends AbstractController
{


    public function __construct(private FilterStatusHandler $handler)
    {

    }

    #[Route('/api/book/status', name: 'filter_status', methods: ['POST'])]
    public function filter(Request $request): JsonResponse
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

