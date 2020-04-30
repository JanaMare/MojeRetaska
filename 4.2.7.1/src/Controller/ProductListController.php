<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProductRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;


class ProductListController extends AbstractController
{
    /**
     * @Route("/produkty", name="product_list")
     */
    public function index(CategoryRepository $categoryRepository, ProductRepository $productRepository) :Response
    {
        return $this->render('product_list/index.html.twig', [
            'products' => $productRepository->findAll(),
            'categories'=>$categoryRepository->findAll(),

        ]);
    }
}
