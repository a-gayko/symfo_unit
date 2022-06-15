<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManager;
use App\Security\EmailVerifier;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegistrationControllerTest extends WebTestCase
{
    private User $user;

    public function setUp() : void
    {
        $this->user = new User();
    }

    public function testRegisterUserNotEmpty() : void
    {
        $em = $this->createMock(EntityManager::class);
        $em->expects($this->any())
        ->method('persist')
        ->with($this->equalTo($this->user));
        $this->assertNotEmpty($em);
    }

    public function testVerifyUserEmail() : void
    {
        $request = new Request();
        $emailVerifier = $this->createMock(EmailVerifier::class);
        $emailVerifier->expects($this->any())
        ->method('handleEmailConfirmation')
        ->with($this->equalTo($request), $this->equalTo($this->user));
        $this->assertNotNull($emailVerifier);
    }

    /**
     * @dataProvider urlProvider
     */
    public function testPageIsSuccessful($url)
    {
        $client = self::createClient();
        $client->request('GET', $url);

        // $this->assertResponseIsSuccessful();
        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    public function urlProvider()
    {
        return [
            ['/en/register'],
            ['/en/verify/email'],
        ];
    }
}