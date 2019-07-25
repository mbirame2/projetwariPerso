<?php

namespace App\Controller;

use App\Repository\PartenaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Partenaire;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;

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
    /**
     * @Route("/api/ajout_partenaire", name="ajout", methods={"POST"})
     */
    public function new(Request $request, SerializerInterface $serializer, EntityManagerInterface $entityManager, ValidatorInterface $validator, UserPasswordEncoderInterface $passwordEncoder)
    {
        $part = $serializer->deserialize($request->getContent(), Partenaire::class, 'json');
        $errors = $validator->validate($part);
        if (count($errors)) {
            $errors = $serializer->serialize($errors, 'json');
            return new Response($errors, 500, [
                'Content-Type' => 'application/json'
            ]);
        }
        $entityManager->persist($part);
        $entityManager->flush();
        
        $data = [
            'status' => 201,
            'message' => 'Le partenaire a bien été ajouté'
        ];
        $user = new User();
        $user->setUsername("part".$part->getId());
        $user->setPassword(
            $passwordEncoder->encodePassword(
                $user,
                'passer'
            )
        );
        $user->setNomComplet($part->getRaisonSocial());
        $user->setRoles(['ROLE_SuperAdminPartenaire']);
        $user->setStatus('Actif');
        $user->setProprietaire($user->getUsername());
        $entityManager->persist($user);
        $entityManager->flush();
        return new JsonResponse($data, 201);
    }
}
