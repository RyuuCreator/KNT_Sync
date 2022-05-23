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
                    "placeholder" => 'Votre email'
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
                        'placeholder' => 'Votre mot de passe.'
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
                    'placeholder' => 'Votre prénom.'
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
                    'placeholder' => 'Votre nom.'
                ],
            ])
            ->add('job')
            ->add('address', TextType::class, [
                'label' => 'Votre adresse (facultatif)',
                'attr' => [
                    'placeholder' => 'ex: 8 rue des lylas...'
                ]
            ])
            ->add('postalcode', TextType::class, [
                'label' => 'Votre code postal (facultatif)',
                'attr' => [
                    'placeholder' => 'Entrez votre code postal'
                ]
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville (facultatif)',
                'attr' => [
                    'placeholder' => 'Entrez votre ville'
                ]
            ])
            ->add('country', CountryType::class, [
                'label' => 'Pays',
                'attr' => [
                    'placeholder' => 'Entrez votre pays'
                ]
            ])
            ->add('phone', TelType::class, [
                'label' => 'Votre téléphone (facultatif)',
                'attr' => [
                    'placeholder' => 'Entrez votre téléphone'
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
