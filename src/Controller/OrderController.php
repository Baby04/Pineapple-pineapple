<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\User;
use App\Entity\Order;
use App\Entity\Comment;
use App\Entity\Product;
use App\Form\OrderType;
use App\Form\CommentType;
use App\Form\CartOrderType;
use App\Service\Cart\CartService;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrderController extends AbstractController
{
    /**
     * @Route("/prod/{id}/order", name="order_product")
     * @IsGranted("ROLE_USER")
     */
    public function order(Product $prod, Request $request, ObjectManager $manager)
    {
       
        $order = new Order();
        $form = $this->createForm(OrderType::class, $order);


        $form->handleRequest($request);
        dump($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dump($request);
            $user = $this->getUser();

            $order->setOwner($user);
            
            $order->setProd($prod);


            
            $order->setOrderdate(new \DateTime('+2days'));
            $order->setOrderedAt(new \DateTime());
            
           
            $manager->persist($order);
            $manager->flush();

           /* return new Response(
                'Product ordered with id: '.$prod->getid()
                .'and order with id: '.$order->getid()
            );*/

            return $this->redirectToRoute('order_checkout', ['id' => $order->getId(),
            'withAlert' => true]);
        }

        return $this->render('order/order.html.twig', [
            'prod' => $prod,
            'form' => $form->createView()
        ]);
    }

    /**
     * Display checkout page for an order
     *
     * @Route("/prod/{id}/checkout", name="order_checkout")
     *
     * @param Order $order
     * @param Request $request
     * @param ObjectManager $manager
     * @return Response
     */
    public function checkout(Order $order, Request $request, ObjectManager $manager)
    {
        $comment = new Comment();

        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setProduct($order->getProd())
                    ->setAuthor($this->getUser());

            $manager->persist($comment);
            $manager->flush();

            $this->addFlash(
                'success',
                "Great ! Your opinion about the product counts!"
            );
        }

        dump($order);
        
        return $this->render('order/checkout.html.twig', [
            'order' => $order,
            'form' => $form->createView()
        ]);
    }

    /**
     * Displays cart order
     *
     * @Route("/cart/order", name="cart_order", methods={"GET"})
     *
     */

    // public function cartorder(CartService $cartService, Cart $cart, Request $request, ObjectManager $manager, Product $prodcut): Response
    // {
    //     $cart = new Cart();

    //     // $form = $this->createForm(CartOrderType::class, $cart);

    //     // $form->handleRequest($request);
    //     //     dump($request);
        
    //         // if ($form->isSubmitted() && $form->isValid()) {
    //         //     dump($request);
    //         // }

    //              $user = $this->getUser();

    //         $cart->setUser($user);
            
    //         $cart->setComodity($cart->getcomodity());
    //       //  $cartService->getFullCart();

    //         $manager->persist($cart);
    //         $manager->flush();
            
    //         $cart->setCreatedAt(new \DateTime());
    //     dump($cartService->getFullCart());

    //     return $this->render('order/cartorder.html.twig', [
    //         'items' => $cartService->getFullCart()
    //     ]);
    // }
}