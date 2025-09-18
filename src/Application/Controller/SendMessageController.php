<?php

namespace App\Application\Controller;

use App\Application\Query\Message\SendMessageHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class SendMessageController extends AbstractController
{
    public function __construct(private SendMessageHandler $handler)
    {

    }

    #[Route('/api/message', name: 'send_message', methods: ['POST'])]
    public function send(Request $request): JsonResponse {
        $data = json_decode($request->getContent(), true);

        try {
            $result = $this->handler->handle($data);
            if (isset($result['error'])) {
                return $this->json(['status' => 'error', 'message' => $result['error']], 400);
            }
            return $this->json(['status' => 'success', 'message' => 'Message sent successfully', 'data' => $result]);
        } catch (\Exception $e) {
            return $this->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
    }

}
