<?php

// src/BZ/BlogBundle/Controller/BlogController.php
namespace BZ\BlogBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Doctrine\ORM\EntityRepository;
use BZ\BlogBundle\Entity\SousRubriqueControle;
use BZ\BlogBundle\Form\SousRubriqueControleType;
use Symfony\Component\HttpFoundation\Response;

class SousRubriqueControleController  extends Controller
{
    public function read_sousrubriquecontroleAction()
    {
        $sousrubriquecontroles=$this->getDoctrine()->getManager()->getRepository("BZBlogBundle:SousRubriqueControle")->findBy(array('estsupprimer' => false));
        
        return $this->render('BZBlogBundle:SousRubriqueControle:read_sousrubriquecontrole.html.twig', 
        array('sousrubriquecontroles'   => $sousrubriquecontroles,'menu_num'=> 1));
    }
    
    public function create_sousrubriquecontroleAction()
    {
        $newsousrubriquecontrole = new SousRubriqueControle;
        $form = $this->createForm(new SousRubriqueControleType, $newsousrubriquecontrole);   
        $request = $this->get('request');
        if ($request->getMethod() == 'POST') 
        {
            $form->bind($request);
            if ($form->isValid()) 
            {
                $em = $this->getDoctrine()->getManager(); 
                $user = $this->getUser();
                $newsousrubriquecontrole->setLoginCreate($user->getUsername());
                $newsousrubriquecontrole->setEstsupprimer(false);
                $em->persist($newsousrubriquecontrole);
                $em->flush();
                //return $this->redirect( $this->generateUrl('read_sousrubriquecontrole'));
            }
        }
        return $this->render('BZBlogBundle:SousRubriqueControle:create_sousrubriquecontrole.html.twig', 
        array('form'   => $form->createView(),'menu_num'=> 1));
    }
    public function update_sousrubriquecontroleAction($id)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository("BZBlogBundle:SousRubriqueControle");
        $newsousrubriquecontrole=$repository->findOneBy(array('id' => $id));
        $form = $this->createForm(new SousRubriqueControleType, $newsousrubriquecontrole);   
        $request = $this->get('request');
        if ($request->getMethod() == 'POST') 
        {
            $form->bind($request);
            if ($form->isValid()) 
            {
                $em = $this->getDoctrine()->getManager(); 
                $user = $this->getUser();
                $newsousrubriquecontrole->setLoginUpdate($user->getUsername());
                $em->flush();
                //return $this->redirect( $this->generateUrl('read_sousrubriquecontrole'));
            }
        }
        return $this->render('BZBlogBundle:SousRubriqueControle:update_sousrubriquecontrole.html.twig', 
        array('form'=> $form->createView(), 'menu_num'=> 1, 'id'=> $id));
    }
    public function delete_sousrubriquecontroleAction($id)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository("BZBlogBundle:SousRubriqueControle");
        $newsousrubriquecontrole=$repository->findOneBy(array('id' => $id)); 
        $request = $this->get('request');
        if ($request->getMethod() == 'POST') 
        {
            
                $em = $this->getDoctrine()->getManager(); 
                $user = $this->getUser();
                $newsousrubriquecontrole->setLoginDelete($user->getUsername());
                $newsousrubriquecontrole->setEstsupprimer(true);
                $newsousrubriquecontrole->setDatedelete(new \Datetime());
                $em->flush();
              
        }
        return $this->render('BZBlogBundle:SousRubriqueControle:delete_sousrubriquecontrole.html.twig', 
        array('menu_num'=> 1, 'id'=> $id, 'sousrubriquecontrole'=> $newsousrubriquecontrole->getLibelle()));
    }
    
   public function print_sousrubriquecontroleAction()
    {
            $exos= $this->getDoctrine()
                                      ->getManager()->getRepository('BZBlogBundle:SousRubriqueControle')
                                      ->findBy(Array('estsupprimer'=>false),Array('libelle'=>'ASC'));
             //on stocke la vue à convertir en PDF, en n'oubliant pas les paramètres twig si la vue comporte des données dynamiques
            $html = $this->renderView('BZBlogBundle:SousRubriqueControle:print_sousrubriquecontrole.html.twig', array( 'sousrubriquecontroles' => $exos));
            //on appelle le service html1pdf
            $html1pdf = $this->get('html2pdf_factory')->create();
            $html1pdf->setTestTdInOnePage(false);
            //real : utilise la taille réelle
            $html1pdf->pdf->SetDisplayMode('real');
            //writeHTML va tout simplement prendre la vue stocker dans la variable $html pour la convertir en format PDF
            $html1pdf->writeHTML($html);
            //Output envoit le document PDF au navigateur internet
            return new Response($html1pdf->Output('Liste_des_sousrubriquecontroles_activite.pdf'), 100, array('Content-Type' => 'application/pdf'));
                       
    }
  
}
