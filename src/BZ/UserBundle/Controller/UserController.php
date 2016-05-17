<?php

namespace BZ\UserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BZ\UserBundle\Entity\User;
use BZ\UserBundle\Form\UserType;
use BZ\UserBundle\Form\RegisterType;
use BZ\UserBundle\Form\ModifUserType;
use BZ\UserBundle\Form\PasswordUserType;
use BZ\UserBundle\Form\AddUserType;
use Symfony\Component\HttpFoundation\Response;

/**
 * User controller.
 *
 */
class UserController extends Controller
{

    
    public function  deconnecterAction()
    {
        $entity=$this->getUser();
        $userManager = $this->get('fos_user.user_manager');
        $entity->setIsconnect(0);
         $userManager->updateUser($entity);
        return $this->redirect( $this->generateUrl('fos_user_security_logout'));
    }
    /**
     * Creates a new User entity.
     *
     */
    public function createAction()
    {
        $userManager = $this->get('fos_user.user_manager');
        $entity = $userManager->createUser();
        $entity->setEnabled(true);
        $entity->setIsconnect(0);
        $form = $this->createForm(new AddUserType(), $entity);       
        $request = $this->get('request');
        if ($request->getMethod() == 'POST') 
        {
            $form->bind($request);
            if ($form->isValid()) {
                //$user = $this->get('fos_user.user_manager')->findUserByUsername($entity->getUsername());
               
                   if($entity->getImage()!=null)
                    {
                           $entity->getImage()->setUser($entity);
                    }
                    $userManager->updateUser($entity);
                    $this->UpdateProfil($entity->getId());
                      return $this->redirect( $this->generateUrl('bz_user_membre')); 
//            return $this->redirect( $this->generateUrl('bz_user_create',array(
//            'menu_num'=> 2,)));
            }
        }
        return $this->render('BZUserBundle:User:new.html.twig', array(
            'edit_form'   => $form->createView(),
             'menu_num'=> 2,
        ));
    }
    
    /**
     * Displays a form to edit an existing User entity.
     *
     */
    public function editAction($id)
    {
        $userManager = $this->get('fos_user.user_manager');
        $entity = $userManager->findUserBy(array('id' => $id));
         $form = $this->createForm(new ModifUserType(), $entity);         
        $request = $this->get('request');
        if ($request->getMethod() == 'POST') 
        {
            $form->bind($request);
            if ($form->isValid()) {
                if($entity->getImage()!=null)
                {
                   $entity->getImage()->setUser($entity);
                }
                 $userManager->updateUser($entity);
                 $this->UpdateProfil($entity->getId());
            }
        }
        return $this->render('BZUserBundle:User:show.html.twig', array(
             'edit_form'   => $form->createView(),
             'menu_num'=> 2,
             'id'=> $id,
        ));
    }
    /**
     * Edits an existing User entity.
     *
     */
    public function updateAction()
    {
        
        $userManager = $this->get('fos_user.user_manager');
        $entity = $userManager->findUserBy(array('id' => $this->getUser()->getId()));
        $form = $this->createForm(new UserType, $entity);
        $request = $this->get('request');
        if ($request->getMethod() == 'POST') 
        {
            $form->bind($request);
            if ($form->isValid()) {
              if($entity->getImage()!=null)
              {
                  $entity->getImage()->setUser($entity);
              }
              $userManager->updateUser($entity);
            }
              return $this->redirect($this->generateUrl('pub_acceuil')); 
        }
        return $this->render('BZUserBundle:User:edit.html.twig', array(
            'edit_form'   => $form->createView(),
             'menu_num'=> 2,
        ));
    }
    
    public function registerAction()
    {
        $userManager = $this->get('fos_user.user_manager');
        $entity = $userManager->createUser();
        $form = $this->createForm(new RegisterType(), $entity);
        
        $request = $this->get('request');
        if ($request->getMethod() == 'POST') 
        {
            $form->bind($request);
            if ($form->isValid()) 
            {
                $em = $this->getDoctrine()->getManager();
                $entity->setEnabled(true);
                $em->persist($entity);
                $em->flush();
                return $this->redirect($this->generateUrl('fos_user_security_login'));
            }
        }
        return $this->render('BZUserBundle:Security:register.html.twig', 
        array('form'   => $form->createView(),
              'menu_num'=> 2));
    }
    /**
     * Deletes a User entity.
     *
     */
    public function deleteAction($id)
    {
       $userManager = $this->get('fos_user.user_manager');
        $user = $userManager->findUserBy(array('id' => $id));
        
            $request = $this->get('request');
            if ($request->getMethod() == 'POST') 
            {
              $userManager->deleteUser($user);
            return $this->redirect( $this->generateUrl('bz_user_membre',array(
            'page' => 2,
            'menu_num'=> 2,)));
        }
        return $this->render('BZUserBundle:User:delete.html.twig',array(
            'id' => $id,
            'menu_num'=> 2,
            'username'=> $user->getUsername(),
            ));
    }

