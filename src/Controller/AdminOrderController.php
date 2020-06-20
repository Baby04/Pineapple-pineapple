<?php

namespace App\Controller;

use App\Entity\Order;
use App\Form\AdminOrderType;
use App\Repository\OrderRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/orders")
 */
class AdminOrderController extends AbstractController
{
    /**
     * @Route("/", name="admin_order")
     */
    public function index(OrderRepository $order)
    {
        dump($order);
        return $this->render('admin/orders/index.html.twig', [
            'order' => $order->findAll()
        ]);
    }

    /**
     * Function to edit an order
     *
     * @Route("/{id}/edit", name="order_edit", methods={"GET","POST"})
     *
     * @return Response
     */
    public function edit(Request $request, Order $order, ObjectManager $manager)
    {

        $form = $this->createForm(AdminOrderType::class, $order);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($order);
            $manager->flush();
            $this->addFlash(
                'success',
                "Great ! You have editted the order from {$order->getFullName()} successfully"
            );

            return $this->redirectToRoute('admin_order');
        }

        
         
         return $this->render('admin/orders/edit.html.twig', [
             'form' => $form->createView(),
             'order' => $order
             ]);
             
             $this->redirectToRoute('admin_order');
    }

    /**
     *  Function to delete an order
     *
     * @Route("/{id}/delete", name="order_delete")
     *
     * @param Order $order
     * @param ObjectManager $manager
     * @return Response
     *
     */
    public function delete(Order $order, ObjectManager $manager)
    {
        $manager->remove($order);
        $manager->flush();

        $this->addFlash(
            'info',
            "Great you have deleted the order from {$order->getFullName()} successfully"
        );

        return $this->redirectToRoute('admin_order');
    }
}