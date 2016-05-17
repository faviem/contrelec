<?php

// src/BZ/BlogBundle/Controller/BlogController.php
namespace BZ\BlogBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Doctrine\ORM\EntityRepository;
use BZ\BlogBundle\Entity\RubriqueFinance;
use BZ\BlogBundle\Form\RubriqueFinanceType;
use Symfony\Component\HttpFoundation\Response;

class RubriqueFinanceController  extends Controller
{
    public function read_rubriquefinanceAction()
    {
        $rubriquefinances=$this->getDoctrine()->getManager()->getRepository("BZBlogBundle:RubriqueFinance")->findBy(array('estsupprimer' => false));
        
        return $this->render('BZBlogBundle:RubriqueFinance:read_rubriquefinance.html.twig', 
        array('rubriquefinances'   => $rubriquefinances,'menu_num'=> 1));
    }
    
    public function create_rubriquefinanceAction()
    {
        $newrubriquefinance = new RubriqueFinance;
        $form = $this->createForm(new RubriqueFinanceType, $newrubriquefinance);   
        $request = $this->get('request');
        if ($request->getMethod() == 'POST') 
        {
            $form->bind($request);
            if ($form->isValid()) 
            {
                $em = $this->getDoctrine()->getManager(); 
                $user = $this->getUser();
                $newrubriquefinance->setLoginCreate($user->getUsername());
                $newrubriquefinance->setEstsupprimer(false);
                $em->persist($newrubriquefinance);
                $em->flush();
                //return $this->redirect( $this->generateUrl('read_rubriquefinance'));
            }
        }
        return $this->render('BZBlogBundle:RubriqueFinance:create_rubriquefinance.html.twig', 
        array('form'   => $form->createView(),'menu_num'=> 1));
    }
    public function update_rubriquefinanceAction($id)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository("BZBlogBundle:RubriqueFinance");
        $newrubriquefinance=$repository->findOneBy(array('id' => $id));
        $form = $this->createForm(new RubriqueFinanceType, $newrubriquefinance);   
        $request = $this->get('request');
        if ($request->getMethod() == 'POST') 
        {
            $form->bind($request);
            if ($form->isValid()) 
            {
                $em = $this->getDoctrine()->getManager(); 
                $user = $this->getUser();
                $newrubriquefinance->setLoginUpdate($user->getUsername());
                $em->flush();
                //return $this->redirect( $this->generateUrl('read_rubriquefinance'));
            }
        }
        return $this->render('BZBlogBundle:RubriqueFinance:update_rubriquefinance.html.twig', 
        array('form'=> $form->createView(), 'menu_num'=> 1, 'id'=> $id));
    }
    public function delete_rubriquefinanceAction($id)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository("BZBlogBundle:RubriqueFinance");
        $newrubriquefinance=$repository->findOneBy(array('id' => $id)); 
        $request = $this->get('request');
        if ($request->getMethod() == 'POST') 
        {
            
                $em = $this->getDoctrine()->getManager(); 
                $user = $this->getUser();
                $newrubriquefinance->setLoginDelete($user->getUsername());
                $newrubriquefinance->setEstsupprimer(true);
                $newrubriquefinance->setDatedelete(new \Datetime());
                $em->flush();
              
        }
        return $this->render('BZBlogBundle:RubriqueFinance:delete_rubriquefinance.html.twig', 
        array('menu_num'=> 1, 'id'=> $id, 'rubriquefinance'=> $newrubriquefinance->getLibelle()));
    }
    
   public function print_rubriquefinanceAction()
    {
            $exos= $this->getDoctrine()
                                      ->getManager()->getRepository('BZBlogBundle:RubriqueFinance')
                                      ->findBy(Array('estsupprimer'=>false),Array('libelle'=>'ASC'));
             //on stocke la vue à convertir en PDF, en n'oubliant pas les paramètres twig si la vue comporte des données dynamiques
            $html = $this->renderView('BZBlogBundle:RubriqueFinance:print_rubriquefinance.html.twig', array( 'rubriquefinances' => $exos));
            //on appelle le service html1pdf
            $html1pdf = $this->get('html2pdf_factory')->create();
            $html1pdf->setTestTdInOnePage(false);
            //real : utilise la taille réelle
            $html1pdf->pdf->SetDisplayMode('real');
            //writeHTML va tout simplement prendre la vue stocker dans la variable $html pour la convertir en format PDF
            $html1pdf->writeHTML($html);
            //Output envoit le document PDF au navigateur internet
            return new Response($html1pdf->Output('Liste_des_rubriquefinances_activite.pdf'), 100, array('Content-Type' => 'application/pdf'));
                       
    }
  
}
