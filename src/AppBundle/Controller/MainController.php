<?php

namespace AppBundle\Controller;


use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;


class MainController extends Controller
{
    public function homepageAction()
    {
      return $this->render('main/homepage.html.twig');
    }
}
