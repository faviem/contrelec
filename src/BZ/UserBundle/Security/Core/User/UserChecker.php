<?php

namespace BZ\UserBundle\Security\Core\User;

use Symfony\Component\Security\Core\Exception\LockedException;
use Symfony\Component\Security\Core\Exception\DisabledException;
use Symfony\Component\Security\Core\Exception\AccountExpiredException;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Security\Core\User\UserChecker as BaseUserChecker;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Translation\TranslatorInterface;

class UserChecker extends BaseUserChecker
{
    private $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    public function checkPostAuth(UserInterface $user)
    {
        if (!$user instanceof AdvancedUserInterface) {
            return;
        }

        if (!$user->isAccountNonLocked()) {
            $ex = new LockedException('User account is locked.');
            $ex->setUser($user);
            throw $ex;
        }

        if (!$user->isEnabled()) {
            $ex = new DisabledException($this->translator->trans('Bad credentials', array(), 'FOSUserBundle'));
            $ex->setUser($user);
            throw $ex;
        }

        if (!$user->isAccountNonExpired()) {
            $ex = new AccountExpiredException('User account has expired.');
            $ex->setUser($user);
            throw $ex;
        }

//        TODO: Gestion des utilisateurs bloqués
//        if ($user->getSubscriberType()->getId() === Subscribertype::SUBSCRIBER_TYPE_OCCASIONNEL) {
//            $ex = new DisabledException($this->translator->trans('You are not authorized', array(), 'FOSUserBundle'));
//            $ex->setUser($user);
//            throw $ex;
//        }
    }
}
