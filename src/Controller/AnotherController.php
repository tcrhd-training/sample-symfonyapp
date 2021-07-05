<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnotherController extends AbstractController
{
    /**
     * @Route("/another", name="another")
     */
    public function index(): Response
    {
        return $this->render('another/index.html.twig', [
            'controller_name' => 'AnotherController',
        ]);
    }
}
