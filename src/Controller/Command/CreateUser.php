<?php

namespace App\Controller\Command;

use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreateUser extends AbstractController
{
    #[Route('/user/create')]
    public function createUser(): Response
    {
        return new Response(Uuid::uuid4());
    }
}