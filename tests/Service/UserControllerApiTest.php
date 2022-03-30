<?php

namespace App\Tests\Service;

use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerApiTest extends WebTestCase
{
    public function testPostMethod(): void
    {
        $client = static::createClient();
        $client->request('POST', '/user/create');
        $createUserResponse = $client->getResponse();

        $this->assertResponseIsSuccessful();
        
        $userId = $createUserResponse->getContent();

        $this->assertTrue(Uuid::isValid($userId));
    }
}
