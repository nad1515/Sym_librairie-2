<?php

namespace App\Form;

use App\Entity\Fournisseurs;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FournisseursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Code_fournisseur')
            ->add('Raison_sociale')
            ->add('Rue_fournisseur')
            ->add('Code_postal')
            ->add('Localite')
            ->add('Pays')
            ->add('Tel_fournisseur')
            ->add('Url_fournisseur')
            ->add('Email_fournisseur')
            ->add('Fax_fournisseur')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Fournisseurs::class,
        ]);
    }
}
