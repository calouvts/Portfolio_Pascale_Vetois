<?php

namespace App\Form;

use App\Entity\Competence;
use App\Entity\Realisation;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RealisationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class, [
        'label' => 'Nom',
        'attr' => [
            'placeholder' => 'mon site',
        ],
    ])
            ->add('realisationphoto',TextType::class, [
                'label' => 'Nom',
                'attr' => [
                    'placeholder' => 'photo',
                ],
            ])
            ->add('description', TextType::class, [
                'label' => 'description',
                'attr' => [
                    'placeholder' => 'description',
                ],
            ])
            ->add('projectlink',TextType::class, [
                'label' => 'Lien du projet',
                'attr' => [
                    'placeholder' => 'https//',
                ],
            ])
            ->add('competences', EntityType::class, [
                'class' => Competence::class,
                'choice_label' => 'name',
                'multiple' => true,
                'by_reference' => false,
                'expanded' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Realisation::class,
        ]);
    }
}
