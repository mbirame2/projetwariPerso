<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Compte;
use App\Form\UserType;
use App\Entity\Partenaire;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


/**
* @Route("/api",name="_api")
*/
class SecurityController extends AbstractFOSRestController
{
    private $status="status";
    private $actif="Actif";

    /**
    * @Route("/register/caissier", name="ap",methods={"POST"})
    *@Security("has_role('ROLE_AdminWari') ")
    */
  
        public function ajoutCaissier(Request $request, EntityManagerInterface $entityManager ,UserPasswordEncoderInterface $passwordEncoder)
        {
         
            $values = json_decode($request->getContent());      
          

            $user = new User();
                $user->setUsername($values->username);
                $user->setRoles(["ROLE_Caissier"]);
                $password = $passwordEncoder->encodePassword($user,$values->password);
                $user->setPassword($password);
                $user->setNomComplet($values->nomComplet);
                $user->setStatus($this->actif);
                $user->setProprietaire("AdminWari");
             
        
                $entityManager = $this->getDoctrine()->getManager();
              
                $entityManager->persist($user);
             
                 // relates this partenaire to the compte    
                $entityManager->flush(); 
            
                      

        return new Response(
            'Saved new user with caissier: '.$user->getNomComplet()
           
        );     
           
           
        }
         /**
    * @Route("/register/superadminwari", name="app_reg" ,methods={"POST"})
    *@Security("has_role('ROLE_Partenaire') ")
    */
  
    public function superadminwari(Request $request, EntityManagerInterface $entityManager ,UserPasswordEncoderInterface $passwordEncoder)
    {
        $values = json_decode($request->getContent());      
      

        $user = new User();
            $user->setUsername($values->username);
            $user->setRoles(["ROLE_SuperAdminPartenaire"]);
            $password = $passwordEncoder->encodePassword($user,$values->password);
            $user->setPassword($password);
            $user->setNomComplet($values->nomComplet);
            $user->setStatus($this->actif);
            $user->setProprietaire("AdminWari");
         
    
            $entityManager = $this->getDoctrine()->getManager();
          
            $entityManager->persist($user);
         
             // relates this partenaire to the compte    
            $entityManager->flush(); 
        
                  

    return new Response(
        'Saved new user with AdminWari: '.$user->getNomComplet()
       
    );     
    }

         /**
    * @Route("/register/userpartenaire", name="app_re",methods={"POST"})
    *@Security("has_role('ROLE_Partenaire') ")
    */
  
    public function userpartenaire(Request $request, EntityManagerInterface $entityManager,UserPasswordEncoderInterface $passwordEncoder)
    {
        $values = json_decode($request->getContent());      
      

        $user = new User();
            $user->setUsername($values->username);
            $user->setRoles(["ROLE_User"]);
            $password = $passwordEncoder->encodePassword($user,$values->password);
            $user->setPassword($password);
            $user->setNomComplet($values->nomComplet);
            $user->setStatus($this->actif);
            $connecte = $this->getUser();
            $user->setProprietaire($connecte->getUsername());
         
            $partenaire= $this->getDoctrine()->getRepository(Partenaire::class)->find($connecte->getPartenaire());
                $user->setPartenaire($partenaire);
    
            $entityManager = $this->getDoctrine()->getManager();
          
            $cpt = new Compte();
        $recup = substr($values->username,0,2);  
        while (true) {
            if (time() % 1 == 0) {
                $alea = rand(100,200);
                break;
            }else {
                slep(1);
            }
        }
        $concat =$recup.$alea;
        $cpt->setMontant(0);
        $cpt->setNumeroCompte($concat);
        $cpt->setPartenaire($partenaire);
            $entityManager->persist($user);
            $entityManager->persist($user);
             // relates this partenaire to the compte    
            $entityManager->flush(); 
        
                  

    return new Response(
        'Saved new user with partenaire: '.$user->getNomComplet()
       
    );     
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
    * @Route("/logout", name="app_logout", methods={"GET"})
    */
    public function logout()
    {
    }
    /**
    * @Route("/user/bloquer_user/{id}", name="status",methods={"PUT"})
    *@Security("has_role('ROLE_AdminWari') or has_role('ROLE_SuperAdminPartenaire')")
    */
    public function status(User $user)
    {
        if($user->getStatus()=='Inactif'){
            $user->setStatus($this->actif);
           
        }else{
            $user->setStatus('Inactif');
          
        }
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();
        return $this->handleView($this->view([$this->status=>'ok'],Response::HTTP_CREATED));
    }
}
