<?php declare(strict_types=1);

namespace App\Controller;

//use GuzzleHttp\Psr7\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
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
    public function add (ProductRepository $productRepository, SessionInterface $session, Product $product, Request $request/*, int $idProduct*/): Response
    {
        $currentBasket = $session->get('basket', []);
        $quantity = $request->query->get('quantity');

        dump($currentBasket);

        $inbasket = false;

            dump($currentBasket);
            foreach ($currentBasket as $basketIndex => $basketItem) {
                dump($basketItem['id']);
                dump($product->getId());
                if ($basketItem['id'] == $product->getId()) {
                    dump($basketItem);
                    $basketItem['quantity'] = (int)$basketItem['quantity'] + 1;
                    dump($basketItem);
                    $inbasket = true;
                    $currentBasket[$basketIndex] = $basketItem;

                    break;
                }
            }
            dump($currentBasket);

            if ($inbasket == false){
                $currentBasket[] = [
                    'image'=>$product-> getImage(),
                    'id'=>$product->getId(),
                    'name'=>$product->getName(),
                    'price'=> $product ->getPrice(),
                    'quantity'=> $quantity
                ];
                dump($currentBasket);
            }





        $session->set('basket', $currentBasket);

        $basket = $session->get('basket', []);
        $productRepository->findAll($product);


        //redirect();
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
