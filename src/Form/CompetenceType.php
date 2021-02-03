<?php

namespace App\Form;

use App\Entity\Competence;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompetenceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class, [
                'label' => 'Nom',
                'attr' => [
                    'placeholder' => 'HTML, CSS',
                ],
            ])
            ->add('photocomp', TextType::class, [
                'label' => 'URL',
                'attr' => [
                    'placeholder' => 'url d\'image',
                ],
            ])
            ->add('description', TextType::class, [
                'label' => 'description de la compétence',
                'attr' => [
                    'placeholder' => 'framework ',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Competence::class,
        ]);
    }
}
