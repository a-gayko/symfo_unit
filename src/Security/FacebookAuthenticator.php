<?php

namespace App\Security;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use KnpU\OAuth2ClientBundle\Client\OAuth2ClientInterface;
use KnpU\OAuth2ClientBundle\Security\Authenticator\SocialAuthenticator;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use League\OAuth2\Client\Provider\FacebookUser;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class FacebookAuthenticator extends SocialAuthenticator
{
    private ClientRegistry $clientRegistry;
    private EntityManagerInterface $em;
    private RouterInterface $router;

    public function __construct(ClientRegistry $clientRegistry, EntityManagerInterface $em, RouterInterface $router)
    {
        $this->clientRegistry = $clientRegistry;
        $this->em = $em;
        $this->router = $router;
    }

    public function supports(Request $request): bool
    {
        // continue ONLY if the current ROUTE matches the check ROUTE
        return $request->attributes->get('_route') === 'connect_facebook_check';
    }

    public function getCredentials(Request $request)
    {
        return $this->fetchAccessToken($this->getFacebookClient());
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        /** @var FacebookUser $facebookUser */
        $facebookUser = $this->getFacebookClient()
            ->fetchUserFromToken($credentials);

        $email = $facebookUser->getEmail();

        $user = $this->em->getRepository(User::class)
            ->findOneBy(['email' => $email]);

        // Maybe you just want to "register" them by creating
        $user
            ->setEmail($email)
            ->setUsername($facebookUser->getName())
            ->setRoles(['ROLE_USER']);
        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }

    /**
     * @return OAuth2ClientInterface
     */
    private function getFacebookClient(): OAuth2ClientInterface
    {
        return $this->clientRegistry->getClient('facebook');
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey): RedirectResponse
    {
        // change "app_homepage" to some route in your app
        $targetUrl = $this->router->generate('home');

        return new RedirectResponse($targetUrl);

        // or, on success, let the request continue to be handled by the controller
        //return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): Response
    {
        $message = strtr($exception->getMessageKey(), $exception->getMessageData());

        return new Response($message, Response::HTTP_FORBIDDEN);
    }

    /**
     * Called when authentication is needed, but it's not sent.
     * This redirects to the 'login'.
     */
    public function start(Request $request, AuthenticationException $authException = null): RedirectResponse
    {
        return new RedirectResponse(
            '/connect/', // might be the site, where users choose their oauth provider
            Response::HTTP_TEMPORARY_REDIRECT
        );
    }

    // ...
}
