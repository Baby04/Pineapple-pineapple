<?php

namespace App\Controller;

//use App\Entity\Role;
use App\Entity\Role;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AdminAccountController extends AbstractController
{
    /**
     * @Route("/admin/login", name="admin_account_login")
     *
     * @return Response
     */
    public function login(Request $request, ObjectManager $manager, AuthenticationUtils $utils)
    {
       /*  $adminRole = new Role();
        $adminRole->setTitle('ROLE_ADMIN');
        $manager->persist($adminRole);

        $adminUser = new User();
        $adminUser->setFirstName('Jonny')
                  ->setLastName('Eagle')
                  ->setEmail('Bro@sym.com')
                  ->setPicture('https://hypo/dv')
                  ->setHash('password')
                  ->addUserRole($adminRole);
         $manager->persist($adminUser);
         $manager->flush(); */
        

         $error = $utils->getLastAuthenticationError();
         $username = $utils->getLastUsername();
      

            return $this->render('admin/account/login.html.twig', [
                 'hasError' => $error !== null,
                'username' => $username
            ]);
    }

    /**
     * permits to sign out
     *
     * @Route("/admin/logout", name="admin_account_logout")
     *
     * @return void
     */
    public function logout()
    {
    }
}