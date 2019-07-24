<?php

namespace App\Controller;

use App\Repository\PartenaireRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PartenaireController extends AbstractController
{


    /**
     * @Route("/api/partenaire", name="list_partenaire", methods={"GET"})
     */
    public function index(PartenaireRepository $partenaireRepository, SerializerInterface $serializer)
    {
        $part = $partenaireRepository->findAll();
        $data = $serializer->serialize($part, 'json');

        return new Response($data, 200, [
            'Content-Type' => 'application/json'
        ]);
    }
}
