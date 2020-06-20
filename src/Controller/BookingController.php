<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Form\BookingType;
use App\Service\Cart\CartService;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormTypeInterface;

class BookingController extends AbstractController
{
    /**
     * @Route("/booking", name="booking")
     */
    public function index(CartService $cartService, ObjectManager $manager, Request $request)
    {
        //$cartService->getFullCart();
        //dump($cartService->getFullCart());

        $booking = new Booking();
        $form = $this->createForm(BookingType::class, $booking);

         $form->handleRequest($request);
        dump($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dump($request);
      

           
           
            $manager->persist($booking);
            $manager->flush();
            return $this->render('booking/booking.html.twig', [
            //'book' => $cartService->getFullCart(),
            'form' => $form->createView()
            ]);
        }
    }
}