<?php

namespace App\Application\Controller;

use App\Application\Query\Message\SeeMessageHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class SeeMessageController extends AbstractController
{
    public function __construct(private SeeMessageHandler $handler) {

    }

    #[Route('/api/message/see/{message_id}', name: 'see_message', methods: ['PUT'])]
    public function see($message_id): JsonResponse {
        $data = ['message_id' => $message_id];

        try {
            $result = $this->handler->handle($data);
            return $this->json(['status' => 'success', 'message' => 'Message marked as seen', 'data' => $result]);
        } catch (\Exception $e) {
            return $this->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
    }
}
