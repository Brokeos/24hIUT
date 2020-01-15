<?php

namespace App\Form;

use App\Entity\Coffee;
use App\Entity\Country;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CoffeeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('coffeeType', TextType::class, [
                'label' => 'Nom du café'
            ])
            ->add('quantity', IntegerType::class, [
                'label' => 'Quantité (tonnes)'
            ])
            ->add('country', EntityType::class, [
                'class' => Country::class,
                'label' => 'Pays',
                'multiple' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Coffee::class,
        ]);
    }
}
