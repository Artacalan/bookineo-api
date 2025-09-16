<?php

namespace App\Application\Controller;

use App\Infrastructure\UserRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RegisterController extends AbstractController
{
    public function __construct(private UserRepository $repository)
    {

        }
    #[Route('/api/register', name: 'register', methods: ['POST'])]
    public function register(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $first_name = $data['first_name'] ?? '';
        $last_name = $data['last_name'] ?? '';
        $email = $data['email'] ?? '';
        $birthday = isset($data['birthday']) ? new \DateTimeImmutable($data['birthday']) : null;
        $password = $data['password'] ?? '';

        if (empty($first_name) || empty($last_name) || empty($email) || empty($birthday) || empty($password)) {
            return $this->json(['status' => 'error', 'message' => 'All fields are required', 'empty_fields' => ['first_name' => $first_name, 'last_name' => $last_name, 'email' => $email, 'birthday' => $birthday, 'password' => $password], "raw_data" => $data], 400);
        }

        try {
            $result = $this->repository->create_user($first_name, $last_name, $email, $birthday, $password);
            if ($result === "created") {
                return $this->json(['status' => 'success', 'message' => 'User registered successfully']);
            } else {
                return $this->json(['status' => 'error', 'message' => 'User registration failed', 'error' => $result], 500);
            }
        } catch (\Exception $e) {
            return $this->json(['status' => 'error', 'message' => 'Registration failed: ' . $e->getMessage()], 500);
        }
    }
}
