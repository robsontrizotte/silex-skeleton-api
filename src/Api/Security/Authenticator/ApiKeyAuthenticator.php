<?php

namespace Api\Security\Authenticator;

use Api\Http\Messages\Response;
use Api\Provider\ApiKeyUserProvider;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\PreAuthenticatedToken;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface;
use Symfony\Component\Security\Http\Authentication\SimplePreAuthenticatorInterface;

/**
 * Class ApiKeyAuthenticator
 * @package Api\Security
 */
class ApiKeyAuthenticator implements SimplePreAuthenticatorInterface, AuthenticationFailureHandlerInterface
{

    /**
     * @var ApiKeyUserProvider
     */
    protected $userProvider;

    /**
     * @var string
     */
    protected $paramName;

    /**
     * ApiKeyAuthenticator constructor.
     * @param ApiKeyUserProvider $userProvider
     * @param string $paramName
     */
    public function __construct(ApiKeyUserProvider $userProvider, $paramName)
    {
        $this->userProvider = $userProvider;
        $this->paramName = $paramName;
    }


    /**
     * This is called when an interactive authentication attempt fails. This is
     * called by authentication listeners inheriting from
     * AbstractAuthenticationListener.
     *
     * @param Request $request
     * @param AuthenticationException $exception
     *
     * @return JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        $response = Response::failure($exception->getMessage(), 403);
        return new JsonResponse($response->toArray(), $response->getHttpCode());
    }

    /**
     * @param TokenInterface $token
     * @param UserProviderInterface $userProvider
     * @param $providerKey
     * @return PreAuthenticatedToken
     */
    public function authenticateToken(TokenInterface $token, UserProviderInterface $userProvider, $providerKey)
    {
        $apiKey = $token->getCredentials();
        $user = $this->userProvider->getUserForApiKey($apiKey);
        if (!$user) {
            throw new AuthenticationException(
                sprintf('API Key %s does not exist', (string) $apiKey)
            );
        }

        return new PreAuthenticatedToken(
            $user,
            $apiKey,
            $providerKey,
            $user->getRoles()
        );
    }

    /**
     * @param TokenInterface $token
     * @param $providerKey
     * @return bool
     */
    public function supportsToken(TokenInterface $token, $providerKey)
    {
        return $token instanceof PreAuthenticatedToken && $token->getProviderKey() === $providerKey;
    }

    /**
     * @param Request $request
     * @param $providerKey
     * @return PreAuthenticatedToken
     */
    public function createToken(Request $request, $providerKey)
    {
        if (!$request->headers->has($this->paramName)) {
            throw new BadCredentialsException('No API key found ' . $this->paramName);
        }

        return new PreAuthenticatedToken(
            'anon.',
            $request->headers->get($this->paramName),
            $providerKey
        );
    }
}