<?php

// src/BZ/BlogBundle/Controller/BlogController.php
namespace BZ\BlogBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Doctrine\ORM\EntityRepository;
use BZ\BlogBundle\Entity\RubriqueControle;
use BZ\BlogBundle\Form\RubriqueControleType;
use Symfony\Component\HttpFoundation\Response;

class RubriqueControleController  extends Controller
{
    public function read_rubriquecontroleAction()
    {
        $rubriquecontroles=$this->getDoctrine()->getManager()->getRepository("BZBlogBundle:RubriqueControle")->findBy(array('estsupprimer' => false));
        
        return $this->render('BZBlogBundle:RubriqueControle:read_rubriquecontrole.html.twig', 
        array('rubriquecontroles'   => $rubriquecontroles,'menu_num'=> 1));
    }
    
    public function create_rubriquecontroleAction()
    {
        $newrubriquecontrole = new RubriqueControle;
        $form = $this->createForm(new RubriqueControleType, $newrubriquecontrole);   
        $request = $this->get('request');
        if ($request->getMethod() == 'POST') 
        {
            $form->bind($request);
            if ($form->isValid()) 
            {
                $em = $this->getDoctrine()->getManager(); 
                $user = $this->getUser();
                $newrubriquecontrole->setLoginCreate($user->getUsername());
                $newrubriquecontrole->setEstsupprimer(false);
                $em->persist($newrubriquecontrole);
                $em->flush();
                //return $this->redirect( $this->generateUrl('read_rubriquecontrole'));
            }
        }
        return $this->render('BZBlogBundle:RubriqueControle:create_rubriquecontrole.html.twig', 
        array('form'   => $form->createView(),'menu_num'=> 1));
    }
    public function update_rubriquecontroleAction($id)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository("BZBlogBundle:RubriqueControle");
        $newrubriquecontrole=$repository->findOneBy(array('id' => $id));
        $form = $this->createForm(new RubriqueControleType, $newrubriquecontrole);   
        $request = $this->get('request');
        if ($request->getMethod() == 'POST') 
        {
            $form->bind($request);
            if ($form->isValid()) 
            {
                $em = $this->getDoctrine()->getManager(); 
                $user = $this->getUser();
                $newrubriquecontrole->setLoginUpdate($user->getUsername());
                $em->flush();
                //return $this->redirect( $this->generateUrl('read_rubriquecontrole'));
            }
        }
        return $this->render('BZBlogBundle:RubriqueControle:update_rubriquecontrole.html.twig', 
        array('form'=> $form->createView(), 'menu_num'=> 1, 'id'=> $id));
    }
    public function delete_rubriquecontroleAction($id)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository("BZBlogBundle:RubriqueControle");
        $newrubriquecontrole=$repository->findOneBy(array('id' => $id)); 
        $request = $this->get('request');
        if ($request->getMethod() == 'POST') 
        {
            
                $em = $this->getDoctrine()->getManager(); 
                $user = $this->getUser();
                $newrubriquecontrole->setLoginDelete($user->getUsername());
                $newrubriquecontrole->setEstsupprimer(true);
                $newrubriquecontrole->setDatedelete(new \Datetime());
                $em->flush();
              
        }
        return $this->render('BZBlogBundle:RubriqueControle:delete_rubriquecontrole.html.twig', 
        array('menu_num'=> 1, 'id'=> $id, 'rubriquecontrole'=> $newrubriquecontrole->getLibelle()));
    }
    
   public function print_rubriquecontroleAction()
    {
            $exos= $this->getDoctrine()
                                      ->getManager()->getRepository('BZBlogBundle:RubriqueControle')
                                      ->findBy(Array('estsupprimer'=>false),Array('libelle'=>'ASC'));
             //on stocke la vue à convertir en PDF, en n'oubliant pas les paramètres twig si la vue comporte des données dynamiques
            $html = $this->renderView('BZBlogBundle:RubriqueControle:print_rubriquecontrole.html.twig', array( 'rubriquecontroles' => $exos));
            //on appelle le service html1pdf
            $html1pdf = $this->get('html2pdf_factory')->create();
            $html1pdf->setTestTdInOnePage(false);
            //real : utilise la taille réelle
            $html1pdf->pdf->SetDisplayMode('real');
            //writeHTML va tout simplement prendre la vue stocker dans la variable $html pour la convertir en format PDF
            $html1pdf->writeHTML($html);
            //Output envoit le document PDF au navigateur internet
            return new Response($html1pdf->Output('Liste_des_rubriquecontroles_activite.pdf'), 100, array('Content-Type' => 'application/pdf'));
                       
    }
  
}
