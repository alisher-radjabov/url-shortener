<?php

namespace App\Controller;

use App\Entity\Link;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     * @Method({"GET"})
     */
    public function index(Request $request)
    {
        $form = $this->createFormBuilder()
                ->add('url', TextType::class, ['attr' => ['class' => 'form-control']])
                ->add('ShortenUrl', SubmitType::class, [
                    'attr' => ['class' => 'btn btn-success']
                ])
                ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();

            $link = new Link();
            $link->setUserId(2);
            $link->setName($data['url']);
            $link->setStatus('Pending');

            $em = $this->getDoctrine()->getManager();
            $em->persist($link);
            $em->flush();

            return $this->redirect($this->generateUrl('home'));
        }


        return $this->render('home/index.html.twig', [
            'form' => $form->createView()
        ]);

    }
    
}
