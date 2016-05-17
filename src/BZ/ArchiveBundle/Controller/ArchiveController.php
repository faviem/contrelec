<?php

// src/BZ/ArchiveBundle/Controller/ArchiveController.php
namespace BZ\ArchiveBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityRepository;
use BZ\ArchiveBundle\Entity\Archive;
use BZ\ArchiveBundle\Form\ArchiveType;

class ArchiveController  extends Controller
{
   public function read_archiveAction($exercice)
    {
        $archives=$this->getDoctrine()->getManager()
                ->getRepository("BZArchiveBundle:Archive")
                ->findBy(array('estsupprimer' => false,'exercice' => $exercice,'user' => $this->getUser()->getId()));
        $getExercices=$this->getDoctrine()->getManager()
                ->getRepository("BZBlogBundle:Exercice")->findBy(array('estsupprimer' => false));
        return $this->render('BZArchiveBundle:Archive:read_archive.html.twig', 
        array('archives'   => $archives,'menu_num'=> 3,'exercice'=> $exercice,'getExercices'=> $getExercices));
    }
    
    public function nouvel_archiveAction()
    {
        $newarchive = new Archive;
        $form = $this->createForm(new ArchiveType, $newarchive);   
        $request = $this->get('request');
        if ($request->getMethod() == 'POST') 
        {
            $form->bind($request);
            if ($form->isValid()) 
            {
                $em = $this->getDoctrine()->getManager(); 
                $user = $this->getUser();
                $newarchive->setLoginCreate($user->getUsername());
                $newarchive->setEstsupprimer(false);
                $newarchive->setUser($user);
                $em->persist($newarchive);
                $em->flush();
                $idarchive=$newarchive->getId();
                
                //fin d'envoi d'email
                return $this->redirect( $this->generateUrl('etape_suivante', array('id'   =>$idarchive)));
           
            }
        }
        return $this->render('BZArchiveBundle:Archive:nouvel_archive.html.twig', 
        array('form'   => $form->createView(),'menu_num'=> 3,'exercice'=> 0,'categorie'=> 0));
    }
    
    public function etape_suivanteAction($id)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository("BZArchiveBundle:Archive");
        $archive=$repository->find($id);
          
        $request = $this->get('request');
        if ($request->getMethod() == 'POST') 
        {
                //fin d'envoi d'email
                return $this->redirect( $this->generateUrl('read_archive', array('exercice'   =>$archive->getExercice()->getId())));
       }
        return $this->render('BZArchiveBundle:Archive:etape_suivante.html.twig', 
        array('menu_num'=> 3,'id'=> $id,'archive'=> $archive));
    }
    
    public function etape_suivante_modifAction($id)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository("BZArchiveBundle:Archive");
        $archive=$repository->find($id);
          
        $request = $this->get('request');
        if ($request->getMethod() == 'POST') 
        {
                //fin d'envoi d'email
                return $this->redirect( $this->generateUrl('read_archive', array('exercice'   =>$archive->getExercice()->getId())));
       }
        return $this->render('BZArchiveBundle:Archive:etape_suivante_modif.html.twig', 
        array('menu_num'=> 3,'id'=> $id,'archive'=> $archive));
    }
    
    public function update_archiveAction($id)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository("BZArchiveBundle:Archive");
        $newarchive=$repository->findOneBy(array('id' => $id));
        
        $form = $this->createForm(new ArchiveType, $newarchive);   
        $request = $this->get('request');
        if ($request->getMethod() == 'POST') 
        {
            $form->bind($request);
            if ($form->isValid()) 
            {
                $em = $this->getDoctrine()->getManager(); 
                $user = $this->getUser();
                $newarchive->setLoginUpdate($user->getUsername());
                $em->flush();
                return $this->redirect( $this->generateUrl('etape_suivante_modif', array('id'   =>$id)));
              }
        }
        return $this->render('BZArchiveBundle:Archive:update_archive.html.twig', 
        array('form'=> $form->createView(), 'menu_num'=> 3, 'id'=> $id));
    }
    
    public function delete_archiveAction($id)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository("BZArchiveBundle:Archive");
                $newarchive=$repository->findOneBy(array('id' => $id)); 
        $exercice=$newarchive->getExercice()->getId();
       $request = $this->get('request');
       if ($request->getMethod() == 'POST') 
        {
                $em = $this->getDoctrine()->getManager();
                foreach ($newarchive->getDocumentarchives() as $doc) {
                    $em->remove($doc);
                }
                foreach ($newarchive->getVisibilitearchives() as $vis) {
                    $em->remove($vis);
                }
                $em->remove($newarchive);
                $em->flush();
                return $this->redirect($this->generateUrl('read_archive', array('exercice' => $exercice)));
        }
        return $this->render('BZArchiveBundle:Archive:delete_archive.html.twig', 
        array('menu_num'=> 5,'id'=> $id,'archive'=> $newarchive,'exercice' => $exercice));
    }
    
    public function detail_archiveAction($id)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository("BZArchiveBundle:Archive");
        $newarchive=$repository->find($id); 

        return $this->render('BZArchiveBundle:Archive:detail_archive.html.twig', 
        array('menu_num'=> 3, 'id'=> $id, 'archive'=> $newarchive));
    }
    
}
