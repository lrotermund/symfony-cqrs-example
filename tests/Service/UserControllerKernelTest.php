<?php

namespace App\Tests\Service;

use App\Controller\UserController;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserControllerKernelTest extends KernelTestCase
{
    public function testUserCreated()
    {
        self::bootKernel();

        $container = static::getContainer();

        $createUserCommand = $container->get(UserController::class);
        $createUserResponse = $createUserCommand->createUser();

        $userId = $createUserResponse->getContent();

        $this->assertTrue(Uuid::isValid($userId));
    }
}