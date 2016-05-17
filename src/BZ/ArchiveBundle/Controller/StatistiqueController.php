<?php

// src/BZ/ArchiveBundle/Controller/ArchiveController.php
namespace BZ\ArchiveBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityRepository;
use BZ\ArchiveBundle\Entity\Archive;
use BZ\ArchiveBundle\Form\DateTimePersoType;

class StatistiqueController   extends Controller
{
    
    public function stat_archive_dateAction()
    {
        $newarchive= new Archive;
        $newarchive ->setDateArchive(new \Datetime());
       $archives=$this->getDoctrine()->getManager()
                ->getRepository("BZArchiveBundle:Archive")
                ->findBy(array('estsupprimer' => false,'dateArchive' => new \Datetime()));
       $form = $this->createForm(new DateTimePersoType,$newarchive); 
       $request = $this->get('request');
       if ($request->getMethod() == 'POST') 
        {
            $form->bind($request);
            $archives=$this->getDoctrine()->getManager()
                ->getRepository("BZArchiveBundle:Archive")
                ->findBy(array('estsupprimer' => false,'dateArchive' => $newarchive->getDateArchive()));
            $form = $this->createForm(new DateTimePersoType,$newarchive); 
        }
          
       return $this->render('BZArchiveBundle:Statistique:stat_archive_date.html.twig', 
        array('archives'   => $archives,'menu_num'=> 3,'form'   => $form->createView()));
    }
    
    public function stat_archive_pointAction()
    {
       $exercices=$this->getDoctrine()->getManager()->getRepository("BZBlogBundle:Exercice")->findBy(array('estsupprimer' => false));
        
       $objetclassements=$this->getDoctrine()->getManager()->getRepository("BZBlogBundle:ObjetClassement")->findBy(array('estsupprimer' => false));
         
       $services=$this->getDoctrine()->getManager()->getRepository("BZUserBundle:Service")->findBy(array('estsupprimer' => false));
        
       $categoriearchives=$this->getDoctrine()->getManager()->getRepository("BZArchiveBundle:CategorieArchive")->findBy(array('estsupprimer' => false));
        
       $option=1;
       if(isset($_GET['option'])){ $option=$_GET['option']; }
       return $this->render('BZArchiveBundle:Statistique:stat_archive_point.html.twig', 
        array('option'   => $option, 'exercices'   => $exercices,'menu_num'=> 3,'objetclassements'   => $objetclassements ,'services'   => $services  ,'categories'   => $categoriearchives));
    }
    
    public function stat_archive_exerciceAction($id)
    {
       $exercice=$this->getDoctrine()->getManager()->getRepository("BZBlogBundle:Exercice")->find($id);
        
       return $this->render('BZArchiveBundle:Statistique:stat_archive_exercice.html.twig', 
        array('exercice'   => $exercice,'menu_num'=> 3));
    }
    
    public function stat_archive_emplacementAction($id)
    {
       $objetclassement=$this->getDoctrine()->getManager()->getRepository("BZBlogBundle:ObjetClassement")->find($id);
        
       return $this->render('BZArchiveBundle:Statistique:stat_archive_emplacement.html.twig', 
        array('objetclassement'   => $objetclassement,'menu_num'=> 3));
    }
    
    public function stat_archive_categorieAction($id)
    {
       $categorie=$this->getDoctrine()->getManager()->getRepository("BZArchiveBundle:CategorieArchive")->find($id);
        
       return $this->render('BZArchiveBundle:Statistique:stat_archive_categorie.html.twig', 
        array('categorie'   => $categorie,'menu_num'=> 3));
    }
    
    public function stat_archive_serviceAction($id)
    {
       $service=$this->getDoctrine()->getManager()->getRepository("BZUserBundle:Service")->find($id);
        
       return $this->render('BZArchiveBundle:Statistique:stat_archive_service.html.twig', 
        array('service'   => $service,'menu_num'=> 3));
    }
    
}
