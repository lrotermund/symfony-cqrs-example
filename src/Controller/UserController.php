<?php

namespace App\Controller;

use Ecotone\Modelling\CommandBus;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    public function __construct(private CommandBus $commandBus) {}

    #[Route('/user/create', methods: ['POST'])]
    public function createUser(): Response
    {
        return new Response(Uuid::uuid4());
    }
}