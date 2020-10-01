<?php declare(strict_types=1);

namespace App\Controller;

use App\Entity\Order;
use App\Form\OrderAdminType;
use App\Form\ProductType;
use App\Repository\OrderRepository;
use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;



/**
 * @Route("/admin/order")
 */
class OrderAdminController extends AbstractController
{
    /**
     * @Route("/", name="order_index", methods="GET")
     */
    public function index(OrderRepository $orderRepository): Response
    {
        return $this->render('order_admin/index.html.twig', ['orders' => $orderRepository->findAll()]);
    }


    /**
     * @Route("/{id}", name="order_show", methods="GET")
     */
    public function show(Order $order): Response
    {
        return $this->render('order_admin/show.html.twig', ['order' => $order]);
    }

    /**
     * @Route("/{id}/edit", name="order_edit", methods="GET|POST")
     */
    public function edit(Request $request, Order $order, ProductRepository $productRepository): Response
    {
        $form = $this->createForm(OrderAdminType::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();
            if ($order->getOrderStatus() === 'Zrušená') {
                $amountChange = $order->getCount();
                $product = $order->getProduct();
                $productOldStock = $product->getStock();
                $productNewStock = $productOldStock + $amountChange;
                $product->setStock($productNewStock);
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('order_index', ['id' => $order->getId()]);
        }

        return $this->render('order_admin/edit.html.twig', [
            'order' => $order,
            'form' => $form->createView(),
        ]);
    }
}
