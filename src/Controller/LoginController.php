<?php

namespace App\Controller;

use App\UserRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LoginController extends AbstractController
{
    public function __construct(private UserRepository $repository)
    {

        }
    #[Route('/api/login', name: 'login', methods: ['POST'])]
    public function login(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $email = $data['email'] ?? '';
        $password = $data['password'] ?? '';

        $user = $this->repository->login_user($email, $password);

        if ($user) {
            return $this->json(['status' => 'success', 'user' => $user]);
        } else {
            return $this->json(['status' => 'error', 'message' => 'Invalid credentials'], 401);
        }
    }
}