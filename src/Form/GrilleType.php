<?php

namespace App\Form;

use App\Entity\Grille;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GrilleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numero1', null, [
                'attr' => [
                    'min' => '1',
                    'max' => '49'
                ]
            ])
            ->add('numero2', null, [
                'attr' => [
                    'min' => '1',
                    'max' => '49'
                ]
            ])
            ->add('numero3', null, [
                'attr' => [
                    'min' => '1',
                    'max' => '49'
                ]
            ])
            ->add('numero4', null, [
                'attr' => [
                    'min' => '1',
                    'max' => '49'
                ]
            ])
            ->add('numero5', null, [
                'attr' => [
                    'min' => '1',
                    'max' => '49'
                ]
            ])
            ->add('numeroChance', null, [
                'attr' => [
                    'min' => '1',
                    'max' => '10'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Grille::class,
        ]);
    }
}
