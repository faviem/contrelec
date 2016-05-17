<?php

// src/BZ/ArchiveBundle/Controller/ArchiveController.php
namespace BZ\ArchiveBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityRepository;
use BZ\ArchiveBundle\Entity\VisibiliteArchive;

class VisibiliteArchiveController   extends Controller
{
    
    public function visible_directionAction($id)
    {
         $services=$this->getDoctrine()->getManager()->getRepository("BZUserBundle:Service")->findBy(array('estsupprimer' => false));
        
        $request = $this->get('request');
        if ($request->getMethod() == 'POST') 
        {
                $em = $this->getDoctrine()->getManager(); 
                $archive = $em->getRepository("BZArchiveBundle:Archive")->find($id);
                 foreach ($archive->getVisibilitearchives() as $vis) {
                    $em->remove($vis);
                }
                $em->flush();
                $users=$em->getRepository("BZUserBundle:User")->findBy(array('service' => $_POST['service'], 'enabled' => true,'locked' => false));
               foreach ($users as $user){
                    if($user->getId() != $this->getUser()->getId())
                    {
                    $visible = new VisibiliteArchive;
                    $visible->setArchive($archive);
                    $visible->setUser($user);
                    $visible->setEstestlu(false);
                     $em->persist($visible);
                     $em->flush();
                    }
                }
                $em->flush();
                return $this->redirect( $this->generateUrl('etape_suivante', array('id'   =>$id))); 
         }
        return $this->render('BZArchiveBundle:VisibiliteArchive:visible_direction.html.twig', 
        array('menu_num'=> 3,'id'=> $id,'services'=> $services));
    }
    
    public function visible_personnelAction($id)
    {
         
        $request = $this->get('request');
        if ($request->getMethod() == 'POST') 
        {
                $em = $this->getDoctrine()->getManager(); 
                $archive = $em->getRepository("BZArchiveBundle:Archive")->find($id);
                 foreach ($archive->getVisibilitearchives() as $vis) {
                    $em->remove($vis);
                }
                $em->flush();
                $users=$em->getRepository("BZUserBundle:User")->findBy(array('enabled' => true,'locked' => false));
                foreach ($users as $user){
                    if($user->getId() != $this->getUser()->getId())
                    {
                    $visible = new VisibiliteArchive;
                    $visible->setArchive($archive);
                    $visible->setUser($user);
                    $visible->setEstestlu(false);
                     $em->persist($visible);
                     $em->flush();
                    }
                }
                $em->flush();
                return $this->redirect( $this->generateUrl('etape_suivante', array('id'   =>$id))); 
         }
        return $this->render('BZArchiveBundle:VisibiliteArchive:visible_personnel.html.twig', 
        array('menu_num'=> 3,'id'=> $id));
    }
    
    public function visible_agentsAction($id)
    {
        
        $users=$this->getDoctrine()->getManager()->getRepository("BZUserBundle:User")->findBy(array('enabled' => true,'locked' => false));
        $request = $this->get('request');
        if ($request->getMethod() == 'POST') 
        {
                $em = $this->getDoctrine()->getManager(); 
                $archive = $em->getRepository("BZArchiveBundle:Archive")->find($id);
                 foreach ($archive->getVisibilitearchives() as $vis) {
                    $em->remove($vis);
                }
                $em->flush();
                foreach ($_POST['user'] as $user){
                    
                    $leuser=$this->getDoctrine()->getManager()->getRepository("BZUserBundle:User")->find($user);
        
                    $visible = new VisibiliteArchive;
                    $visible->setArchive($archive);
                    $visible->setUser($leuser);
                    $visible->setEstestlu(false);
                     $em->persist($visible);
                     $em->flush();
                }
                return $this->redirect( $this->generateUrl('etape_suivante', array('id'   =>$id))); 
         }
        return $this->render('BZArchiveBundle:VisibiliteArchive:visible_agents.html.twig', 
        array('menu_num'=> 3,'id'=> $id,'users'=> $users));
    }
    
    public function visible_annuletoutAction($id)
    {
              $em = $this->getDoctrine()->getManager(); 
                $archive = $em->getRepository("BZArchiveBundle:Archive")->find($id);
                 foreach ($archive->getVisibilitearchives() as $vis) {
                    $em->remove($vis);
                }
                $em->flush();
            return $this->redirect( $this->generateUrl('etape_suivante', array('id'   =>$id))); 
    }
    
    public function visible_annuleAction($id,$idvisible)
    {
              $em = $this->getDoctrine()->getManager(); 
                $visible= $em->getRepository("BZArchiveBundle:VisibiliteArchive")->find($idvisible);
                $em->remove($visible);
                $em->flush();
            return $this->redirect( $this->generateUrl('etape_suivante', array('id'   =>$id))); 
    }
    
    public function detail_archiverecuAction($id,$idvisible)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository("BZArchiveBundle:Archive");
        $newarchive=$repository->find($id); 
        $em = $this->getDoctrine()->getManager(); 
        $visible= $em->getRepository("BZArchiveBundle:VisibiliteArchive")->find($idvisible);
        $visible->setEstestlu(true);
        $em->flush();
        return $this->render('BZArchiveBundle:Archive:detail_archive.html.twig', 
        array('menu_num'=> 3, 'id'=> $id, 'archive'=> $newarchive));
    }
    
     public function read_visibiliteAction()
    {
        $archives=$this->getDoctrine()->getManager()
                ->getRepository("BZArchiveBundle:VisibiliteArchive")
                ->findBy(array('user' => $this->getUser()->getId()));
        
        return $this->render('BZArchiveBundle:VisibiliteArchive:read_visibilite.html.twig', 
        array('archives'   => $archives,'menu_num'=> 3));
    }
    
    public function read_visibilitenonluAction()
    {
        $archives=$this->getDoctrine()->getManager()
                ->getRepository("BZArchiveBundle:VisibiliteArchive")
                ->findBy(array('user' => $this->getUser()->getId(),'estestlu' =>false));
        
        return $this->render('BZArchiveBundle:VisibiliteArchive:read_visibilitenonlu.html.twig', 
        array('archives'   => $archives,'menu_num'=> 3));
    }
    
}
