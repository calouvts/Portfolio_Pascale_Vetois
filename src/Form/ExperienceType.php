<?php

namespace App\Form;

use App\Entity\Experience;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExperienceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('year',TextType::class, [
                'label' => 'Périodes',
                'attr' => [
                    'placeholder' => 'janvier 2010 à juillet 2012',
                ],
            ])
            ->add('Name',TextType::class, [
        'label' => 'Poste occupé',
        'attr' => [
            'placeholder' => 'Développeur back-end',
        ],
    ])
            ->add('Company',TextType::class, [
                'label' => 'entreprise',
                'attr' => [
                    'placeholder' => 'Société X',
                ],
            ])

            ->add('Description', TextareaType::class, [
        'label' => 'Description',
        'attr' => [
            'placeholder' => 'Developpement d\'une interface',
        ],
    ])
            ->add('Type', ChoiceType::class, [
                'choices'  => [
                    'Formation' => 'formation',
                    'Experience' => 'experience',

                ],

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Experience::class,
        ]);
    }
}
