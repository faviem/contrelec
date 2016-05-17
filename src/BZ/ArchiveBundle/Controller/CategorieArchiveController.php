<?php

// src/BZ/ArchiveBundle/Controller/ArchiveController.php
namespace BZ\ArchiveBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityRepository;
use BZ\ArchiveBundle\Entity\CategorieArchive;
use BZ\ArchiveBundle\Form\CategorieArchiveType;
use Symfony\Component\HttpFoundation\Response;

class CategorieArchiveController   extends Controller
{
    public function read_categoriearchiveAction()
    {
        $categoriearchives=$this->getDoctrine()->getManager()->getRepository("BZArchiveBundle:CategorieArchive")->findBy(array('estsupprimer' => false));
        
        return $this->render('BZArchiveBundle:CategorieArchive:read_categoriearchive.html.twig', 
        array('categoriearchives'   => $categoriearchives,'menu_num'=> 1));
    }
    
    public function create_categoriearchiveAction()
    {
        $newcategoriearchive = new CategorieArchive;
        $form = $this->createForm(new CategorieArchiveType, $newcategoriearchive);   
        $request = $this->get('request');
        if ($request->getMethod() == 'POST') 
        {
            $form->bind($request);
            if ($form->isValid()) 
            {
                $em = $this->getDoctrine()->getManager(); 
                $user = $this->getUser();
                $newcategoriearchive->setLoginCreate($user->getUsername());
                $newcategoriearchive->setEstsupprimer(false);
                $em->persist($newcategoriearchive);
                $em->flush();
                //return $this->redirect( $this->generateUrl('read_categoriearchive'));
            }
        }
        return $this->render('BZArchiveBundle:CategorieArchive:create_categoriearchive.html.twig', 
        array('form'   => $form->createView(),'menu_num'=> 1));
    }
    public function update_categoriearchiveAction($id)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository("BZArchiveBundle:CategorieArchive");
        $newcategoriearchive=$repository->findOneBy(array('id' => $id));
        $form = $this->createForm(new CategorieArchiveType, $newcategoriearchive);   
        $request = $this->get('request');
        if ($request->getMethod() == 'POST') 
        {
            $form->bind($request);
            if ($form->isValid()) 
            {
                $em = $this->getDoctrine()->getManager(); 
                $user = $this->getUser();
                $newcategoriearchive->setLoginUpdate($user->getUsername());
                $em->flush();
                //return $this->redirect( $this->generateUrl('read_categoriearchive'));
            }
        }
        return $this->render('BZArchiveBundle:CategorieArchive:update_categoriearchive.html.twig', 
        array('form'=> $form->createView(), 'menu_num'=> 1, 'id'=> $id));
    }
    public function delete_categoriearchiveAction($id)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository("BZArchiveBundle:CategorieArchive");
        $newcategoriearchive=$repository->findOneBy(array('id' => $id)); 
        $request = $this->get('request');
        if ($request->getMethod() == 'POST') 
        {
            
                $em = $this->getDoctrine()->getManager(); 
                $user = $this->getUser();
                $newcategoriearchive->setLoginDelete($user->getUsername());
                $newcategoriearchive->setEstsupprimer(true);
                $newcategoriearchive->setDatedelete(new \Datetime());
                $em->flush();
              
        }
        return $this->render('BZArchiveBundle:CategorieArchive:delete_categoriearchive.html.twig', 
        array('menu_num'=> 1, 'id'=> $id, 'categoriearchive'=> $newcategoriearchive->getLibelle()));
    }
    
    public function print_categoriearchiveAction()
    {
            $categories= $this->getDoctrine()
                                      ->getManager()->getRepository('BZArchiveBundle:CategorieArchive')
                                      ->findBy(Array('estsupprimer'=>false),Array('libelle'=>'ASC'));
             //on stocke la vue à convertir en PDF, en n'oubliant pas les paramètres twig si la vue comporte des données dynamiques
            $html = $this->renderView('BZArchiveBundle:CategorieArchive:print_categoriearchive.html.twig', array( 'categories' => $categories));
            //on appelle le service html1pdf
            $html1pdf = $this->get('html1pdf_factory')->create();
            $html1pdf->setTestTdInOnePage(false);
            //real : utilise la taille réelle
            $html1pdf->pdf->SetDisplayMode('real');
            //writeHTML va tout simplement prendre la vue stocker dans la variable $html pour la convertir en format PDF
            $html1pdf->writeHTML($html);
            //Output envoit le document PDF au navigateur internet
            return new Response($html1pdf->Output('Liste_des_categories.pdf'), 100, array('Content-Type' => 'application/pdf'));
                       
    }
}
