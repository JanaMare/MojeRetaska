<?php

namespace App\Form;

use App\Entity\Order;
use App\Entity\Payment;
use App\Entity\Shipping;
use App\Entity\Product;
use App\Entity\Country;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class OrderAdminType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('product', EntityType::class, [
                'class' => Product::class,
                'choice_label' => 'name',
                'label' => 'Produkt'
            ])
            ->add('count', null, ['label'=>'Počet kusů'])
            ->add('email')
            ->add('phone')
            ->add('name')
            ->add('surname')
            ->add('street')
            ->add('streetNumber')
            ->add('city')
            ->add('zipCode')
            ->add('note')
            ->add('count')
            ->add('orderPrice')
            ->add('orderStatus', ChoiceType::class, [
                'choices' => [
                    'Nová' => 'Nová',
                    'Potvrzená' => 'Potvrzená',
                    'Odeslaná' => 'Odeslaná',
                    'Zrušená' => 'Zrušená'
                ]
            ])
            ->add('country', EntityType::class, [
                'class' => Country::class,
                'choice_label' => 'name',
                'label' => 'Země'
            ])
            ->add('shipping', EntityType::class, [
                'class' => Shipping::class,
                'choice_label' => 'name',
                'label' => 'Doprava',
            ])
            ->add('payment', EntityType::class, [
                'class' => Payment::class,
                'choice_label' => 'name',
                'label' => 'Platba',
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Upravit',
                'attr' => ['class' => 'btn-danger']
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
