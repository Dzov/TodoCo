<?php

namespace App\Form\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class UserType extends AbstractType
{
    const LABEL                  = 'label';

    const ADMIN_VALIDATION_GROUP = 'admin';

    const REQUIRED               = 'required';

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, [self::LABEL => "Nom d'utilisateur"])
            ->add(
                'password',
                RepeatedType::class,
                [
                    'type'            => PasswordType::class,
                    'invalid_message' => 'Les deux mots de passe doivent correspondre.',
                    self::REQUIRED    => $options[self::REQUIRED],
                    'first_options'   => [self::LABEL => 'Mot de passe'],
                    'second_options'  => [self::LABEL => 'Tapez le mot de passe à nouveau',],
                ]
            )
            ->add('email', EmailType::class, [self::LABEL => 'Adresse email']);

        if (null !== $options['validation_groups'] && in_array(
                self::ADMIN_VALIDATION_GROUP,
                $options['validation_groups']
            )) {
            $builder->add(
                'admin',
                CheckboxType::class,
                [self::LABEL => 'Administrateur', self::REQUIRED => false,]
            );
        }
    }
}
