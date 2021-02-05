<?php

namespace App\Form;

use App\Entity\Competence;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Vich\UploaderBundle\Form\Type\VichImageType;

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
            ->add('photocompFile', VichImageType::class, [
                'required'      => false,
                'label'  => false,
                'attr' => ['placeholder' => 'Sélectionner un fichier'],
            ])

            ->add('description', TextType::class, [
                'label' => 'description de la compétence',
                'attr' => [
                    'placeholder' => 'framework ',
                ],
            ])
            ->add('priority', TextType::class, [
                'label' => 'définissez la priorité d affichage',
                'attr' => [
                    'placeholder' => '1'
            ]
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
