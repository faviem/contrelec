<?php

// src/BZ/BlogBundle/Controller/BlogController.php
namespace BZ\BlogBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityRepository;
use BZ\BlogBundle\Entity\NiveauAlerte;
use BZ\BlogBundle\Form\NiveauAlerteType;
use Symfony\Component\HttpFoundation\Response;

class NiveauAlerteController  extends Controller
{
    public function read_niveaualerteAction()
    {
        $niveaualertes=$this->getDoctrine()->getManager()->getRepository("BZBlogBundle:NiveauAlerte")->findBy(array('estsupprimer' => false));
        
        return $this->render('BZBlogBundle:NiveauAlerte:read_niveaualerte.html.twig', 
        array('niveaualertes'   => $niveaualertes,'menu_num'=> 1));
    }
    
    public function create_niveaualerteAction()
    {
        $newniveaualerte = new NiveauAlerte;
        $form = $this->createForm(new NiveauAlerteType, $newniveaualerte);   
        $request = $this->get('request');
        if ($request->getMethod() == 'POST') 
        {
            $form->bind($request);
            if ($form->isValid()) 
            {
                $em = $this->getDoctrine()->getManager(); 
                $user = $this->getUser();
                $newniveaualerte->setLoginCreate($user->getUsername());
                $newniveaualerte->setEstsupprimer(false);
                $em->persist($newniveaualerte);
                $em->flush();
                //return $this->redirect( $this->generateUrl('read_niveaualerte'));
            }
        }
        return $this->render('BZBlogBundle:NiveauAlerte:create_niveaualerte.html.twig', 
        array('form'   => $form->createView(),'menu_num'=> 1));
    }
    public function update_niveaualerteAction($id)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository("BZBlogBundle:NiveauAlerte");
        $newniveaualerte=$repository->findOneBy(array('id' => $id));
        $form = $this->createForm(new NiveauAlerteType, $newniveaualerte);   
        $request = $this->get('request');
        if ($request->getMethod() == 'POST') 
        {
            $form->bind($request);
            if ($form->isValid()) 
            {
                $em = $this->getDoctrine()->getManager(); 
                $user = $this->getUser();
                $newniveaualerte->setLoginUpdate($user->getUsername());
                $em->flush();
                //return $this->redirect( $this->generateUrl('read_niveaualerte'));
            }
        }
        return $this->render('BZBlogBundle:NiveauAlerte:update_niveaualerte.html.twig', 
        array('form'=> $form->createView(), 'menu_num'=> 1, 'id'=> $id));
    }
    public function delete_niveaualerteAction($id)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository("BZBlogBundle:NiveauAlerte");
        $newniveaualerte=$repository->findOneBy(array('id' => $id)); 
        $request = $this->get('request');
        if ($request->getMethod() == 'POST') 
        {
            
                $em = $this->getDoctrine()->getManager(); 
                $user = $this->getUser();
                $newniveaualerte->setLoginDelete($user->getUsername());
                $newniveaualerte->setEstsupprimer(true);
                $newniveaualerte->setDatedelete(new \Datetime());
                $em->flush();
              
        }
        return $this->render('BZBlogBundle:NiveauAlerte:delete_niveaualerte.html.twig', 
        array('menu_num'=> 1, 'id'=> $id, 'niveaualerte'=> $newniveaualerte->getLibelle()));
    }
    
    public function print_niveaualerteAction()
    {
            $niveaux= $this->getDoctrine()
                                      ->getManager()->getRepository('BZBlogBundle:NiveauAlerte')
                                      ->findBy(Array('estsupprimer'=>false),Array('libelle'=>'ASC'));
             //on stocke la vue à convertir en PDF, en n'oubliant pas les paramètres twig si la vue comporte des données dynamiques
            $html = $this->renderView('BZBlogBundle:NiveauAlerte:print_niveaualerte.html.twig', array( 'niveaux' => $niveaux));
            //on appelle le service html1pdf
            $html1pdf = $this->get('html1pdf_factory')->create();
            $html1pdf->setTestTdInOnePage(false);
            //real : utilise la taille réelle
            $html1pdf->pdf->SetDisplayMode('real');
            //writeHTML va tout simplement prendre la vue stocker dans la variable $html pour la convertir en format PDF
            $html1pdf->writeHTML($html);
            //Output envoit le document PDF au navigateur internet
            return new Response($html1pdf->Output('Liste_des_niveaualerte.pdf'), 100, array('Content-Type' => 'application/pdf'));
                       
    }
    
}
