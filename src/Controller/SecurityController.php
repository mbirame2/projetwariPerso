<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Form\UserType;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use App\Repository\UserRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;

/**
* @Route("/api",name="_api")
*/
class SecurityController extends AbstractFOSRestController
{
    private $status="status";
    /**
    * @Route("/register", name="app_register")
    *@Security("has_role('ROLE_AdminWari') or has_role('ROLE_SuperAdminPartenaire')")
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
            if($connecte->getRoles()[0]=='ROLE_AdminWari'){
                $user->setRoles(['ROLE_Caissier']);
                $user->setProprietaire('WARI');
            }else{
                $user->setRoles(['ROLE_USER']);
                $user->setProprietaire($connecte->getProprietaire());
            }
            $user->setStatus('Bloquer?');
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->handleView($this->view([$this->status=>'ok'],Response::HTTP_CREATED));

        }

        return $this->handleView($this->view($form->getErrors()));
    }
    /**
     * @Route("/users",name="users",methods={"GET"})
     * @Security("has_role('ROLE_AdminWari') or has_role('ROLE_SuperAdminPartenaire')")
     */
    public function index(UserRepository $repo)
    {
        $users=$repo->findAll();
        return $this->handleView($this->view($users));
    }
    /**
    * @Route("/login", name="login", methods={"POST"})
    */
    public function login(Request $request)
    {
        $user = $this->getUser();
        if($user->getStatus()=='Debloquer?'){
            return $this->json([
                'username' => $user->getUsername(),
                'roles' => $user->getRoles()
            ]);
        }else{
            $data = [
                'status' => 401,
                'message' => 'compte bloqué'
            ];
            return new JsonResponse($data, 401);
        }
        
    }
    /**
    * @Route("/logout", name="app_logout", methods={"GET"})
    */
    public function logout()
    {
    }
    /**
    * @Route("/user/status/{id}", name="status",methods={"PUT"})
    *@Security("has_role('ROLE_AdminWari') or has_role('ROLE_SuperAdminPartenaire')")
    */
    public function status(User $user)
    {
        if($user->getStatus()=='Débloquer?'){
            $user->setStatus('Bloquer?');
        }else{
            $user->setStatus('Débloquer?');
        }
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();
        return $this->handleView($this->view([$this->status=>'ok'],Response::HTTP_CREATED));
    }
}
