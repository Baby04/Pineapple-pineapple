<?php

namespace App\Form;

use App\Entity\Order;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class OrderType extends AbstractType
{
   
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fullName', TextType::class, [
                'attr' => [
                    'placeholder' => "Fullname",
                    'class' => 'form-control'
                ]
            ])
            ->add('adressLine', TextType::class, [
                'attr' => [
                    'placeholder' => "Addressline",
                    'class' => 'form-control'
                ]
            ])
            ->add('city', TextType::class, [
                'attr' => [
                    'placeholder' => "City shipping to",
                    'class' => 'form-control'
                ]
            ])
            ->add('region', TextType::class, [
                'attr' => [
                    'placeholder' => "Region shipping to ",
                    'class' => 'form-control'
                ]
            ])
            ->add('phonenumber', NumberType::class, [
                'attr' => [
                    'placeholder' => "Phonenumber",
                    'class' => 'form-control'
                ]
            ])
            ->add('addDeliveryInstruction', TextareaType::class, [
                'attr' => [
                    'placeholder' => "Provide details suchs as building description, a nearby landmark, or other navigation instructions",
                    'class' => 'form-control'
                ]
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