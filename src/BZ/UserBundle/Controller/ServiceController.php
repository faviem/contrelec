<?php

// src/BZ/UserBundle/Controller/UserController.php
namespace BZ\UserBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityRepository;
use BZ\UserBundle\Entity\Service;
use BZ\UserBundle\Form\ServiceType;
use Symfony\Component\HttpFoundation\Response;

class ServiceController  extends Controller
{
   public function read_serviceAction()
    {
        $services=$this->getDoctrine()->getManager()->getRepository("BZUserBundle:Service")->findBy(array('estsupprimer' => false));
        
        return $this->render('BZUserBundle:Service:read_service.html.twig', 
        array('services'   => $services,'menu_num'=> 2));
    }
    
    public function create_serviceAction()
    {
        $newservice = new Service;
        $form = $this->createForm(new ServiceType, $newservice);   
        $request = $this->get('request');
        if ($request->getMethod() == 'POST') 
        {
            $form->bind($request);
            if ($form->isValid()) 
            {
                $em = $this->getDoctrine()->getManager(); 
                $user = $this->getUser();
                $newservice->setLoginCreate($user->getUsername());
                $newservice->setEstsupprimer(false);
                $em->persist($newservice);
                $em->flush();
                //return $this->redirect( $this->generateUrl('read_service'));
            }
        }
        return $this->render('BZUserBundle:Service:create_service.html.twig', 
        array('form'   => $form->createView(),'menu_num'=> 2));
    }
    public function update_serviceAction($id)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository("BZUserBundle:Service");
        $newservice=$repository->findOneBy(array('id' => $id));
        $form = $this->createForm(new ServiceType, $newservice);   
        $request = $this->get('request');
        if ($request->getMethod() == 'POST') 
        {
            $form->bind($request);
            if ($form->isValid()) 
            {
                $em = $this->getDoctrine()->getManager(); 
                $user = $this->getUser();
                $newservice->setLoginUpdate($user->getUsername());
                $em->flush();
                //return $this->redirect( $this->generateUrl('read_service'));
            }
        }
        return $this->render('BZUserBundle:Service:update_service.html.twig', 
        array('form'=> $form->createView(), 'menu_num'=> 2, 'id'=> $id));
    }
    public function delete_serviceAction($id)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository("BZUserBundle:Service");
        $newservice=$repository->findOneBy(array('id' => $id)); 
        $request = $this->get('request');
        if ($request->getMethod() == 'POST') 
        {
            
                $em = $this->getDoctrine()->getManager(); 
                $user = $this->getUser();
                $newservice->setLoginDelete($user->getUsername());
                $newservice->setEstsupprimer(true);
                $newservice->setDatedelete(new \Datetime());
                $em->flush();
              
        }
        return $this->render('BZUserBundle:Service:delete_service.html.twig', 
        array('menu_num'=> 2, 'id'=> $id, 'service'=> $newservice->getDenomination()));
    }
    
    public function print_serviceAction()
    {
            $services= $this->getDoctrine()
                                      ->getManager()->getRepository('BZUserBundle:Service')
                                      ->findBy(Array('estsupprimer'=>false),Array('denomination'=>'ASC'));
             //on stocke la vue à convertir en PDF, en n'oubliant pas les paramètres twig si la vue comporte des données dynamiques
            $html = $this->renderView('BZUserBundle:Service:print_service.html.twig', array( 'services' => $services));
            //on appelle le service html2pdf
            $html2pdf = $this->get('html2pdf_factory')->create();
            $html2pdf->setTestTdInOnePage(false);
            //real : utilise la taille réelle
            $html2pdf->pdf->SetDisplayMode('real');
            //writeHTML va tout simplement prendre la vue stocker dans la variable $html pour la convertir en format PDF
            $html2pdf->writeHTML($html);
            //Output envoit le document PDF au navigateur internet
            return new Response($html2pdf->Output('Liste_des_services_directions.pdf'), 200, array('Content-Type' => 'application/pdf'));
                       
    }
    
}
