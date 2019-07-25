<?php

namespace App\Controller;

use App\Entity\Versement;
use App\Repository\VersementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class VersementController extends AbstractController
{
  /**
     * @Route("/api/versement", name="list_des_versements", methods={"GET"})
     */
    public function index(VersementRepository $versementRepository, SerializerInterface $serializer)
    {
        $versement = $versementRepository->findAll();
        $data = $serializer->serialize($versement, 'json');

        return new Response($data, 200, [
            'Content-Type' => 'application/json'
        ]);
    }

     /**
     * @Route("/api/ajout_versement", name="versement", methods={"POST"})
     */
    public function new(Request $request, SerializerInterface $serializer, EntityManagerInterface $entityManager, ValidatorInterface $validator)
    {
        $versement = $serializer->deserialize($request->getContent(), Versement::class, 'json');
        $errors = $validator->validate($versement);
        if (count($errors)) {
            $errors = $serializer->serialize($errors, 'json');
            return new Response($errors, 500, [
                'Content-Type' => 'application/json'
            ]);
        }
        var_dump($versement);
        die();
        $entityManager->persist($versement);
        $entityManager->flush();
        
        $data = [
            'status' => 201,
            'message' => 'Le versement a bien été ajouté'
        ];
        $partenaire=$versement->getPartenaire();
        $solde=$partenaire->getSolde()+$versement->getMontant();
        $partenaire->setSolde($solde);
        
        $entityManager->persist($partenaire);
        $entityManager->flush();
    
        return new JsonResponse($data, 201);
    }
}
