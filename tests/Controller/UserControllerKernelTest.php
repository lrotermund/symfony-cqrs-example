<?php

namespace App\Tests\Controller;

use App\Controller\UserController;
use App\Domain\User\User;
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
        $expectedCommand = User::CREATE_USER;

        self::bootKernel();

        $container = static::getContainer();

        $this->setupCommandBusMock($container, $expectedCommand);

        $userController = $container->get(UserController::class);

        $userController->createUser();
    }

    private function setupCommandBusMock(Container $container, string $command)
    {
        $commandBusMock = $this->getMockBuilder(CommandBus::class)
            ->disableOriginalConstructor()
            ->getMock();

        $commandBusMock->expects($this->once())
            ->method('sendWithRouting')
            ->with($this->any(), $this->equalTo($command));

        $container->set(CommandBus::class, $commandBusMock);
    }
}