<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProductDetailController extends AbstractController
{
    /**
     * @Route("/product/detail", name="product_detail")
     */
    public function index()
    {
        return $this->render('product_detail/index.html.twig', [
            'controller_name' => 'ProductDetailController',
        ]);
    }
}
