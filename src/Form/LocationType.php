<?php

namespace App\Form;

use App\Entity\Location;
use Hoa\Compiler\Llk\Rule\Choice;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LocationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('city', null, [
                'attr' => [
                    'placeholder' => 'enter city name',
                ],
            ])
            ->add('country', ChoiceType::class, [
                'choices' => [
                    'Poland' => 'PL',
                    'United States' => 'US',
                    'Canada' => 'CA',
                    'United Kingdom' => 'UK',
                    'Germany' => 'DE',
                    'France' => 'FR',

                ],
                'placeholder' => 'Select a country',
            ])
            ->add('latitude', NumberType::class, [
                'scale' => 7,
                'attr' => [
                    'placeholder' => 'enter latitude',
                ],
            ])
            ->add('longitude', NumberType::class, [
                'scale' => 7,
                'attr' => [
                    'placeholder' => 'enter longitude',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Location::class,
        ]);
    }
}
