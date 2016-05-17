<?php
// src/BZ/BlogBundle/Controller/BlogController.php
namespace BZ\BlogBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Response;
use BZ\BlogBundle\Entity\Message;
use BZ\BlogBundle\Entity\Emetteur;
use BZ\BlogBundle\Entity\Recepteur;
use Doctrine\ORM\EntityRepository;

class TchatController extends Controller
{
    
    public function consulter_boiteAction($id)
    {
       $messages= $this->getDoctrine()
                                      ->getManager()->getRepository('BZBlogBundle:Message')
                                      ->findBy(Array('objet'=>'discussion'),Array('dateEnvoi'=>'ASC'));
        return $this->render('BZBlogBundle:Tchat:palette_tchat.html.twig', 
        array('menu_num'=> 2, 'id'=> $id, 'messages'=> $messages));
    }
    
    public function consulter_boiteautreAction($id)
    {
       $messages= $this->getDoctrine()
                                      ->getManager()->getRepository('BZBlogBundle:Message')
                                      ->findBy(Array('objet'=>'discussion'),Array('dateEnvoi'=>'ASC'));
        return $this->render('BZBlogBundle:Tchat:consulter_boite.html.twig', 
        array('menu_num'=> 2, 'id'=> $id, 'messages'=> $messages));
    }
    
    public function envoyer_msgAction($id)
    {
            $request = $this->get('request');
            if ($request->getMethod() == 'POST') 
            {
                $em = $this->getDoctrine()->getManager();
                $messagerecus= $this->getDoctrine()
                                      ->getManager()->getRepository('BZBlogBundle:Recepteur')
                                      ->findBy(Array('estdelete'=>false, 'user'=>  $this->getUser()->getId()));
                foreach ($messagerecus as $i){
                       if($i->getMessage()->getObjet()=='discussion' && $i->getMessage()->getEmetteur()->getUser()->getId()==$id){
                            $i->setEstLu(true);
                       }       
                  }
                $em->flush();
                $emetteur=new Emetteur;
                $emetteur->setUser($this->getUser());
                $message = new Message;
                $message->setEmetteur($emetteur);
                $message->setDateEnvoi(new \ Datetime());
                $message->setObjet('discussion');
                $message->setMessageEnvoi($_POST['messageTexte']);
                $recepteur = new Recepteur;
                $recepteur->setUser($this->getDoctrine() ->getManager()->getRepository('BZUserBundle:User')->find($id));       
                //$em = $this->getDoctrine()->getManager();
                $message->addRecepteur($recepteur);
                $em->persist($message);
                $em->flush();
                 $response = new Response(json_encode(array('rep' => 'ok')));
                $response->headers->set('Content-Type', 'application/json');
                return $response; 
        }
//                      
    }
   
}
