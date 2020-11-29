<?php

namespace App\Controller;

use App\Entity\Link;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    // /**
    //  * @Route("/admin", name="admin")
    //  */
    // public function index()
    // {
        
    //     return $this->render('admin/index.html.twig', [
    //         'controller_name' => 'AdminController',
    //     ]);

    // }

    /**
     * @Route("/links", name="links")
     */
    public function getLinks()
    {

        $links = $this->getDoctrine()->getRepository(Link::class)->findAll();

        return $this->render('admin/index.html.twig', [
            'links' => $links
        ]); 
        

    }




}
