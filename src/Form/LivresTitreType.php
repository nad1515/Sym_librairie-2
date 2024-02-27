<?php

namespace App\Form;

use App\Entity\Livres;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Repository\LivresRepository;
use Symfony\Component\Form\Extension\Core\Type\TextType;



class LivresTitreType extends AbstractType
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('titrelivre', ChoiceType::class, [
            'label' => 'Titre du Livre',
            'choices' => $this->getTitres(),
        ]);
}

public function configureOptions(OptionsResolver $resolver)
{
    $resolver->setDefaults([
        'data_class' => Livres::class,
    ]);
}

private function getTitres()
{
    

    // Exemple : exécuter une requête DQL
    $query = $this->entityManager->createQuery('SELECT livres FROM App\Entity\Livres livres GROUP BY livres.Titre_livre');
    $livres = $query->getResult();


    $titres = [];
    foreach ($livres as $livre) {
    
     $titres[$livre->getTitrelivre()] = $livre->getTitrelivre();
    }
    return $titres;
}
}
