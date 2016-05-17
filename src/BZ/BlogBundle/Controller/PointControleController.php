<?php

// src/BZ/BlogBundle/Controller/BlogController.php
namespace BZ\BlogBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Doctrine\ORM\EntityRepository;
use BZ\BlogBundle\Entity\PointControle;
use Symfony\Component\HttpFoundation\Response;

class PointControleController  extends Controller
{
    public function read_pointexoagenceAction($idexercice,$idagence)
    {
        $exercices=$this->getDoctrine()->getManager()->getRepository("BZBlogBundle:Exercice")
                ->findBy(array('estsupprimer' => false));
        $rubriques=$this->getDoctrine()->getManager()->getRepository("BZBlogBundle:RubriqueControle")
                ->findBy(array('estsupprimer' => false));
        $agences=$this->getDoctrine()->getManager()->getRepository("BZUserBundle:Service")
                ->findBy(array('estsupprimer' => false, 'sigle' => 'AGENCE'));
        $pointcontroles = $this->getDoctrine()->getManager()->getRepository("BZBlogBundle:PointControle")
                    ->findBy(array('exercice' => $idexercice, 'service' =>$idagence));
      
        return $this->render('BZBlogBundle:PointControle:read_pointexoagence.html.twig', 
        array('rubriques'   => $rubriques,'idexercice'   => $idexercice,'idagence'   => $idagence,'exercices'   => $exercices,'agences'   => $agences,'pointcontroles'   => $pointcontroles,'menu_num'=> 4));
    }
    
}
