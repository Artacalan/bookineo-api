<?php

namespace App\Application\Controller;

use App\Application\Query\Message\GetMessageHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class GetMessageController extends AbstractController
{
    public function __construct(private GetMessageHandler $handler)
    {
    }

    #[Route('/api/message/{receiver_id}', name: 'message', methods: ['GET'])]
    public function get($receiver_id): JsonResponse {
        $data = ['receiver_id' => $receiver_id];

        try {
            $result = $this->handler->handle($data);
            return $this->json($result);
        } catch (\Exception $e) {
            return $this->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
    }
}
