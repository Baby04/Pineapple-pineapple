<?php

namespace App\Form;

use App\Entity\Booking;
use Doctrine\DBAL\Types\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormTypeInterface;

class BookingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('datebooked', DateType::class, [
                'attr' => [
                    'placeholder' => "datebooked",
                    'class' => 'form-control'
                ]
            ])
            ->add('deliverydate', DateType::class, [
                'attr' => [
                    'placeholder' => "deliverydate",
                    'class' => 'form-control'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Booking::class,
        ]);
    }
}