<?php

namespace App\Controller;

use App\Service\StatsService;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class AdminDashboardController extends AbstractController
{
    /**
     * @Route("/", name="admin_dashboard")
     */
    public function index(ObjectManager $manager, StatsService $StatsService)
    {
        // $users = $StatsService->getUsersCount();
        // $products = $StatsService->getProductsCount();
        // $orders = $StatsService->getOrdersCount();
        // $comments = $StatsService->getCommentsCount();

        $stats = $StatsService->getStats();

       // dump($users, $products, $orders, $comments);
        dump($stats);

        $bestProducts = $StatsService->getProductStats('DESC');

        dump($bestProducts);

        $worstProducts = $StatsService->getProductStats('ASC');

        dump($worstProducts);

        return $this->render('admin/dashboard/index.html.twig', [
            'stats'=> $stats,
            'bestProducts' => $bestProducts,
            'worstProducts' => $worstProducts
            /* [
                'users' => $users,
                'products' => $products,
                'orders' => $orders,
                'comments' => $comments
            ] */
        ]);
    }
}