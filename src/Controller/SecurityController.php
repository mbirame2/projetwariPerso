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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
* @Route("/api",name="_api")
* @Security("has_role('ROLE_AdminWari') or has_role('ROLE_SuperAdminPartenaire')")
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
            $connecte = $this->getUser();
            //var_dump($connecte);die;
            if($connecte->getRoles()[0]=='ROLE_AdminWari'){
                $user->setRoles(['ROLE_Caissier']);
                $user->setProprietaire('WARI');
            }else{
                $user->setRoles(['ROLE_USER']);
                $user->setProprietaire($connecte->getProprietaire());
            }
            $user->setStatus('Débloquer?');
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->handleView($this->view(['status'=>'ok'],Response::HTTP_CREATED));

        }

        return $this->handleView($this->view($form->getErrors()));
    }
    /**
    * @Route("/login", name="login", methods={"POST"})
    */
    public function login(Request $request)
    {
        $user = $this->getUser();
        return $this->json([
            'username' => $user->getUsername(),
            'roles' => $user->getRoles()
        ]);
    }
    /**
    * @Route("/logout", name="app_logout", methods={"GET"})
    */
    public function logout()
    {}
}
