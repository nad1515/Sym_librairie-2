<?php

namespace App\Form;

use App\Entity\Livres;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LivresType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ISBN')
            ->add('Titre_livre')
            ->add('Theme_livre')
            ->add('Nbr_pages_livre')
            ->add('Format_livre')
            ->add('Nom_auteur')
            ->add('Prenom_auteur')
            ->add('Editeur')
            ->add('Annee_edition')
            ->add('Prix_vente')
            ->add('Langue_livre')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Livres::class,
        ]);
    }
}
