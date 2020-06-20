<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\PasswordUpdate;
use App\Form\ResetPasswordType;
use App\Form\PasswordUpdateType;
use App\Repository\UserRepository;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;

class PasswordController extends AbstractController
{
     /**
     * Permits to modify password
     *
     * @Route("/update-password", name="account_password")
     *
     * @return Response
     */
    public function updatePassword(Request $request, UserPasswordEncoderInterface $encoder, ObjectManager $manager)
    {
        $passwordUpdate = new PasswordUpdate();

        $user = $this->getUser();

        $form = $this-> createForm(PasswordUpdateType::class, $passwordUpdate);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Verify if the password in the form is equal to the user curent password
            if (!password_verify($passwordUpdate->getOldPassword(), $user->getHash())) {
                // Generate an error
                $form->get('oldPassword')->addError(new FormError("Ooops ! The password your entered is not your 
                current password are you a thief !?"));
            } else {
                $newPassword = $passwordUpdate->getNewPassword();
                $hash = $encoder->encodePassword($user, $newPassword);

                $user->setHash($hash);

                $manager->persist($user);
                $manager->flush();


                $this->addFlash(
                    'success',
                    'Great!, You successfully modify your password'
                );

                return $this->redirectToRoute('home');
            }
        }

            return $this->render('account/update_password.html.twig', [
                'form' => $form->createView()
            ]);
    }


    /**
     * @Route("/forgotten-password", name="forgotten_password")
     *
     * @return Response
     */

    public function forgottenPass(
        Request $request,
        ObjectManager $manager,
        UserRepository $userRepo,
        TokenGeneratorInterface $tokenGenerator,
        \Swift_Mailer $mailer
    ) {
        $form = $this->createForm(ResetPasswordType::class);

         $form->handleRequest($request);
           
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $user = $userRepo->findOneByEmail($data['email']);

            // If the user does not exist
            if (!$user) {
                // send a flash message
                $this->addFlash('warning', 'This address is not valid');

                $this->redirectToRoute('account_login');
            }

            // Here i Generate a token

            $token = $tokenGenerator->generateToken();

            try {
                $user->setResetToken($token);
                $manager->persist($user);
                $manager->flush();
            } catch (\Exception $e) {
                $this->addFlash('warning', 'Ndolé, unfurtunately an error occurred:'. $e->getMessage());

                return $this->redirectToRoute('account_login');
            }

            // Here password re-initialisation url is generated...
            $url = $this->generateUrl('reset_password', ['token'=> $token], UrlGeneratorInterface::ABSOLUTE_URL);

            // Send a message
            $message = (new \Swift_Message('Forgotten Password'))
            ->setFrom('no-reply@pineapplepineapple.com')
            ->setTo($user->getEmail())
            ->setBody(
                "<p>I say Ndolé,</p>
                <br>
                <p> A request to reset your password has been made for your Pineapple Pineapple account!!!
                  Check the link below: " . $url .'</p>',
                'text/html'
            );

            // The mesaage is sent
            $mailer->send($message);

            // Flass message
            $this->addFlash('message', 'An email to reset your password has been send to your email address');

            return $this->redirectToRoute('account_login');
        }

         // Redirect to email request...

         return $this->render('account/forgotten_password.html.twig', [
            'emailForm' => $form->createView()
         ]);
    }

    /**
     * @Route("/reset-password/{token}", name="reset_password")
     */
    public function resetPassword(
        User $user,
        string $token,
        Request $request,
        ObjectManager $manager,
        UserPasswordEncoderInterface $encoder
    ) {
   
        //get the user with  given token

        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['reset_token' => $token]);

        if (!$user) {
            $this->addFlash('danger', 'Unkown Token');
            return $this->redirectToRoute('account_login');
        }
         
        //if the request is send through post
        if ($request->isMethod('POST')) {
            // Token is deleted
            $user->setResetToken(null);

            // Encode pasword
            $user->setHash($encoder->encodePassword($user, $request->request->get('password')));
            
            $manager->persist($user);
            $manager->flush();
            $this->addFlash('message', 'Here we are, 
            Good job your password was reset successfully login with your new password');
            
            return $this->redirectToRoute('account_login');
        } else {
            return $this->render('account/reset_password.html.twig', [
               'token' => $token,
               'user' => $user
            ]);
        }
    }
}