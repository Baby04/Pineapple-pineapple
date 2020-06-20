<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class WelcomeController extends AbstractController
{
    /**
     * @Route("/welcome", name="welcome")
     */
    public function index(ProductRepository $repo)
    {
        //$repo = $this->getDoctrine()->getRepository(Product::class);

        $products = $repo->findAll();
        return $this->render('welcome/index.html.twig', [
            'products' => $products,
        ]);
    }

    /**
    *
    *@Route("/prod/{id}", name="product_det")

    * @return Response
    */
    public function det($id, ProductRepository $repo)
    {
        $product =$repo->findOneById($id);

        return $this->render('welcome/det.html.twig', [
            'product' => $product
        ]);
    }
}