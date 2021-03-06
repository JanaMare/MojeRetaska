<?php declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProductRepository;
use App\Repository\CategoryRepository;
use App\Entity\Product;
use App\Entity\Category;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;


class ProductListController extends AbstractController
{
    /**
     * @Route("/produkty/search", name="product_list_search")
     */
    public function search (CategoryRepository $categoryRepository, ProductRepository $productRepository, Request $request) :Response
    {
        $search = $request->query->get('search');
        $products = $productRepository->findByName($search);
        $categories = $categoryRepository->findAll();

        return $this->render('product_list/index.html.twig', [
            'products' => $products,
            'categories' => $categories,
            'search'=> $search,
        ]);
    }



    /**
     * @Route("/produkty/{id}", name="product_list_category")
     */
    public function category(CategoryRepository $categoryRepository, ProductRepository $productRepository, Category $category) :Response
    {
        $products = $productRepository->findBy(['category' => $category]);
        $categories = $categoryRepository->findAll();

        return $this->render('product_list/index.html.twig', [
            'products' => $products,
            'categories' => $categories,
            'currentCategory' => $category
        ]);
    }

    /**
     * @Route("produkty/", name="product_list_index")
     */
    public function index(CategoryRepository $categoryRepository, ProductRepository $productRepository): Response
    {
        return $this->render('product_list/index.html.twig', [
            'products' => $productRepository->findAll(),
            'categories' => $categoryRepository->findAll()
        ]);
    }
}
