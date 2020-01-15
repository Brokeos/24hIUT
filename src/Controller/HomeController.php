<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @Route("/index")
     * @Route("/home")
     * @return Response
     */
    public function index()
    {
        return $this->render('home/index.html.twig');
    }

    /**
     * @Route("/apropos", name="apropos"){
     */
    public function apropos(){
        return $this->render('home/apropos.html.twig');
    }

}
