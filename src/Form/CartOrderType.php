<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CartOrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('adressLine', TextType::class, [
                'attr' => [
                    'placeholder' => "Addressline",
                    'class' => 'form-control'
                ]
            ])
            ->add('city and region', TextareaType::class, [
                'attr' => [
                    'placeholder' => "Enter a valid city and region shipping to",
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
            // Configure your form options here
        ]);
    }
}