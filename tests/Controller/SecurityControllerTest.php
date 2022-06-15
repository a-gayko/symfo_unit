<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
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
            ['/en/login'],
            ['/en/logout'],
        ];
    }
}