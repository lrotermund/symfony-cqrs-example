<?php

namespace App\Tests\Service;

use App\Controller\Command\CreateUser;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CreateUserCommandTest extends KernelTestCase
{
    public function testUserCreated()
    {
        $expectedId = "foo";

        self::bootKernel();

        $container = static::getContainer();

        $createUserCommand = $container->get(CreateUser::class);
        $createUserResponse = $createUserCommand->createUser($expectedId);

        $userId = $createUserResponse->getContent();

        $this->assertTrue(Uuid::isValid($userId));
    }
}