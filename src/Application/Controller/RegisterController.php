<?php

namespace App\Application\Controller;

use App\Application\Query\Register\GetRegisterHandler;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RegisterController extends AbstractController
{
    public function __construct(private GetRegisterHandler $repository)
    {

        }
    #[Route('/api/register', name: 'register', methods: ['POST'])]
    public function register(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        try {
            $register = $this->repository->handle($data);

            if ($register !== 'created') {
                return $this->json(['status' => 'error', 'message' => $register], 400);
            } else {
                return $this->json(['status' => 'success', 'message' => 'User created successfully']);
            }
        } catch (\Exception $e) {
            return $this->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }

    }
}
