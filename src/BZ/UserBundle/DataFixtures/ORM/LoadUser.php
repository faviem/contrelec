<?php
/*
 * This file is part of the Gestion Internet Game Center package.
 *
 * (c) Blue Zone <contact@bluezone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

namespace BZ\UserBundle\DataFixtures\ORM;

/**
 * Load default users
 *
 * @author Jacques Adjahoungbo <tocicason@hotmail.fr>
 */

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use BZ\UserBundle\Entity\User;
use BZ\UserBundle\Entity\Profil;
use BZ\UserBundle\Entity\Service;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
class LoadUser extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{
 
    public function load(ObjectManager $manager)
    {
        $profil1 = new Profil;
        $profil1->setCode('ROLE_ADMIN');
        $profil1->setLibelle('Administrateur');
        $manager->persist($profil1);
        $manager->flush();
         $profil2 = new Profil;
        $profil2->setCode('ROLE_DIR');
        $profil2->setLibelle('Directeur Général');
        $manager->persist($profil2);
        $manager->flush();
        $profil3 = new Profil;
        $profil3->setCode('ROLE_USER');
        $profil3->setLibelle('Membre');
        $manager->persist($profil3);
        $manager->flush();
        
        $service = new Service;
        $service->setSigle('DIR');
        $service->setDenomination('DIRECTION GENERALE');
        $service->setLoginCreate('admin');
        $manager->persist($service);
        $manager->flush();
        
        $user1 = new User();
        $user1->setUsername('admin');        
        $user1->setLastName('Emile');        
        $user1->setFirstName('FADONOUGBO');        
        $user1->setEnabled(true);
        $user1->setEmail('fvemile2012@gmail.com');
        $user1->setPlainPassword('admin');
        $user1->setRoles(array('ROLE_ADMIN'));
        $user1->setProfil($profil1);
        $user1->setService($service);
        
        // On le persiste
        $manager->persist($user1);
        $manager->flush();
    }
    /**
    * {@inheritdoc}
    */
    public function getOrder()
    {
    return 2;
    } 
    
}