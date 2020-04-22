<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProductListController extends AbstractController
{
    /**
     * @Route("/product/list", name="product_list")
     */
    public function index()
    {
        return $this->render('product_list/index.html.twig', [
            'controller_name' => 'ProductListController',
        ]);
    }
}
