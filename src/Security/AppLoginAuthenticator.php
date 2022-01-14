<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\RememberMeBadge;
use Symfony\Component\Security\Http\EntryPoint\AuthenticationEntryPointInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;

class AppLoginAuthenticator extends AbstractAuthenticator implements AuthenticationEntryPointInterface
{
    private $requestStack;
    private $urlGenerator;

    public function __construct(RequestStack $requestStack, UrlGeneratorInterface $urlGenerator)
    {
        $this->requestStack = $requestStack;
        $this->urlGenerator = $urlGenerator;
    }

    public function supports(Request $request): bool
    {
        if($request->attributes->get('_route') !== 'user_login') {
            return false;
        }

        if($request->getMethod() !== 'POST') {
            return false;
        }

        return true; 

        // cette méthode défini dans quel cas l'authenticator doit s'activer (si pas sur le bon chemin, ni en methode post = false)
    }

    public function authenticate(Request $request): Passport
    {
        $email = $request->request->get('_email');
        $password = $request->request->get('_password');
        $token = $request->request->get('_token');

        // $request->getSession()->set(Security::LAST_USERNAME, $email);

        return new Passport(
            new UserBadge($email),
            new PasswordCredentials($password),
            [
                new RememberMeBadge(),
                new CsrfTokenBadge('authenticate', $token)
            ]
        );
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        $session = $this->requestStack->getSession();
        $flashBag = $session->getFlashBag();
        $flashBag->add('notice', 'Vous êtes connecté(e)');

        $url = $this->urlGenerator->generate('main_index');
        return new RedirectResponse($url);
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        $session = $this->requestStack->getSession();
        $session->set(Security::AUTHENTICATION_ERROR, $exception);

        return null;
    }

    public function start(Request $request, AuthenticationException $authException = null): Response
    {
        $session = $this->requestStack->getSession();
        $flashBag = $session->getFlashBag();
        $flashBag->add('info', 'Vous devez être connecté(e) pour créer un évènement');
        
        $url = $this->urlGenerator->generate('user_login');
        return new RedirectResponse($url);
    }

}
