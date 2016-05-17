<?php

// src/BZ/BlogBundle/Controller/BlogController.php
namespace BZ\BlogBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityRepository;
use BZ\BlogBundle\Entity\ObjetClassement;
use BZ\BlogBundle\Form\ObjetClassementType;
use Symfony\Component\HttpFoundation\Response;

class ObjetClassementController  extends Controller
{
    public function read_objetclassementAction()
    {
        $objetclassements=$this->getDoctrine()->getManager()->getRepository("BZBlogBundle:ObjetClassement")->findBy(array('estsupprimer' => false));
        
        return $this->render('BZBlogBundle:ObjetClassement:read_objetclassement.html.twig', 
        array('objetclassements'   => $objetclassements,'menu_num'=> 1));
    }
    
    public function create_objetclassementAction()
    {
        $newobjetclassement = new ObjetClassement;
        $form = $this->createForm(new ObjetClassementType, $newobjetclassement);   
        $request = $this->get('request');
        if ($request->getMethod() == 'POST') 
        {
            $form->bind($request);
            if ($form->isValid()) 
            {
                $em = $this->getDoctrine()->getManager(); 
                $user = $this->getUser();
                $newobjetclassement->setLoginCreate($user->getUsername());
                $newobjetclassement->setEstsupprimer(false);
                $em->persist($newobjetclassement);
                $em->flush();
                //return $this->redirect( $this->generateUrl('read_objetclassement'));
            }
        }
        return $this->render('BZBlogBundle:ObjetClassement:create_objetclassement.html.twig', 
        array('form'   => $form->createView(),'menu_num'=> 1));
    }
    public function update_objetclassementAction($id)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository("BZBlogBundle:ObjetClassement");
        $newobjetclassement=$repository->findOneBy(array('id' => $id));
        $form = $this->createForm(new ObjetClassementType, $newobjetclassement);   
        $request = $this->get('request');
        if ($request->getMethod() == 'POST') 
        {
            $form->bind($request);
            if ($form->isValid()) 
            {
                $em = $this->getDoctrine()->getManager(); 
                $user = $this->getUser();
                $newobjetclassement->setLoginUpdate($user->getUsername());
                $em->flush();
                //return $this->redirect( $this->generateUrl('read_objetclassement'));
            }
        }
        return $this->render('BZBlogBundle:ObjetClassement:update_objetclassement.html.twig', 
        array('form'=> $form->createView(), 'menu_num'=> 1, 'id'=> $id));
    }
    public function delete_objetclassementAction($id)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository("BZBlogBundle:ObjetClassement");
        $newobjetclassement=$repository->find($id); 
        $request = $this->get('request');
        if ($request->getMethod() == 'POST') 
        {
            
                $em = $this->getDoctrine()->getManager(); 
                $user = $this->getUser();
                $newobjetclassement->setLoginDelete($user->getUsername());
                $newobjetclassement->setEstsupprimer(true);
                $newobjetclassement->setDatedelete(new \Datetime());
                $em->flush();
        }
        return $this->render('BZBlogBundle:ObjetClassement:delete_objetclassement.html.twig', 
        array('menu_num'=> 1, 'id'=> $id, 'objetclassement'=> 'Référence : '.$newobjetclassement->getRef().' ;  Lieu : '.$newobjetclassement->getLieustockage()));
    }
    
    public function print_objetclassementAction()
    {
            $objetclassements= $this->getDoctrine()
                                      ->getManager()->getRepository('BZBlogBundle:ObjetClassement')
                                      ->findBy(Array('estsupprimer'=>false),Array('lieustockage'=>'ASC'));
             //on stocke la vue à convertir en PDF, en n'oubliant pas les paramètres twig si la vue comporte des données dynamiques
            $html = $this->renderView('BZBlogBundle:ObjetClassement:print_objetclassement.html.twig', array( 'objets' => $objetclassements));
            //on appelle le service html1pdf
            $html1pdf = $this->get('html2pdf_factory')->create();
            $html1pdf->setTestTdInOnePage(false);
            //real : utilise la taille réelle
            $html1pdf->pdf->SetDisplayMode('real');
            //writeHTML va tout simplement prendre la vue stocker dans la variable $html pour la convertir en format PDF
            $html1pdf->writeHTML($html);
            //Output envoit le document PDF au navigateur internet
            return new Response($html1pdf->Output('Liste_des_objets_classement.pdf'), 100, array('Content-Type' => 'application/pdf'));
                       
    }
  
}
