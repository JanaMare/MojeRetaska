<?php declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Order;
use App\Entity\Product;
use App\Form\OrderType;
use App\Repository\ProductRepository;

class OrderFormController extends AbstractController
{
    /**
     * @Route("/order", name="order_form", methods={"GET|POST"})
     */
    public function new(
        Request $request,
        ProductRepository $productRepository): Response
    {
        $order = new Order();
        $form = $this->createForm(OrderType::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $itemsOnStock = $order->getProduct()->getStock();

            if (($itemsOnStock - $order->getCount()) < 0) {
                return $this->render('order_form/index.html.twig', [
                    'order' => $order,
                    'form' => $form->createView(),
                    'remainingOnStock' => $order->getProduct()->getStock()
                ]);
            }

            $order->getProduct()->setStock($itemsOnStock - $order->getCount());

            $em = $this->getDoctrine()->getManager();
            $em-> persist($order);
            $em->flush();

            return $this->render('order_form/thanks.html.twig');
        }

        return $this->render('order_form/index.html.twig', [
            'order' => $order,
            'form' => $form->createView(),
        ]);
    }
}