    public function   UpdateProfil($id)
    {
        $userManager = $this->get('fos_user.user_manager');
        $user = $userManager->findUserBy(array('id' => $id));
        
                $user->setRoles(array('roles'=>$user->getProfil()->getCode()));
                $userManager->updateUser($user);
    }
    
    public function   bz_user_lockAction($id)
    {
        $userManager = $this->get('fos_user.user_manager');
        $user = $userManager->findUserBy(array('id' => $id));
        
            $request = $this->get('request');
            if ($request->getMethod() == 'POST') 
            {
              $user->setLocked(true);
              $user->setEnabled(false);
              $userManager->updateUser($user);
              return $this->redirect( $this->generateUrl('bz_user_membre',array(
              'page' => 2,
              'menu_num'=> 2,)));
            }
        return $this->render('BZUserBundle:User:userkey.html.twig',array(
            'id' => $id,
            'menu_num'=> 2,
            'username'=> $user->getUsername(),
            ));  
    }
    
    public function   bz_user_unlockAction($id)
    {
        $userManager = $this->get('fos_user.user_manager');
        $user = $userManager->findUserBy(array('id' => $id));
        
            $request = $this->get('request');
            if ($request->getMethod() == 'POST') 
            {
              $user->setLocked(false);
              $user->setEnabled(true);
              $userManager->updateUser($user);
              return $this->redirect( $this->generateUrl('bz_user_membre',array(
              'page' => 2,
              'menu_num'=> 2,)));
            }
        return $this->render('BZUserBundle:User:userunkey.html.twig',array(
            'id' => $id,
            'menu_num'=> 2,
            'username'=> $user->getUsername(),
            ));  
    }
    
    public function logoutAction()
    {
//        throw new \RuntimeException('You must activate the logout in your security firewall configuration.');
                    
    }
   public function  membreAction()
    {
           $membres = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('BZUserBundle:User')->findAll();
//                            ->getUser($page); // 200 enregistrement par page déjà définie : c'est totalement arbitraire ! // On ajoute ici les variables page et nb_page à la vue
                            return $this->render('BZUserBundle:User:membres.html.twig',
                            array(
                            'membres'=> $membres,
                            'menu_num'=> 2,
                            ));
    }
   
    public function membre_groupeAction()
    {
        $repository = $this->getDoctrine()
                        ->getManager();
                 $user= $repository->getRepository('BZUserBundle:User')->findBy(array( 'enabled' => true,'locked' => false));
            return $this->render('BZUserBundle:User:index.html.twig',array(
            'membres' => $user,'menu_num'=> 2));

    }
    //fin
    //
    //les groupes des utilisateurs
    public function  voir_groupeAction()
    {
       $repository = $this->getDoctrine()
                        ->getManager()
                        ->getRepository('BZUserBundle:User')->findBy(array('enabled' => true,'locked' => false));
       
       return $this->render('BZUserBundle:User:voir_groupe.html.twig',array(
            'membres' => $repository,
            'menu_num'=> 2,
            ));
    }
    
    public function  voir_user_serviceAction($service)
    {
        $repository = $this->getDoctrine()
                        ->getManager();
                 $user= $repository->getRepository('BZUserBundle:User')->findBy(array( 'enabled' => true,'locked' => false,'service' => $service));
                 $serv= $repository->getRepository('BZUserBundle:Service')->find($service)->getDenomination();
            return $this->render('BZUserBundle:User:users_service.html.twig',array(
            'membres' => $user,'menu_num'=> 2, 'serv'=> $serv));
    }
    
    public function print_repuserAction()
    {
            $users= $this->getDoctrine()
                                      ->getManager()->getRepository('BZUserBundle:User')
                                      ->findBy(array( 'enabled' => true,'locked' => false),Array('firstName'=>'ASC', 'lastName'=>'ASC'));
             //on stocke la vue à convertir en PDF, en n'oubliant pas les paramètres twig si la vue comporte des données dynamiques
            $html = $this->renderView('BZUserBundle:User:print_repuser.html.twig', array( 'users' => $users));
            //on appelle le service html2pdf
            $html2pdf = $this->get('html2pdf_factory')->create();
            $html2pdf->setTestTdInOnePage(false);
            //real : utilise la taille réelle
            $html2pdf->pdf->SetDisplayMode('real');
            //writeHTML va tout simplement prendre la vue stocker dans la variable $html pour la convertir en format PDF
            $html2pdf->writeHTML($html);
            //Output envoit le document PDF au navigateur internet
            return new Response($html2pdf->Output('Liste_des_agents.pdf'), 200, array('Content-Type' => 'application/pdf'));
                       
    }    
    
}
