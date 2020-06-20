<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminProdController extends AbstractController
{
    /**
     * @Route("/admin/prods", name="admin_prods_index")
     */
    public function index(ProductRepository $repo)
    {
        
        return $this->render('admin/prod/index.html.twig', [
            'product' => $repo->findAll()
        ]);
    }
}