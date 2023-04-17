<?php

namespace App\Form;

use App\Entity\Partie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class CreationPartieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomPartie', TextType::class, [
                'label' => 'Nom de la partie',
                'attr' => [
                    'placeholder' => 'Partie de Gege',
                    'mapped' => false,
                ],
                'constraints'=> [
                    new NotBlank([
                        'message' => 'Entrez un nom de partie',
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Votre nom de partie doit avoir {{ limit }} caractères minimum',
                        // max length allowed by Symfony for security reasons
                        'max' => 12,
                        'maxMessage' => 'Votre nom de partie doit avoir {{ limit }} caractères maximum',
                    ]),
                ],
            ])
            ->add('partie_type', CheckboxType::class, [
                'label' => 'Partie privée',
                'attr' => ['mapped' => false,
                ],
                'required' => false,
                ])
            ->add('partieJoueur2', EmailType::class, [
            'label' => 'Email du joueur 2',
            'mapped' => false,
            'required' => false,
    ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Partie::class,
        ]);
    }
}
