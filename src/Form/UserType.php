<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;


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
                // User is mapped to the form
                $user = $event->getData();
                // We need the form object since we are
                // in an anonymous fonction
                $form = $event->getForm();

                // Does the $user entiy exist in the database ?
                // if $user has an id, that means it already exits
                if ($user->getId() === null) {
                    // if $user doesn't exist  => add
                    $form->add('password', PasswordType::class, [
                        // if data empty (null), remplacer by empty string
                        // @see https://symfony.com/doc/current/reference/forms/types/password.html#empty-data
                        'empty_data' => '',
                        'label' => 'Password *',
                        'help' => 'Must be at least 8 characters long, including uppercase, lowercase letters and numbers',
                    ]);
                } else {
                    // if $user already exists => edit
                    $form->add('password', PasswordType::class, [
                        'empty_data' => '',
                        'help' => 'Must be at least 8 characters long, including uppercase, lowercase letters and numbers',
                        'attr' => [
                            'placeholder' => 'Leave field empty if unchanged',
                        ],
                        'mapped' => false,
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
