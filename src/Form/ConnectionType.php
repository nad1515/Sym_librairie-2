<?php

namespace App\Form;
// use APP\Form\SubmitType;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ConnectionType extends AbstractType
{
    // public function buildForm(FormBuilderInterface $builder, array $options): void
    // {
    //     $builder
    //         ->add('email')
    //         ->add('password')
    //         // ->add('roles')
    //     ;
    // }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
    $builder
        ->add('email', EmailType::class,
        ['label'=>'E-mail',
        'attr'=> ['placeholder'=> 'Saisir votre e-mail.']
        ])
        
        ->add('password', PasswordType::class,
        ['label'=>'Mot de passe',
                'attr'=> ['placeholder'=> 'Saisir votre mot de passe.']
        ])->add('submit', SubmitType::class,
        ['label'=>'Valider'
        ])
        ;
 }

    // public function configureOptions(OptionsResolver $resolver): void
    // {
    //     $resolver->setDefaults([
    //         'data_class' => User::class,
    //     ]);
    // }
}
