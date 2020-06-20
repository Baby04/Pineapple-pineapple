<?php

namespace App\Form;

use App\Entity\User;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationType extends ApplicationType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, $this->getConfiguration("Surname", "Your name..."))
            ->add('lastName', TextType::class, $this->getConfiguration("Name", "Your family name..."))
            ->add('email', EmailType::class, $this->getconfiguration("Email", "Your email address..."))
            ->add('picture', UrlType::class, $this->getconfiguration("Profile photo", "Url of your avatar"))
            ->add('hash', PasswordType::class, $this->getConfiguration("Password", "Input a strong password"))
            ->add('passwordConfirm', PasswordType::class, $this->getConfiguration(
                "Confirm Password",
                "Input the same password to confirm"
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}