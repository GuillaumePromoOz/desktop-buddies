<?php

namespace App\Form;

use App\Entity\User;
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
            ->add('password', PasswordType::class, [
                'empty_data' => '',
                'label' => 'Password *',
                'help' => 'Must be at least 8 characters long, including uppercase, lowercase letters and numbers',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
