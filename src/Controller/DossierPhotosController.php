<?php

namespace App\Controller;

use App\Entity\DossierPhotos;
use App\Form\DossierPhotosType;
use App\Repository\DossierPhotosRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;


/**
 * @Route("/dossier")
 */
class DossierPhotosController extends AbstractController
{
   

 
     /**
     *  @Route("/seeding", name="seeding", methods={"GET", "POST"})
     */
    public function seedDossiers(Request $request): Response
    {
        $manager = $this->getDoctrine()->getManager();
        $racine = $this->getParameter('Racine'); //paramètre yaml
        chargeDossier($manager, $racine);
       
        return $this->redirectToRoute('dossier_photos_index');
    }
    
     /**
     *  @Route("/ajouter", name="ajouter", methods={"GET", "POST"})
     */
    public function ajouterDossier(Request $request): Response
    {

        $form = $this->createFormBuilder()
       
        ->add('dossierPhotos', EntityType::class, array('class'=>'DossierPhotos', 'choice_label'=>'nom'))
       
      
        ->getForm();


    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        // data is an array with "name", "email", and "message" keys
        $data = $form->getData();
        $fichier = $data['dossierPhotos'];
        
        dd($fichier);
    }
        
        return $this->render('ajouter/ajouter.html.twig', [
             'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/", name="dossier_photos_index", methods={"GET"})
     */
    public function index(DossierPhotosRepository $dossierPhotosRepository): Response
    {
        return $this->render('dossier_photos/index.html.twig', [
            'dossier_photos' => $dossierPhotosRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="dossier_photos_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $dossierPhoto = new DossierPhotos();
        $form = $this->createForm(DossierPhotosType::class, $dossierPhoto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($dossierPhoto);
            $entityManager->flush();

            return $this->redirectToRoute('dossier_photos_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('dossier_photos/new.html.twig', [
            'dossier_photo' => $dossierPhoto,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="dossier_photos_show", methods={"GET"})
     */
    public function show(DossierPhotos $dossierPhoto): Response
    {
        return $this->render('dossier_photos/show.html.twig', [
            'dossier_photo' => $dossierPhoto,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="dossier_photos_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, DossierPhotos $dossierPhoto): Response
    {
        $form = $this->createForm(DossierPhotosType::class, $dossierPhoto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('dossier_photos_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('dossier_photos/edit.html.twig', [
            'dossier_photo' => $dossierPhoto,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="dossier_photos_delete", methods={"POST"})
     */
    public function delete(Request $request, DossierPhotos $dossierPhoto): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dossierPhoto->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($dossierPhoto);
            $entityManager->flush();
        }

        return $this->redirectToRoute('dossier_photos_index', [], Response::HTTP_SEE_OTHER);
    }
}
function chargeDossier($manager, $racine) {
    $nb_dossiers = 0;
    if ($dir = @opendir($racine)) {
        while(false !== ($dossier = readdir($dir))) {
            
            if($dossier != '.' && $dossier != '..' && pathinfo($dossier, PATHINFO_EXTENSION)== null) {
                $nb_dossiers ++;
                $dossierNouveau = New DossierPhotos();
                $dossierNouveau->setNom($dossier) ;
                $dossierNouveau->setChemin($racine) ;
                $manager->persist($dossierNouveau);
                $depart = $racine.'/'.$dossier;
                chargeDossier($manager, $depart);
            }
        }
        $manager->flush();
        
    }
    else {
        echo ("pas glop");
    }
}
