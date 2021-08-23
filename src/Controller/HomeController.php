<?php

/*
 * Phototec
 * Symfony 5
 * Christine Zedday
 */

namespace App\Controller;

use App\Service\Generator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     *  @Route("/ajouter", name="ajouter", methods={"GET", "POST"})
     */
    public function ajouterDossier(Request $request): Response
    {
        $form = $this->createFormBuilder()
       
        ->add('dossier', FileType::class)
       
      
        ->getForm();


    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        // data is an array with "name", "email", and "message" keys
        $data = $form->getData();
        $fichier = $data['dossier'];
        $dossier = pathinfo($fichier);
        dd($dossier);
    }
        
        
        
        
        return $this->render('ajouter/ajouter.html.twig', [
            'controller_name' => 'HomeController', 'form' => $form->createView(),
        ]);
    }

    //  /**
    //  *  @Route("/enregistrer", name="enregistrer")
    //  */
    // public function enregistrerDossier(Request $request): Response
    // {
    //     if ($form->isValid()) {


    //         return $this->redirectToRoute('home');   
    //     } 
        
    //     return $this->redirectToRoute('home');
    // }


    
}
