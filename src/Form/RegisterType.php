<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'constraints' => new Length ([
                    'min' => 5,
                    'max' => 100,
                    'minMessage' => 'Votre mot de passe doit contenir au moins {{ limit }} caractères.',
                    'maxMessage' => 'Votre mot de passe peut contenir au maximum {{ limit }} caractères.'
                ]),
                'attr' => [
                    "placeholder" => 'Entrer votre email'
                ]
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Le mot de passe et la confirmation doivent être identiques.',
                'required' => true,
                'first_options' => [ 
                    'label' => 'Mot de passe',
                    'constraints' => new Length([
                        'min' => 3,
                        'minMessage' => 'Votre mot de passe doit contenir au moins {{ limit }} caractères.'
                    ]),
                    'attr' => [
                        'placeholder' => 'Entrer votre mot de passe.'
                    ]
                ],
                'second_options' => [ 
                    'label' => 'Confirmation de mot de passe',
                    'attr' => [
                        'placeholder' => 'Confirmer votre mot de passe.'
                    ]
                ]
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
                'constraints' => new Length([
                    'min' => 3,
                    'max' => 30,
                    'minMessage' => 'Votre prénom doit contenir au moins {{ limit }} caractères.',
                    'maxMessage' => 'Votre prénom peut contenir au maximum {{ limit }} caractères.'
                ]),
                'attr' => [
                    'placeholder' => 'Entrer votre prénom.'
                ],
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom',
                'constraints' => new Length([
                    'min' => 2,
                    'max' => 60,
                    'minMessage' => 'Votre nom doit contenir au moins {{ limit }} caractères.',
                    'maxMessage' => 'Votre nom peut contenir au maximum {{ limit }} caractères.'
                ]),
                'attr' => [
                    'placeholder' => 'Entrer votre nom.'
                ],
            ])
            ->add('job', TextType::class, [
                'label' => 'Poste',
                'attr' => [
                    'placeholder' => 'L\'intituler de votre poste'
                ]
            ])
            ->add('address', TextType::class, [
                'label' => 'Votre adresse',
                'attr' => [
                    'placeholder' => 'ex: 8 rue des lylas...'
                ]
            ])
            ->add('postalcode', TextType::class, [
                'label' => 'Votre code postal',
                'attr' => [
                    'placeholder' => 'Entrer votre code postal'
                ]
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville',
                'attr' => [
                    'placeholder' => 'Entrer votre ville'
                ]
            ])
            ->add('country', CountryType::class, [
                'label' => 'Pays',
                
                'placeholder' => 'Slectionner votre pays',
            ])
            ->add('phone', TelType::class, [
                'label' => 'Votre téléphone',
                'attr' => [
                    'placeholder' => 'Entrer votre téléphone'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'S\'inscrire'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}