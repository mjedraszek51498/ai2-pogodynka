<?php

namespace App\Form;

use App\Entity\Location;
use App\Entity\Measurement;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MeasurementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date',
                'row_attr' => ['class' => 'mb-3'],
                'attr' => ['placeholder' => 'Select date'],
            ])
            ->add('celsius', NumberType::class, [
                'label' => 'Temperature (°C)',
                'row_attr' => ['class' => 'mb-3'],
                'attr' => ['placeholder' => 'e.g. 22.5'],
            ])
            ->add('humidity', NumberType::class, [
                'label' => 'Humidity (%)',
                'row_attr' => ['class' => 'mb-3'],
                'attr' => ['placeholder' => '0 - 100'],
            ])
            ->add('pressure', NumberType::class, [
                'label' => 'Pressure (hPa)',
                'row_attr' => ['class' => 'mb-3'],
                'attr' => ['placeholder' => 'e.g. 1013'],
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'required' => false,
                'row_attr' => ['class' => 'mb-3'],
                'attr' => [
                    'placeholder' => 'Short weather description...',
                    'rows' => 3,
                ],
            ])
            ->add('location', EntityType::class, [
                'class' => Location::class,
                'choice_label' => 'city', // pokazuje nazwę miasta zamiast ID
                'label' => 'Location',
                'row_attr' => ['class' => 'mb-3'],
                'placeholder' => 'Select location',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Measurement::class,
        ]);
    }
}
