<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PartenaireControlleurController extends AbstractController
{
    /**
     * @Route("/partenaire/controlleur", name="partenaire_controlleur")
     */
    public function index()
    {
        return $this->render('partenaire_controlleur/index.html.twig', [
            'controller_name' => 'PartenaireControlleurController',
        ]);
    }
}
