<?php

namespace App\Application\Controller;



use App\Application\Query\Filter\FilterCategoryHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class FilterCategoryBookController extends AbstractController
{
    public function __construct(private FilterCategoryHandler $handler)
    {

        }
    #[Route('/api/book/category', name: 'filter_category', methods: ['POST'])]
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
