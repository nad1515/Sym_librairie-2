<?php

namespace App\Controller;
use App\Entity\Commander;
use App\Form\CommanderType; 
use App\Repository\CommanderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

#[Route('/commander')]
class CommanderController extends AbstractController
{
    #[Route('/', name: 'app_commander',methods:['GET'])]
    public function index(CommanderRepository $commanderRepository): Response
    {
        return $this->render('commander/index.html.twig', [
            'commandes' => $commanderRepository->findAll(),
        ]);
    }
  // ..............................suprimer une commande..................................

  #[Route('/commander/{id}/delete', name: 'commander_delete')]
  public function delete( int $id, EntityManagerInterface $entityManager,  CommanderRepository $commangerRepository ): Response
  {
      $commande = $commangerRepository->find($id);

      $entityManager->remove($commande);

      $entityManager->flush();
      return $this->redirectToRoute('app_commander');
  }

// ...........................Mettre a jours une commande.........................

  #[Route('/commander{id}/edit', name: 'commander_edit',methods:['GET','POST'])]
  public function commander_edit(int $id, Request $request, CommanderRepository $commangerRepository , EntityManagerInterface $entityManager): Response
  {
    $form= $this-> createForm(CommanderType::class, $commangerRepository->find($id));
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager->flush();

    return $this->redirectToRoute('app_commander',[],
    Response::HTTP_SEE_OTHER);
  }
  return $this->render('commander/edit.html.twig', [
    'form'=> $form, 'commande'=> $commangerRepository->findAll(),
  ]);
}
// ............................ajouter une commande..........................

#[Route('/Add', name: 'commander_add',methods:['GET','POST'])]
public function livres_add( Request $request, CommanderRepository $commangerRepository, EntityManagerInterface $entityManager): Response
{
  $commande = new Commander();
  $form= $this-> createForm(CommanderType::class,$commande);
  $form->handleRequest($request);
  if ($form->isSubmitted() && $form->isValid()) {
      $entityManager->persist($commande);
      $entityManager->flush();

  return $this->redirectToRoute('app_commander',[],
  Response::HTTP_SEE_OTHER);
}
return $this->render('commander/add.html.twig', [
  'form'=> $form->createView() ,
]);
}


//........................commande par date..............................................
#[Route('/pardate', name: 'commande_date', methods:['GET','POST'])]
public function commande_date(Request $request, CommanderRepository $commanderRepository, EntityManagerInterface $entityManager): Response
{
     // Récupérer toutes les commandes avec les jointures
     $commande = $commanderRepository->findAllCommandesWithJointures();
     $datesAchat = [];
     foreach ($commande as $commandedate) {
         $dateAchat = $commandedate->getDateAchat()->format('Y-m-d'); // Formatage de la date
         $datesAchat[$dateAchat] = $dateAchat; // Utilisation de la date comme clé et comme valeur
     }

//     ........ Créer le formulaire avec les dates d'achat comme choix..............................

    $form = $this->createFormBuilder()
        ->add('date', ChoiceType::class, [
           'choices' => $datesAchat,
           'placeholder' => 'Choisir une date',
            'required' => false,  
            'multiple' => false 
        ])
        ->getForm();

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $dateChoisie = $form->get('date')->getData();
        $dateChoisie = new \DateTimeImmutable($dateChoisie);
        $commandesDate = $commanderRepository->findBy(['Date_achat' => $dateChoisie]);
        
        return $this->render('commander/dateresult.html.twig', [
            'commandes' => $commandesDate,
        ]);
    }

    return $this->render('commander/date.html.twig', [
        'form' => $form->createView(),
    ]);
}
#[Route('/fournisseur', name: 'commande_fournisseur', methods:['GET','POST'])]
public function ommande_fournisseur( Request $request, CommanderRepository $commanderRepository, EntityManagerInterface $entityManager): Response
{
        $commande = $commanderRepository->findAll(); // Récupérer tous les fournisseurs
        $form = $this->createFormBuilder()
            ->add('Raisonsociale', ChoiceType::class, [
                'choices' => $commande, // Utiliser les noms de fournisseur comme choix
                'choice_label'=> 'Idfournisseur.Raisonsociale',
                'choice_value'=> 'Idfournisseur.id',
                'placeholder' => 'Choisir un fournisseur', 
                'required' => false, 
                'multiple' => false  
              
            ])
          
            ->getForm();
    $form->handleRequest($request);
   
    if ($form->isSubmitted() && $form->isValid()) {
        $raisonchoisis = $form->get('Raisonsociale')->getData();
        $raisonselect = $raisonchoisis->getIdFournisseur();
        
    return $this->render('commander/com_raisonresult.html.twig', [
      'commandes'=>$commanderRepository->findBy(['Id_fournisseur' => $raisonselect]) ,
          
      ]);
     }
    return $this->render('commander/com_raison.html.twig', [          
           'form' => $form->createView(),
            
        
    
      ]);
  }


//.................................afficher commande par editeur.........................................
#[Route('/editeur', name: 'commande_editeur', methods:['GET','POST'])]
public function commande_editeur( Request $request, CommanderRepository $commanderRepository, EntityManagerInterface $entityManager): Response
{
    $commande = $commanderRepository->findAllCommandesWithJointures(); // Récupérer tous les fournisseurs
  
    $form = $this->createFormBuilder()
        ->add('editeur', ChoiceType::class, [
            'choices' => $commande, // Utiliser les noms de fournisseur comme choix
            'choice_label' => 'IdLivre.Editeur',
            'choice_value' => 'IdLivre.id',
             'placeholder' => 'Choisir un editeur', 
             'required' => false, 
             'multiple' => false  
          
        ])
       
        ->getForm();

    $form->handleRequest($request);
   
    if ($form->isSubmitted() && $form->isValid()) {
      
      $editeurchoisis = $form->get('editeur')->getData();
        $editeurselect = $editeurchoisis->getIdLivre();
        
        return $this->render('commander/com_editeurresult.html.twig', [
                    'commandes'=> $commanderRepository->findBy(['Id_Livre' => $editeurselect]) ,
          
      ]);
     }
   
      return $this->render('commander/com_editeur.html.twig', [
        'form' => $form->createView(),
        
  
    ]);
}




}

  
