<?php
// src/BZ/BlogBundle/Controller/BlogController.php
namespace BZ\BlogBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityRepository;

class BlogController extends Controller
{
    public function indexAction()
    {
 
         if($this->isGranted('ROLE_USER'))
         {
             $em = $this->getDoctrine()->getManager(); 
             $user=$em->getRepository("BZUserBundle:User")->find($this->getUser()->getId());
              $user->setIsconnect(1);
           $em->flush();
              return $this->render('BZUserBundle::layout.html.twig',array('menu_num'=> 1));
         }
         else{
                return $this->redirect( $this->generateUrl('fos_user_security_login'));
         }
     
    }
    
    public function notificationsAction()
    {
         
      $usersconnectes= $this->getDoctrine()
                        ->getManager()
                        ->getRepository('BZUserBundle:User')->findBy(array('enabled' => true,'locked' => false,'isconnect' => '1' ));
      $nbreuser=0;
      foreach ($usersconnectes as $i){
          if($i->getId() != $this->getUser()->getId()){ $nbreuser++;  }
      }
      
      $archivesnonlus=$this->getDoctrine()->getManager()
                ->getRepository("BZArchiveBundle:VisibiliteArchive")
                ->findBy(array('user' => $this->getUser()->getId(),'estestlu' =>false));
     $nbrearchive=0;
//     if($archivesnonlus != null){
        foreach ($archivesnonlus as $j){
          $nbrearchive++;  
        }
//     }
      $messagesnonlus= $this->getDoctrine()
                                      ->getManager()->getRepository('BZBlogBundle:Recepteur')
                                      ->findBy(Array('estdelete'=>false, 'user'=>  $this->getUser()->getId(),'estLu'=>false),Array('datepersist'=>'DESC'));
       $nbremesg=0;
//        if($messagesnonlus != null){
            foreach ($messagesnonlus as $k){
              $nbremesg++;  
            }
//        }
          
        $response = new Response(json_encode(array('nbreusers' => $nbreuser, 'nbrearchive' => $nbrearchive, 'nbremsg' => $nbremesg)));
            $response->headers->set('Content-Type', 'application/json');
            return $response; 
     
    }
  
   
}
