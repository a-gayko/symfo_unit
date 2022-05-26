<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManager;
use App\Security\EmailVerifier;
use Symfony\Component\HttpFoundation\Request;
use PHPUnit\Framework\TestCase;

class RegistrationControllerTest extends TestCase
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
}