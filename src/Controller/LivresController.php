<?php


namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\LivresRepository;
use App\Form\LivresType;
use App\Entity\Livres;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Form\LivresTitreType;




#[Route('/livres')]
class LivresController extends AbstractController
{
    #[Route('/', name: 'app_livres',methods:['GET'])]
    public function index(LivresRepository $livresRepository): Response
    {
        return $this->render('livres/index.html.twig', [
            'livres' => $livresRepository->findAll(),
        ]);
    }

    // ..............................suprimer un livre...............................................................................

    #[Route('/livres/{id}/delete', name: 'livres_delete')]
    public function delete( int $id, EntityManagerInterface $entityManager,  LivresRepository $livresRepository ): Response
    {
        $livre = $livresRepository->find($id);
        var_dump($livre);
        $entityManager->remove($livre);

        $entityManager->flush();
        return $this->redirectToRoute('app_livres');
    }

// ...........................Mettre a jours un livre............................................................................

    #[Route('/livres{id}/edit', name: 'livres_edit',methods:['GET','POST'])]
    public function livres_edit(int $id, Request $request, LivresRepository $livresRepository, EntityManagerInterface $entityManager): Response
    {
      $form= $this-> createForm(LivresType::class, $livresRepository->find($id));
      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) {
          $entityManager->flush();

      return $this->redirectToRoute('app_livres',[],
      Response::HTTP_SEE_OTHER);
    }
    return $this->render('livres/edit.html.twig', [
      'form'=> $form, 'livre'=> $livresRepository->findAll(),
    ]);
  }
// ............................ajouter un livre..............................................................................

  #[Route('/Add', name: 'livres_add',methods:['GET','POST'])]
  public function livres_add( Request $request, LivresRepository $livresRepository, EntityManagerInterface $entityManager): Response
  {
    $livre = new Livres();
    $form= $this-> createForm(LivresType::class,$livre);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager->persist($livre);
        $entityManager->flush();

    return $this->redirectToRoute('app_livres',[],
    Response::HTTP_SEE_OTHER);
  }
  return $this->render('livres/add.html.twig', [
    'form'=> $form->createView() ,
  ]);
}

// ...............choix du livre par auteur.............................................................................

#[Route('/auteur', name: 'livres_auteur', methods:['GET','POST'])]
public function livres_auteur( Request $request, LivresRepository $livresRepository, EntityManagerInterface $entityManager): Response
{
    $livres = $livresRepository->findAll(); // Récupérer tous les livres

    // Créer le formulaire
    $form = $this->createFormBuilder()
        ->add('auteur', ChoiceType::class, [
            'choices' => $livres, // Utiliser les noms d'auteur comme choix
            'choice_label' => 'Nomauteur',
            'choice_value' => 'Nomauteur',
             'placeholder' => 'Choisir un auteur', 
             'required' => false, // Rendre le champ facultatif
             'multiple' => false
             
        ])
       
        ->getForm();
//  dd($form->get('auteur'));
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      
        $auteurchoisis = $form->get('auteur')->getData();
        $NomAuteur = $auteurchoisis->getNomAuteur();
        return $this->render('livres/auteurinfos.html.twig', [
          'livres' => $livresRepository->findBy(['Nom_auteur' => $NomAuteur]),
          
      ]);
     }
   
      return $this->render('livres/auteur.html.twig', [
        'form' => $form->createView(),
      
  
    ]);
}
// ................................une autre methode de choisir les livres par auteur sans cree form...........................

// #[Route('/titre', name: 'livres_titre', methods: ['GET', 'POST'])]
// public function livres_titre(Request $request, LivresRepository $livresRepository, EntityManagerInterface $entityManager): Response
// {
//     $livres = $livresRepository->findAll();
//     $form = $this->createFormBuilder()
//             ->add('titre', ChoiceType::class, [
//                 'choices' => $livres, 
//                 'choice_label' => 'titreLivre',
//                 'choice_value' => 'id',
//                 'placeholder' => 'Choisir un titre', 
//                 'required' => false, 
//             ])
//             ->getForm();
//     $form->handleRequest($request);
            
//     if ($form->isSubmitted() && $form->isValid()) {
//         $livreId = $form->get('titre')->getData();
//         $livreSelectionne= $livresRepository->find($livreId);
//         return $this->render('livres/titreresult.html.twig', [
//             'livres' => $livreSelectionne,
//         ]);
//     }

//     return $this->render('livres/titre.html.twig', [
//         'form' => $form->createView(),
//     ]);
// }

// ..............................formulaire par titre de livre......................................
#[Route('/forme', name: 'forme_livre')]
public function forme(Request $request, EntityManagerInterface $entityManager): Response
{
    $livre = new Livres();

$form = $this->createForm(LivresType::class, $livre);

$form->handleRequest($request);
if ($form->isSubmitted() && $form->isValid()){
$livre = $form->getData();
$entityManager->persist($livre);
$entityManager->flush();

}
return $this->render('livre/formulaire.html.twig', [
	'form' => $form->createView()
	]);
}
//............................choisir les livres par titre...........................................................}

#[Route('/titre', name: 'livres_Titre', methods: ['GET','POST'])]
public function livres_Titre(Request $request, LivresRepository $LivresRepo, EntityManagerInterface
$entityManager)
    {
       
        $form = $this->createForm(LivresTitreType::class, null);
        // dd($form->get('titrelivre'));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $titreSelectionne = $form->get('titrelivre')->getData();
          $livres=$LivresRepo->findBy(['Titre_livre'=> $titreSelectionne]); 
          
           
         return $this->render('livres/titreresult.html.twig',[
                   
         'livres' =>$livres,
                ]);
            }

        return $this->render('livres/titre.html.twig', [
            'form' => $form->createView(),
        ]);
    }

///..................afficher les livres par editeur................................................................

#[Route('/editeur', name: 'livres_editeur', methods:['GET','POST'])]
public function livres_editeur( Request $request, LivresRepository $livresRepository, EntityManagerInterface $entityManager): Response
{
    $livres = $livresRepository->findAll(); // Récupérer tous les livres

    // Créer le formulaire
    $form = $this->createFormBuilder()
        ->add('livrediteur', ChoiceType::class, [
            'choices' => $livres, // Utiliser les noms d'auteur comme choix
            'choice_label' => 'editeur',
            'choice_value' => 'editeur',
             'placeholder' => 'Choisir un editeur', 
             'required' => false, // Rendre le champ facultatif
             'multiple' => false  //le chois de l'editeur n'est pas multiple

             
        ])
       
        ->getForm();
//  dd($form->get('auteur'));
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      
        $editeurchoisis = $form->get('livrediteur')->getData();
        $editeur = $editeurchoisis->getEditeur();
        return $this->render('livres/editeurresult.html.twig', [
          'livres' => $livresRepository->findBy(['Editeur' => $editeur]),
          
      ]);
     }
   
      return $this->render('livres/editeur.html.twig', [
        'form' => $form->createView(),
      
  
    ]);
}

}

