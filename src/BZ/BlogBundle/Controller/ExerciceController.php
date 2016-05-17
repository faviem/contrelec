<?php

// src/BZ/BlogBundle/Controller/BlogController.php
namespace BZ\BlogBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Doctrine\ORM\EntityRepository;
use BZ\BlogBundle\Entity\Exercice;
use BZ\BlogBundle\Form\ExerciceType;
use Symfony\Component\HttpFoundation\Response;

class ExerciceController  extends Controller
{
    public function read_exerciceAction()
    {
  
          
        $exercices=$this->getDoctrine()->getManager()->getRepository("BZBlogBundle:Exercice")->findBy(array('estsupprimer' => false));
        
        return $this->render('BZBlogBundle:Exercice:read_exercice.html.twig', 
        array('exercices'   => $exercices,'menu_num'=> 1));
    }
    
    public function create_exerciceAction()
    {
        $newexercice = new Exercice;
        $form = $this->createForm(new ExerciceType, $newexercice);   
        $request = $this->get('request');
        if ($request->getMethod() == 'POST') 
        {
            $form->bind($request);
            if ($form->isValid()) 
            {
                $em = $this->getDoctrine()->getManager(); 
                $user = $this->getUser();
                $newexercice->setLoginCreate($user->getUsername());
                $newexercice->setEstsupprimer(false);
                $em->persist($newexercice);
                $em->flush();
                //return $this->redirect( $this->generateUrl('read_exercice'));
            }
        }
        return $this->render('BZBlogBundle:Exercice:create_exercice.html.twig', 
        array('form'   => $form->createView(),'menu_num'=> 1));
    }
    public function update_exerciceAction($id)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository("BZBlogBundle:Exercice");
        $newexercice=$repository->findOneBy(array('id' => $id));
        $form = $this->createForm(new ExerciceType, $newexercice);   
        $request = $this->get('request');
        if ($request->getMethod() == 'POST') 
        {
            $form->bind($request);
            if ($form->isValid()) 
            {
                $em = $this->getDoctrine()->getManager(); 
                $user = $this->getUser();
                $newexercice->setLoginUpdate($user->getUsername());
                $em->flush();
                //return $this->redirect( $this->generateUrl('read_exercice'));
            }
        }
        return $this->render('BZBlogBundle:Exercice:update_exercice.html.twig', 
        array('form'=> $form->createView(), 'menu_num'=> 1, 'id'=> $id));
    }
    public function delete_exerciceAction($id)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository("BZBlogBundle:Exercice");
        $newexercice=$repository->findOneBy(array('id' => $id)); 
        $request = $this->get('request');
        if ($request->getMethod() == 'POST') 
        {
            
                $em = $this->getDoctrine()->getManager(); 
                $user = $this->getUser();
                $newexercice->setLoginDelete($user->getUsername());
                $newexercice->setEstsupprimer(true);
                $newexercice->setDatedelete(new \Datetime());
                $em->flush();
              
        }
        return $this->render('BZBlogBundle:Exercice:delete_exercice.html.twig', 
        array('menu_num'=> 1, 'id'=> $id, 'exercice'=> $newexercice->getAnnee()));
    }
    
   public function print_exerciceAction()
    {
            $exos= $this->getDoctrine()
                                      ->getManager()->getRepository('BZBlogBundle:Exercice')
                                      ->findBy(Array('estsupprimer'=>false),Array('annee'=>'ASC'));
             //on stocke la vue à convertir en PDF, en n'oubliant pas les paramètres twig si la vue comporte des données dynamiques
            $html = $this->renderView('BZBlogBundle:Exercice:print_exercice.html.twig', array( 'exercices' => $exos));
            //on appelle le service html1pdf
            $html1pdf = $this->get('html2pdf_factory')->create();
            $html1pdf->setTestTdInOnePage(false);
            //real : utilise la taille réelle
            $html1pdf->pdf->SetDisplayMode('real');
            //writeHTML va tout simplement prendre la vue stocker dans la variable $html pour la convertir en format PDF
            $html1pdf->writeHTML($html);
            //Output envoit le document PDF au navigateur internet
            return new Response($html1pdf->Output('Liste_des_exercices_activite.pdf'), 100, array('Content-Type' => 'application/pdf'));
                       
    }
  
}
