<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    /**
     * @Route("/user/{id}", name="user_show")
     */
    public function index(User $user)
    {
        return $this->render('user/user.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * Permits to display the profile of the user logged in
     *
     * @Route("/account", name="account_profile")
     *
     * @return Response
     */
    public function myAccount()
    {
        return $this->render('user/user.html.twig', [
            'user' => $this->getUser()
        ]);
    }

    /**
     * permits to list orders per customers
     *
     * @Route("/account/orders", name="account_orders")
     *
     * @return Response
     */
    public function orders()
    {
        return $this->render('user/orders.html.twig', [
            'user' => $this->getUser()
        ]);
    }
}