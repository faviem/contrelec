<?php

namespace BZ\ArchiveBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('BZArchiveBundle:Default:index.html.twig', array('name' => $name));
    }
}
