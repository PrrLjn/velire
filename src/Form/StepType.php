<?php

namespace App\Form;

use App\Entity\Step;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;



class StepType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', ChoiceType::class, array(
                'choices'  => array(
                    'Time' => 'time',
                    'Go To' => 'goto',
                    'Off' => 'off',
                ),
                'multiple' => false,
                'attr' => ['class' => 'select2']
            ))
            ->add('rank', TextType::class, [
                'attr' => [
                    'readonly' => true,
                    'class'    => 'rank', // selector is the one used on the js side
                    'autocomplete' => 'off',
                ],
            ])
            ->add('value')
            ->add('recipe')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Step::class,
        ]);
    }

    public function getBlockPrefix()
    {
        return 'StepType';
    }
}