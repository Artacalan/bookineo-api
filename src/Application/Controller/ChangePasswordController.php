<?php

namespace App\Application\Controller;

use App\Application\Query\User\ChangePasswordHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class ChangePasswordController extends AbstractController
{
    public function __construct(private ChangePasswordHandler $handler) {}

    #[Route('api/change-password', name: 'api_change_password', methods: ['POST'])]
    public function changePassword(Request $request): JsonResponse {
        $data = json_decode($request->getContent(), true);

        $result = $this->handler->handle($data);

        if ($result !== 'password changed') {
            return $this->json(['status' => 'error', 'message' => $result], 400);
        } else {
            return $this->json(['status' => 'success', 'message' => 'Password changed successfully']);
        }
    }
}
