<?php

namespace App\Application\Controller;

use App\Application\Query\User\VerifyUserHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class VerifyUserController extends AbstractController
{
    public function __construct(private VerifyUserHandler $handler) {}

    #[Route('/api/verify-user', name: 'verify_user', methods: ['POST'])]
    public function verify(Request $request): JsonResponse {
        $data = json_decode($request->getContent(), true);

        $verify = $this->handler->handle($data);

        try {
            if ($verify !== 'verified') {
                return $this->json(['status' => 'error', 'message' => $verify], 400);
            } else {
                return $this->json(['status' => 'success', 'message' => 'User verified successfully']);
            }
        } catch (\Exception $e) {
            return $this->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
    }
}
