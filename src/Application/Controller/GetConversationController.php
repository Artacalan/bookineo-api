<?php

namespace App\Application\Controller;

use App\Application\Query\Message\GetConversationHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class GetConversationController extends AbstractController
{
    public function __construct(private GetConversationHandler $handler)
    {
    }

    #[Route('/api/conversation/{receiver_id}/{sender_id}', name: 'conversation', methods: ['GET'])]
    public function get($receiver_id, $sender_id): JsonResponse {

        $data = ['receiver_id' => $receiver_id, 'sender_id' => $sender_id];

        try {
            $result = $this->handler->handle($data);
            return $this->json($result);
        } catch (\Exception $e) {
            return $this->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
    }
}
