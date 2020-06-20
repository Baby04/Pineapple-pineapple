<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Order;
use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminOrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fullName')
            ->add('adressLine')
            ->add('city')
            ->add('region')
            ->add('phonenumber')
            ->add('addDeliveryInstruction')
            ->add('owner', EntityType::class, [
                'class' => User::class,
                'choice_label' => function ($user) {
                       return $user->getFirstName() ." ".strtoupper($user->getLastName());
                }
            ])
            ->add('prod', EntityType::class, [
                'class' => Product::class,
                'choice_label' => 'productname'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}