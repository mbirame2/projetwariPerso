<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Form\UserType;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Response;

/**
* @Route("/api",name="_api")
*/
class SecurityController extends FOSRestController
{
    /**
    * @Route("/register", name="app_register")
    */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        $data=json_decode($request->getContent(),true);
        $form->submit($data);
        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $user->setRoles(['ROLE_AdminWari']);
            $user->setStatus('Actif');
            $user->setProprietaire($user->getUsername());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // do anything else you need here, like send an email

            return $this->handleView($this->view(['status'=>'ok'],Response::HTTP_CREATED));

        }

        return $this->handleView($this->view($form->getErrors()));
    }
}
