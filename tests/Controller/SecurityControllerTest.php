<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use PHPUnit\Framework\TestCase;

class SecurityControllerTest extends TestCase
{
    private AuthenticationUtils $authenticationUtils;

    public function setUp() : void
    {
        $this->authenticationUtils = $this->createMock(AuthenticationUtils::class);
    }

    public function testLoginLastUsernameIsColled() : void
    {
        $this->authenticationUtils->expects($this->any())->method('getLastUsername');
        $this->assertNotEmpty($this->authenticationUtils);
    }


    public function testLoginErrorIsColled() : void
    {
        $this->authenticationUtils->expects($this->any())->method('getLastAuthenticationError');
        $this->assertNotEmpty($this->authenticationUtils);
    }
}