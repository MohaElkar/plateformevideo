<?php

namespace PV\PlateformeBundle\Controller;

use PV\PlateformeBundle\Entity\Video;
use PV\PlateformeBundle\Form\VideoType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class PlateformeController extends Controller
{
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
        $entityManager = $this->getDoctrine()->getManager()->getRepository("PVPlateformeBundle:Video");
        $videos = $entityManager->getVideosByCategory($id);

        dump($videos);

        return $this->render('PVPlateformeBundle:Plateforme:edit.html.twig');
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
