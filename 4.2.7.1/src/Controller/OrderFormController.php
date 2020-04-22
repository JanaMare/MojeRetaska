<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class OrderFormController extends AbstractController
{
    /**
     * @Route("/order/form", name="order_form")
     */
    public function index()
    {
        return $this->render('order_form/index.html.twig', [
            'controller_name' => 'OrderFormController',
        ]);
    }
}
