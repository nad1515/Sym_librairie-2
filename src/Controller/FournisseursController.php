<?php

namespace App\Controller;

use App\Form\FournisseursType;
use App\Repository\FournisseursRepository;
use App\Entity\Fournisseurs;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;



// .......................afficher tous les fournisseurs.....................
#[Route('/fournisseurs')]
class FournisseursController extends AbstractController
{
    #[Route('/', name: 'app_fournisseurs',methods:['GET'])]
    public function index(FournisseursRepository $fournisseursRepository): Response
    {
        return $this->render('fournisseurs/index.html.twig', [
            'fournisseurs' => $fournisseursRepository->findAll()
        ]);
    }

    
    // ..............................suprimer un fournisseur..................................

    #[Route('/fournisseurs/{id}/delete', name: 'fournisseurs_delete')]
    public function delete( int $id, EntityManagerInterface $entityManager,  FournisseursRepository $fournisseursRepository ): Response
    {
    $fournisseur = $fournisseursRepository->find($id);
        var_dump($fournisseur);
        $entityManager->remove($fournisseur);

        $entityManager->flush();
        return $this->redirectToRoute('app_fournisseurs');
    }

// ...........................Mettre a jours un fournisseur.........................

    #[Route('/fournisseurs{id}/edit', name: 'fournisseurs_edit',methods:['GET','POST'])]
    public function fournisseurs_edit(int $id, Request $request, FournisseursRepository $fournisseursRepository, EntityManagerInterface $entityManager): Response
    {
      $form= $this-> createForm(FournisseursType::class, $fournisseursRepository->find($id));
      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) {
          $entityManager->flush();

      return $this->redirectToRoute('app_fournisseurs',[],
      Response::HTTP_SEE_OTHER);
    }
    return $this->render('fournisseurs/edit.html.twig', [
      'form'=> $form, 'fournisseur'=> $fournisseursRepository->findAll(),
    ]);
  }
// .........................ajouter un fournisseur.......................
  
  #[Route('/Add', name: 'fournisseurs_add',methods:['GET','POST'])]
  public function fournisseurs_add( Request $request, FournisseursRepository $fournisseursRepository, EntityManagerInterface $entityManager): Response
  {
    $fournisseur = new Fournisseurs();
    $form= $this-> createForm(fournisseursType::class,$fournisseur);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager->persist($fournisseur);
        $entityManager->flush();

    return $this->redirectToRoute('app_fournisseurs',[],
    Response::HTTP_SEE_OTHER);
  }
  return $this->render('fournisseurs/add.html.twig', [
    'form'=> $form->createView() ,
  ]);
}
//....................................afficher fournisseur par raison sociele.............................

#[Route('/raisonsociale', name: 'fournisseur_raisonsociale', methods:['GET','POST'])]
public function fournisseur_raisonsociale( Request $request, FournisseursRepository $fournisseursRepository, EntityManagerInterface $entityManager): Response
{
    $fournisseurs = $fournisseursRepository->findAll(); // Récupérer tous les fournisseurs

    // Créer le formulaire
    $form = $this->createFormBuilder()
        ->add('raisonsociale', ChoiceType::class, [
            'choices' => $fournisseurs, // Utiliser les noms de fournisseur comme choix
            'choice_label' => 'raisonsociale',
            'choice_value' => 'raisonsociale',
             'placeholder' => 'Choisir une raison sociale', 
             'required' => false, // Rendre le champ facultatif
             'multiple' => false  //le chois de l'editeur n'est pas multiple

             
        ])
       
        ->getForm();
//  dd($form->get('raisonsociale'));
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      
      $raisonchoisis = $form->get('raisonsociale')->getData();
        $raisonSociale = $raisonchoisis->getRaisonSociale();
        return $this->render('fournisseurs/raisonresult.html.twig', [
          'fournisseurs' => $fournisseursRepository->findBy(['Raison_sociale' => $raisonSociale]),
          
      ]);
     }
   
      return $this->render('fournisseurs/raison.html.twig', [
        'form' => $form->createView(),
      
  
    ]);
}
#[Route('/localite', name: 'fournisseur_localite', methods:['GET','POST'])]
public function fournisseur_localite( Request $request, FournisseursRepository $fournisseursRepository, EntityManagerInterface $entityManager): Response
{
    $fournisseurs = $fournisseursRepository->findAll(); // Récupérer tous les fournisseurs

    // Créer le formulaire
    $form = $this->createFormBuilder()
        ->add('localite', ChoiceType::class, [
            'choices' => $fournisseurs, // Utiliser les noms de fournisseur comme choix
            'choice_label' => 'localite',
            'choice_value' => 'localite',
             'placeholder' => 'Choisir une localite', 
             'required' => false, // Rendre le champ facultatif
             'multiple' => false  //le chois de l'editeur n'est pas multiple

             
        ])
       
        ->getForm();
//  dd($form->get('auteur'));
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      
      $localitechoisis = $form->get('localite')->getData();
        $localite = $localitechoisis->getLocalite();
        return $this->render('fournisseurs/localiteresult.html.twig', [
          'fournisseurs' => $fournisseursRepository->findBy(['Localite' => $localite]),
          
      ]);
     }
   
      return $this->render('fournisseurs/localite.html.twig', [
        'form' => $form->createView(),
      
  
    ]);
}
// ...........................choix du fournisseur par Pays............................................
#[Route('/pays', name: 'fournisseur_pays', methods:['GET','POST'])]
public function fournisseur_pays( Request $request, FournisseursRepository $fournisseursRepository, EntityManagerInterface $entityManager): Response
{
    $fournisseurs = $fournisseursRepository->findAll(); // Récupérer tous les fournisseurs
  

    // Créer le formulaire
    $form = $this->createFormBuilder()
        ->add('pays', ChoiceType::class, [
            'choices' => $fournisseurs, // Utiliser les noms de fournisseur comme choix
            'choice_label' => 'pays',
            'choice_value' => 'pays',
             'placeholder' => 'Choisir un pays', 
             'required' => false, // Rendre le champ facultatif
             'multiple' => false  //le chois de l'editeur n'est pas multiple
          
        ])
       
        ->getForm();
  
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      
      $payschoisis = $form->get('pays')->getData();
        $pays = $payschoisis->getPays();
        return $this->render('fournisseurs/paysresult.html.twig', [
          'fournisseurs' => $fournisseursRepository->findBy(['Pays' => $pays]),
          // dd(('fournisseurs'));
      ]);
     }
   
      return $this->render('fournisseurs/pays.html.twig', [
        'form' => $form->createView(),
      
  
    ]);
}

}
