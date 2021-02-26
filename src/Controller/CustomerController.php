<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class CustomerController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        $customers = [];
        return $this->render('customers-list.html.twig', compact('customers'));
    }

}