<?php

namespace App\Form;

use App\Entity\Order;
use App\Entity\Country;
use App\Entity\Shipping;
use App\Entity\Payment;
use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('product', EntityType::class, [
                'class' => Product::class,
                'choice_label' => 'name',
                'label' => 'Produkt',
                'choice_attr' => function($product){
                    return['data-price'=>$product->getPrice()];
                }
            ])
            ->add('count', null, ['label'=>'Počet kusů'])
            ->add('email', null, ['label'=> 'Email'])
            ->add('phone', null,  ['label'=>'Telefon'])
            ->add('name', null, ['label'=>'Jméno'])
            ->add('surname', null, ['label'=>'Příjmení'])
            ->add('street', null, ['label'=>'Ulice'])
            ->add('streetNumber', null,  ['label'=>'Číslo popisné'])
            ->add('city', null,  ['label'=>'Město'])
            ->add('zipCode', null, ['label'=>'PSČ'])
            ->add('note', null, ['label'=>'Poznámka'])
            ->add('country', EntityType::class, [
                'class' => Country::class,
                'choice_label' => 'name',
                'label' => 'Země'
            ])
            ->add('shipping', EntityType::class, [
                'class' => Shipping::class,
                'choice_label' => 'name',
                'label' => 'Doprava',
                'choice_attr' => function($shipping){
                    return ['data-price'=>$shipping->getPrice()];
                }
            ])
            ->add('payment', EntityType::class, [
                'class' => Payment::class,
                'choice_label' => 'name',
                'label' => 'Platba',
                'choice_attr' => function($payment){
                    return['data-price'=>$payment->getPrice()];
                }
            ])

            ->add('submit', SubmitType::class, [
                'label' => 'Odeslat objednávku',
                'attr' => ['class' => 'btn-success']
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