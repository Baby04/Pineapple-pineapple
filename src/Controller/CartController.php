<?php

namespace App\Controller;

use App\Service\Cart\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="cart")
     */
    public function index(CartService $cartService)
    {
       // $cartWithData = $cartService->getFullCart();
       
        //dd($cartWithData);
        //dump($cartWithData);
        //$total = $cartService->getTotal();
        dump($cartService->getFullCart());
        
        return $this->render('cart/cart.html.twig', [
            'items' => $cartService->getFullCart(),
            'total' => $cartService->getTotal(),
            
        ]);
    }

    /**
     * @Route("/cart/add/{id}", name="cart_add")
     */
    public function add($id, CartService $cartService)
    {
        //$session = $request->getSession();

        $cartService->add($id);
        //dd($session->get('cart'));

        return $this->redirectToRoute("cart");
    }

    /**
     * @Route("/cart/remove/{id}", name="cart_remove")
     */
    public function remove($id, CartService $cartService)
    {
        $cartService->remove($id);
                
        return $this->redirectToRoute("cart");
    }
}