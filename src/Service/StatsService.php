<?php

namespace App\Service;

use Doctrine\Common\Persistence\ObjectManager;

class StatsService
{
    private $manager;
    
    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
        # code...
    }


    public function getStats()
    {
        $users    = $this->getUsersCount();
        $products = $this->getProductsCount();
        $orders   = $this->getOrdersCount();
        $comments = $this->getCommentsCount();

        return compact('users', 'products', 'orders', 'comments');
    }

    public function getUsersCount()
    {
        return $this->manager->createQuery('SELECT count(u) FROM APP\Entity\User u')
        ->getSingleScalarResult();
    }

    public function getProductsCount()
    {
        return $this->manager->createQuery('SELECT count(p) FROM APP\Entity\Product p')
        ->getSingleScalarResult();
    }
    public function getOrdersCount()
    {
        return $this->manager->createQuery('SELECT count(o) FROM APP\Entity\Order o')
        ->getSingleScalarResult();
    }
    public function getCommentsCount()
    {
        return $this->manager->createQuery('SELECT count(c) FROM APP\Entity\Comment c')
        ->getSingleScalarResult();
    }


    public function getProductStats($direction)
    {
        
        return $this->manager->createQuery(
            'SELECT AVG(c.rating) as remark, p.productName, p.id, u.fullName
            FROM App\Entity\Comment c
            JOIN c.product p
            JOIN p.orders u
            GROUP BY p
            ORDER BY remark ' . $direction
        )
        ->setMaxResults(5)
        ->getResult();
    }
}