<?php

namespace App\Tests\Controller;

use App\Controller\UserController;
use Ecotone\Modelling\CommandBus;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\Container;

class UserControllerKernelTest extends KernelTestCase
{
    public function testCreateUserReturnsValidUUID()
    {
        self::bootKernel();

        $container = static::getContainer();

        $userController = $container->get(UserController::class);
        $createUserResponse = $userController->createUser();

        $userId = $createUserResponse->getContent();

        $this->assertTrue(Uuid::isValid($userId));
    }

    public function testCommandHandlerContainsCreateUserCommand()
    {
        self::bootKernel();

        $container = static::getContainer();

        $this->setupCommandBusMock($container);

        $userController = $container->get(UserController::class);

        $userController->createUser();
    }

    private function setupCommandBusMock(Container $container)
    {
        $commandBusMock = $this->getMockBuilder(CommandBus::class)
            ->disableOriginalConstructor()
            ->getMock();

        $commandBusMock->expects($this->once())
            ->method('sendWithRouting');

        $container->set(CommandBus::class, $commandBusMock);
    }
}