<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Entity\User;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * @implements ProviderInterface<User>
 */
class MeStateProvider implements ProviderInterface
{
    public function __construct(private readonly Security $security)
    {
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): \Symfony\Component\Security\Core\User\UserInterface
    {
        $user = $this->security->getUser();

        if (!$user) {
            // It's good practice to handle the case where the user might not be authenticated
            throw new AccessDeniedException('You must be logged in to access this resource.');
        }

        // Return the User object directly. API Platform will handle the rest.
        return $user;
    }
}
