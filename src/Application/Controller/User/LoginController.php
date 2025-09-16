<?php

namespace App\Application\Controller;

use App\Application\Query\Login\GetLoginHandler;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LoginController extends AbstractController
{
    public function __construct(private GetLoginHandler $handler)
    {

    }
    #[Route('/api/login', name: 'login', methods: ['POST'])]
    public function login(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $user = $this->handler->handle($data);

        if ($user === null) {
            return $this->json(['status' => 'error', 'message' => 'Invalid credentials'], 401);
        } else {
            return $this->json(['status' => 'success', 'message' => 'Login successful', 'user' => $user]);
        }
    }
}
