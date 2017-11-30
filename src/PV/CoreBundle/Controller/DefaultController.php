<?php

namespace PV\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="pv_plateforme_index")
     */
    public function indexAction()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $videos = $entityManager->getRepository("PVPlateformeBundle:Video")->findAll();

        return $this->render('PVPlateformeBundle:Plateforme:index.html.twig', array(
            "videos" => $videos
        ));
    }
}
