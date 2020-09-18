<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, [
                'label' => 'Quel est votre prénom ?',
                 'attr' => ['class' =>'form-control mb-4', 'rows' => 3]
            ])

            ->add('lastName', TextType::class, [
                'label' => 'Quel est votre nom ?',
                'attr' => ['class' =>'form-control mb-4', 'rows' => 3]
            ])

            ->add('duckName', TextType::class, [
                'label' => 'Quel est votre nom d\'utilisateur ?',
                'attr' => ['class' =>'form-control mb-4', 'rows' => 3]
            ])

            ->add('email', EmailType::class, [
                'label' => 'Quel est votre email ?',
                'attr' => ['class' =>'form-control mb-4', 'rows' => 3]
            ])

            ->add('password',RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Les mots de passe doivent être similaire.',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options'  => [
                    'label' => 'Mot de passe',
                    'attr' =>  ['class' =>'form-control mb-2', 'rows' => 3]],
                'second_options' => [
                    'label' => 'Répéter le mot de passe',
                    'attr' => ['class' =>'form-control mb-2', 'rows' => 3]],
            ])

            ->add('img', UrlType::class, [
                'label' => 'L\'url de votre image',
                'attr' => ['class' =>'form-control mb-4', 'rows' => 3]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
