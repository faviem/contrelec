<?php

// src/BZ/ArchiveBundle/Controller/ArchiveController.php
namespace BZ\ArchiveBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityRepository;
use BZ\ArchiveBundle\Entity\DocumentArchive;
use BZ\ArchiveBundle\Form\DocumentArchiveType;

class DocumentArchiveController   extends Controller
{
    
    public function ajout_document_newAction($id)
    {
        $newdoc = new DocumentArchive;
        $archive=$this->getDoctrine()->getManager()->getRepository("BZArchiveBundle:Archive")->find($id);
        $newdoc->setArchive($archive);
        //$newarchive->setCategoriearchive($this->getDoctrine()->getManager()->getRepository("BZArchiveBundle:CategorieArchive")->find($categorie));
        $form = $this->createForm(new DocumentArchiveType, $newdoc);   
        $request = $this->get('request');
        if ($request->getMethod() == 'POST') 
        {
            $form->bind($request);
            if ($form->isValid()) 
            {
                $em = $this->getDoctrine()->getManager(); 
                $em->persist($newdoc);
                 
                $em->flush();
                return $this->redirect( $this->generateUrl('etape_suivante', array('id'   =>$id))); 
            }
        }
        return $this->render('BZArchiveBundle:DocumentArchive:create_document.html.twig', 
        array('form'   => $form->createView(),'menu_num'=> 3,'id'=> $id,'archive'=> $archive));
    }
    
    public function delete_document_newAction($id, $idarchive)
    {
        $newdoc=$this->getDoctrine()->getManager()->getRepository("BZArchiveBundle:DocumentArchive")->find($idarchive);
        //$newarchive->setCategoriearchive($this->getDoctrine()->getManager()->getRepository("BZArchiveBundle:CategorieArchive")->find($categorie));
         if ($newdoc !=null) 
        {
                $em = $this->getDoctrine()->getManager(); 
                $em->remove($newdoc);
                $em->flush();
                
        }
        return $this->redirect( $this->generateUrl('etape_suivante', array('id'   =>$id))); 
    }
    
}
