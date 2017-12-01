<?php

namespace PV\PlateformeBundle\Controller;

use PV\PlateformeBundle\Entity\Categorie;
use PV\PlateformeBundle\Entity\Video;
use PV\PlateformeBundle\Form\VideoType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class PlateformeController extends Controller
{
    /**
     * @Route("/test")
     */
    public function testAction(){
        $video = new Video();

        $video->setTitre("Titre");
        $video->setDescription("Hello, description de la vidéo");
        $video->setLienVideo("idVidéoYoutube");

        $categorie = new Categorie();
        $categorie->setNom("Humour");
        $categorie->setDescription("Description cat Humour");

        $video->setCategorie($categorie);

        // on récupère le service "validator"
        $validator = $this->get("validator");
        $errors = $validator->validate($video);

        // on renvoi une réponse suivant ce qu'il se passe
        //  - Affichage des erreurs ou message success.
        return new Response( (count($errors)>0) ? (string)$errors : "Video valide" );
    }


    /**
     * @Route("/add/")
     */
    public function addAction(Request $request)
    {
        $video = new Video();

        $form = $this->createForm(VideoType::class, $video);

        if($request->isMethod("POST") && $form->handleRequest($request)->isValid()){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($video);
            $entityManager->flush();
        }

        return $this->render('PVPlateformeBundle:Plateforme:add.html.twig', array(
            "form" => $form->createView()
        ));
    }


    /**
     * @Route("/edit/{id}")
     */
    public function editAction(Request $request, $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $video = $entityManager->getRepository("PVPlateformeBundle:Video")->find($id);

        if($video === null){throw new NotFoundResourceException("Video ".$id." introuvable.");}

        $form = $this->createForm(VideoType::class, $video);

        if($request->isMethod("POST") && $form->handleRequest($request)->isValid()){
            $entityManager->persist($video);
            $entityManager->flush();
        }

        return $this->render('PVPlateformeBundle:Plateforme:edit.html.twig', array(
            "video" => $video,
            "form" => $form->createView()
        ));
    }


    /**
     * @Route("/view/{id}", name="pv_plateforme_view", requirements={"id":"\d+"})
     */
    public function viewAction($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $video = $entityManager->getRepository("PVPlateformeBundle:Video")->find($id);

        // On vérifie que la vidéo existe
        if($video === null){
            throw new NotFoundResourceException("Vidéo ".$id." introuvable.");
        }

        return $this->render('PVPlateformeBundle:Plateforme:video.html.twig', array(
            "video" => $video
        ));
    }


    /**
     * @Route("/category/{id}", name="pv_plateforme_view_cat", requirements={"id":"\d+"})
     */
    public function viewCategorieAction($id)
    {
        $doctrine = $this->getDoctrine();

        // fetch
        $categorie  =  $doctrine->getRepository("PVPlateformeBundle:Categorie")->findById($id);
        $videos = $doctrine->getRepository("PVPlateformeBundle:Video")->getVideosByCategory($categorie);

        dump($categorie);

        return $this->render('PVPlateformeBundle:Plateforme:categorie.html.twig',array(
            "categorie" => $categorie[0],
            "videos" => $videos
        ));
    }

    /**
     * On récupère toute les catégories pour les afficher dans le header.
     */
    public function menuCategorieAction(){
        $categories = $this->getDoctrine()->getManager()->getRepository("PVPlateformeBundle:Categorie")->findAll();

        return $this->render("PVPlateformeBundle:Plateforme:menuDropDownCategorie.html.twig", array(
            "categories" => $categories
        ));
    }
}
