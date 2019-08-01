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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;

class PartenaireController extends AbstractController
{

    
    private $content='Content-Type';
    private $application='application/json';

    /**
     * @Route("/api/partenaire", name="list_partenaire", methods={"GET"})
     */
    public function index(PartenaireRepository $partenaireRepository, SerializerInterface $serializer)
    {
        $part = $partenaireRepository->findAll();
        $data = $serializer->serialize($part, 'json');

        return new Response($data, 200, [
            $this->content => $this->application
        ]);
    }
    /**
     * @Route("/api/ajout_partenaire", name="ajout_partenaire", methods={"POST"})
     */
    public function new(Request $request, SerializerInterface $serializer, EntityManagerInterface $entityManager, ValidatorInterface $validator, UserPasswordEncoderInterface $passwordEncoder)
    {
        $part = $serializer->deserialize($request->getContent(), Partenaire::class, 'json');
        $errors = $validator->validate($part);
        if (count($errors)) {
            $errors = $serializer->serialize($errors, 'json');
            return new Response($errors, 500, [
                $this->content => $this->application
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
        $user->setProprietaire($part->getId());
        $entityManager->persist($user);
        $entityManager->flush();
        return new JsonResponse($data, 201);
    }

    /**
    * @Route("/api/partenaire/{id}", name="modifier_partenaire", methods={"PUT"})
    */
    public function update(Request $request, SerializerInterface $serializer, Partenaire $partenaire, ValidatorInterface $validator, EntityManagerInterface $entityManager)
    {
    $partenaireUpdate = $entityManager->getRepository(Partenaire::class)->find($partenaire->getId());
    $data = json_decode($request->getContent());
    foreach ($data as $key => $value){
        if($key && !empty($value)) {
            $name = ucfirst($key);
            $setter = 'set'.$name;
            $partenaireUpdate->$setter($value);
        }
    }
    $errors = $validator->validate($partenaireUpdate);
    if(count($errors)) {
        $errors = $serializer->serialize($errors, 'json');
        return new Response($errors, 500, [
            'Content-Type' => 'application/json'
        ]);
    }
    $entityManager->flush();
    $data = [
        'status' => 200,
        'message' => 'Le partenaire a bien été mis à jour'
    ];
    return new JsonResponse($data);
    }



}
