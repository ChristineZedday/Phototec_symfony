<?php

namespace App\Controller;

use App\Entity\Dossier;
use App\Form\DossierType;
use App\Repository\DossiersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


/**
 * @Route("/dossier")
 */
class DossierController extends AbstractController
{
    /**
     * @Route("/", name="dossier_index", methods={"GET"})
     */
    public function index(DossiersRepository $dossiersRepository): Response
    {
        return $this->render('dossier/index.html.twig', [
            'dossiers' => $dossiersRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="dossier_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $dossier = new Dossier();
        $form = $this->createForm(DossierType::class, $dossier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($dossier);
            $entityManager->flush();

            return $this->redirectToRoute('dossier_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('dossier/new.html.twig', [
            'dossier' => $dossier,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="dossier_show", methods={"GET"})
     */
    public function show(Dossier $dossier): Response
    {
        return $this->render('dossier/show.html.twig', [
            'dossier' => $dossier,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="dossier_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Dossier $dossier): Response
    {
        $form = $this->createForm(DossierType::class, $dossier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('dossier_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('dossier/edit.html.twig', [
            'dossier' => $dossier,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="dossier_delete", methods={"POST"})
     */
    public function delete(Request $request, Dossier $dossier): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dossier->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($dossier);
            $entityManager->flush();
        }

        return $this->redirectToRoute('dossier_index', [], Response::HTTP_SEE_OTHER);
    }

    
    /**
     *  @Route("/ajouter", name="ajouter", methods={"GET", "POST"})
     */
    public function ajouterDossier(Request $request): Response
    {
        $form = $this->createFormBuilder()
       
        ->add('dossier', EntityType::class, array('class'=>Dossiers, choiceLabel=>'nom'))
       
      
        ->getForm();


    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        // data is an array with "name", "email", and "message" keys
        $data = $form->getData();
        $fichier = $data['dossier'];
        
        dd($fichier);
    }
        
        
        
        
        return $this->render('ajouter/ajouter.html.twig', [
             'form' => $form->createView(),
        ]);
    }
}
