<?php

// src/BZ/BlogBundle/Controller/BlogController.php
namespace BZ\BlogBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityRepository;
use BZ\BlogBundle\Entity\ObjetConservation;
use BZ\BlogBundle\Form\ObjetConservationType;
use Symfony\Component\HttpFoundation\Response;

class ObjetConservationController  extends Controller
{
    public function read_objetconservationAction()
    {
        $objetconservations=$this->getDoctrine()->getManager()->getRepository("BZBlogBundle:ObjetConservation")->findBy(array('estsupprimer' => false));
        
        return $this->render('BZBlogBundle:ObjetConservation:read_objetconservation.html.twig', 
        array('objetconservations'   => $objetconservations,'menu_num'=> 1));
    }
    
    public function create_objetconservationAction()
    {
        $newobjetconservation = new ObjetConservation;
        $form = $this->createForm(new ObjetConservationType, $newobjetconservation);   
        $request = $this->get('request');
        if ($request->getMethod() == 'POST') 
        {
            $form->bind($request);
            if ($form->isValid()) 
            {
                $em = $this->getDoctrine()->getManager(); 
                $user = $this->getUser();
                $newobjetconservation->setLoginCreate($user->getUsername());
                $newobjetconservation->setEstsupprimer(false);
                $em->persist($newobjetconservation);
                $em->flush();
                //return $this->redirect( $this->generateUrl('read_objetconservation'));
            }
        }
        return $this->render('BZBlogBundle:ObjetConservation:create_objetconservation.html.twig', 
        array('form'   => $form->createView(),'menu_num'=> 1));
    }
    public function update_objetconservationAction($id)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository("BZBlogBundle:ObjetConservation");
        $newobjetconservation=$repository->findOneBy(array('id' => $id));
        $form = $this->createForm(new ObjetConservationType, $newobjetconservation);   
        $request = $this->get('request');
        if ($request->getMethod() == 'POST') 
        {
            $form->bind($request);
            if ($form->isValid()) 
            {
                $em = $this->getDoctrine()->getManager(); 
                $user = $this->getUser();
                $newobjetconservation->setLoginUpdate($user->getUsername());
                $em->flush();
                //return $this->redirect( $this->generateUrl('read_objetconservation'));
            }
        }
        return $this->render('BZBlogBundle:ObjetConservation:update_objetconservation.html.twig', 
        array('form'=> $form->createView(), 'menu_num'=> 1, 'id'=> $id));
    }
    public function delete_objetconservationAction($id)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository("BZBlogBundle:ObjetConservation");
        $newobjetconservation=$repository->find($id); 
        $request = $this->get('request');
        if ($request->getMethod() == 'POST') 
        {
            
                $em = $this->getDoctrine()->getManager(); 
                $user = $this->getUser();
                $newobjetconservation->setLoginDelete($user->getUsername());
                $newobjetconservation->setEstsupprimer(true);
                $newobjetconservation->setDatedelete(new \Datetime());
                $em->flush();
        }
        return $this->render('BZBlogBundle:ObjetConservation:delete_objetconservation.html.twig', 
        array('menu_num'=> 1, 'id'=> $id, 'objetconservation'=>$newobjetconservation->getLibelle()));
    }
    
      public function print_objetconservationAction()
    {
            $objetclassements= $this->getDoctrine()
                                      ->getManager()->getRepository('BZBlogBundle:ObjetConservation')
                                      ->findBy(Array('estsupprimer'=>false),Array('libelle'=>'ASC'));
             //on stocke la vue à convertir en PDF, en n'oubliant pas les paramètres twig si la vue comporte des données dynamiques
            $html = $this->renderView('BZBlogBundle:ObjetConservation:print_objetconservation.html.twig', array( 'objets' => $objetclassements));
            //on appelle le service html1pdf
            $html1pdf = $this->get('html1pdf_factory')->create();
            $html1pdf->setTestTdInOnePage(false);
            //real : utilise la taille réelle
            $html1pdf->pdf->SetDisplayMode('real');
            //writeHTML va tout simplement prendre la vue stocker dans la variable $html pour la convertir en format PDF
            $html1pdf->writeHTML($html);
            //Output envoit le document PDF au navigateur internet
            return new Response($html1pdf->Output('Liste_des_objets_conservation.pdf'), 100, array('Content-Type' => 'application/pdf'));
                       
    }
    
}
