<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Validator\Constraints\Regex;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('lastname', TextType::class, [
                'label' => 'Lastname*',
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Firstname',
                'required' => false,
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email *',
            ])

            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
                // Le user mappé sur le form
                $user = $event->getData();
                // L'objet form à récupérer pour travailler avec
                // (car il est inconnu dans cette fonction anonyme)
                $form = $event->getForm();

                // L'entité $user existe-t-il en BDD ?
                // Si $user a un identifiant, c'est qu'il existe en base
                if ($user->getId() === null) {
                    // Si non => add
                    $form->add('password', PasswordType::class, [
                        // Si donnée vide (null), remplacer par chaine vide
                        // @see https://symfony.com/doc/current/reference/forms/types/password.html#empty-data
                        'empty_data' => '',
                        'label' => 'Password *',
                        'help' => 'Must be at least 8 characters long, including uppercase, lowercase letters and numbers',
                    ]);
                } else {
                    // Si oui => edit
                    $form->add('password', PasswordType::class, [
                        // Si donnée vide (null), remplacer par chaine vide
                        // @see https://symfony.com/doc/current/reference/forms/types/password.html#empty-data
                        'empty_data' => '',
                        'help' => 'Must be at least 8 characters long, including uppercase, lowercase letters and numbers',
                        'attr' => [
                            'placeholder' => 'Leave field empty if unchanged',
                        ],
                        'mapped' => false,
                        'constraints' => [
                            new Length([
                                'min' => 4,
                            ]),
                            new Regex('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])$/')
                        ]
                    ]);
                }
            });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
