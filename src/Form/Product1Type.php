<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class Product1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('productName')
            ->add('productType')
            ->add('price')
            ->add('quantity')
            ->add('description')
            ->add('coverImage', FileType::class, [
                'label' => 'Upload a coverImage for the product (IMAGE file)',

                //unmapped meaning that this field is not associated to any entity property
                'mapped' => false,
                
                //I make it option so i don't re-upload the image file
                //everytime i edit theproduct details
                'required' => false,

                //unmapped fields can not define their validation using annotations
                //in the association entity, so you can use the php constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '10M',
                        'mimeTypes' => [
                            'image/*',
                            'application/pdf',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid IMAGE',
                    ])
                    ],
            ])
            ->add('plantation')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}