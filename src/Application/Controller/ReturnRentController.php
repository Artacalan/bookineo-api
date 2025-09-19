<?php

namespace App\Application\Controller;

use App\Application\Query\Rent\ReturnRentHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class ReturnRentController extends AbstractController
{
    public function __construct(private ReturnRentHandler $handler)
    {

    }

    #[Route('/api/rent/return', name: 'return_rent', methods: ['POST'])]
    public function return(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $return = $this->handler->handle($data);

        // si return contient un element 'error', on retourne une erreur
        if (isset($return['error'])) {
            return $this->json(['status' => 'error', 'message' => $return['error']], 400);
        } else {
            return $this->json(['status' => 'success', 'message' => 'Book returned successfully', 'rent' => $return]);
        }
    }
}
