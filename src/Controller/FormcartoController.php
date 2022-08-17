<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormcartoController extends AbstractController
{
    #[Route('/formcarto', name: 'app_formcarto')]
    public function index(Request $request,ManagerRegistry $doctrine): Response
    {
        $user= new user();
        $form=$this->createForm(UserType::class,$user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user=$form->getData();
           $doctrines= $doctrine->getManager();
           $doctrines->persist($user);
           $doctrines->flush();
            
           $ville=$user->getVille();
            return $this->redirectToRoute('app_carte', array("ville"=>$user->getVille()));
        }


        return $this->render('formcarto/index.html.twig', [
            'controller_name' => 'FormcartoController',
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
}
