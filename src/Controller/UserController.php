<?php

namespace App\Controller;
use App\Form\ConnectionType;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
//  use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;




class UserController extends AbstractController
{
    #[Route('/user/add', name: 'app_user_add')]
//  public function addUser(UserPasswordEncoderInterface
//         $passwordEncoder, EntityManagerInterface $entityManager)
        public function addUser(UserPasswordHasherInterface $passwordHasher,  Request $request, EntityManagerInterface $entityManager):Response
        {
        // Créer une instance de l'entité User
        $user = new User();
        $form = $this->createForm(ConnectionType::class, $user);
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {$user = $form->getData();
            $textPassword = $user->getPassword();
            $hashedPassword = $passwordHasher->hashPassword($user,$textPassword);
            $user->setPassword($hashedPassword);
            $user->setRoles(['ROLE_USER']);
            // dd($user);
            $entityManager->persist($user);
            $entityManager->flush();
            }
            
        return $this->render('user/addUser.html.twig', [
        'form' => $form->createView()
        ]);

}

}
