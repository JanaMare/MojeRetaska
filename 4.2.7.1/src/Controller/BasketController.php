<?php declare(strict_types=1);

namespace App\Controller;

use GuzzleHttp\Psr7\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Product;
use App\Repository\ProductRepository;


/**
 * @Route("/basket", name="basket")
 */

class BasketController extends AbstractController
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @Route("/", name="basket_index")
     */
    public function index( SessionInterface $session): Response
    {

        $basket = $session->get('basket', []);
        /*dump($basket);
        die();*/

        return $this->render('basket/index.html.twig', [
            'basket' => $basket,

        ]);
    }

    /**
     * @Route("/add/{id}", name="basket_add")
     */
    public function add (ProductRepository $productRepository, SessionInterface $session, Product $product/*, int $idProduct*/): Response
    {
        $currentBasket = $session->get('basket', []);

        $currentBasket[] = [
            'image'=>$product-> getImage(),
            'id'=>$product->getId(),
            'name'=>$product->getName(),
            'price'=> $product ->getPrice(),
            //'quantity'=> $quantity = 1
        ];

        $session->set('basket', $currentBasket);

        //$productStock = $product->getStock();
        $basket = $session->get('basket', []);
        $productRepository->findAll($product);

        return $this->render('basket/index.html.twig', [
            'controller_name' => 'BasketController',
            'product'=>$product,
            $session->get("basket"),
            'basket'=>$basket

        ]);
    }

    /**
     * @Route("/template", name="template")
     */
    public function template()
    {
        return $this->render('basket/template.html.twig', [
            'controller_name' => 'BasketController',
        ]);
    }
}
