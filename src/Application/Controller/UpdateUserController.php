<?php

namespace App\Application\Controller;

use App\Application\Query\User\UpdateUserHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;


class UpdateUserController extends AbstractController
{

    public function __construct(private UpdateUserHandler $handler) {

    }

    #[Route('/api/update-user/{id}', name: 'update_user', methods: ['PUT'])]
    public function update(Request $request, $id): JsonResponse {
        $data = json_decode($request->getContent(), true);
        $data['id'] = $id;

        try {
            $update = $this->handler->handle($data);

            // si update contient un element 'error', on retourne une erreur
            if (isset($update['error'])) {
                return $this->json(['status' => 'error', 'message' => $update['error']], 400);
            } else {
                if (!$update) {
                    return $this->json(['status' => 'error', 'message' => 'User not found'], 404);
                }
                return $this->json(['status' => 'success', 'message' => 'User updated successfully', 'user' => $update]);
            }
        } catch (\Exception $e) {
            return $this->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
    }
}
