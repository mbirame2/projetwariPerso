<?php

namespace App\Controller;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Entity\User;
use App\Entity\Compte;
use App\Form\UserType;
use App\Entity\Partenaire;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
* @Route("/api",name="_api")
*/
class SecurityController extends FOSRestController
{
    private $status="status";
    private $actif="Actif";
    private $inactif="Inactif";
    private $image="imageFile";

  
    /**
    * @Route("/register/caissier", name="ap",methods={"POST"})
    *@Security("has_role('ROLE_AdminWari') ")
    */
  
        public function ajoutCaissier(Request $request, EntityManagerInterface $entityManager ,UserPasswordEncoderInterface $passwordEncoder)
        {
         
            $utilisateur = new User();
            $form=$this->createForm(UserType::class , $utilisateur);
            $form->handleRequest($request);
            $data=$request->request->all();
            $file= $request->files->all()[$this->image];
                $entityManager = $this->getDoctrine()->getManager();
             $form->submit($data);
            $utilisateur->setRoles(["ROLE_Caissier"]);
            $utilisateur->setStatus($this->actif);
            $utilisateur->setProprietaire('AdminWari');
            $utilisateur->setImageFile($file);
            $utilisateur->setPassword($passwordEncoder->encodePassword($utilisateur,
            $form->get('password')->getData() ) 
                );
            $entityManager = $this->getDoctrine()->getManager();
       
            $entityManager->persist($utilisateur);
            $entityManager->flush();
            
                      

        return new Response(
            'Saved new user with caissier: '.$utilisateur->getNomComplet()
           
        );     
           
           
        }
         /**
    * @Route("/register/superadminpartenaire", name="app_reg" ,methods={"POST"})
    *@Security("has_role('ROLE_Partenaire') ")
    */
  
    public function superadminwari(Request $request, EntityManagerInterface $entityManager ,UserPasswordEncoderInterface $passwordEncoder)
    {
      
        $utilisateur = new User();
        $form=$this->createForm(UserType::class , $utilisateur);
        $form->handleRequest($request);
        $data=$request->request->all();
        $file= $request->files->all()[$this->image];
            $entityManager = $this->getDoctrine()->getManager();
         $form->submit($data);
        $utilisateur->setRoles(["ROLE_SuperAdminWari"]);
        $utilisateur->setStatus($this->actif);
        $utilisateur->setProprietaire('Partenaire');
        $utilisateur->setImageFile($file);
        $utilisateur->setPassword($passwordEncoder->encodePassword($utilisateur,
        $form->get('password')->getData() ) 
            );
        $entityManager = $this->getDoctrine()->getManager();
   
        $entityManager->persist($utilisateur);
        $entityManager->flush();
         
                  

    return new JSONResponse(
        'Saved new user with AdminWari: '.$utilisateur->getNomComplet()
       
    );     
    }

         /**
    * @Route("/register/userpartenaire", name="app_re",methods={"POST"})
    *@Security("has_role('ROLE_Partenaire') ")
    */
  
    public function userpartenaire(Request $request, EntityManagerInterface $entityManager,UserPasswordEncoderInterface $passwordEncoder)
    {


        $utilisateur = new User();
        $form=$this->createForm(UserType::class , $utilisateur);
        $form->handleRequest($request);
        $data=$request->request->all();
       $file= $request->files->all()[$this->image];
           $entityManager = $this->getDoctrine()->getManager();
        $form->submit($data);
        $utilisateur->setPassword($passwordEncoder->encodePassword($utilisateur,
        $form->get('password')->getData() ) 
            );
            $utilisateur->setRoles(["ROLE_User"]);
            $utilisateur->setStatus('Actif');
            $utilisateur->setProprietaire('AdminWari');
            $utilisateur->setImageFile($file);
            $connecte = $this->getUser();
             $partenaire= $this->getDoctrine()->getRepository(Partenaire::class)->find($connecte->getPartenaire());
                $utilisateur->setPartenaire($partenaire);
                $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($utilisateur);
        $entityManager->flush();

        $cpt = new Compte();
        $recup = substr($utilisateur->getNomComplet(),0,2);  
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
            $entityManager->persist($utilisateur);
            $entityManager->persist($cpt);
             // relates this partenaire to the compte    
            $entityManager->flush(); 
        
                  

    return new Response(
        'Saved new user with partenaire: '.$utilisateur->getNomComplet()
       
    );     
    }


    
     /**
     * @Route("/login", name="token", methods={"POST"})
     * @param Request $request
     * @param JWTEncoderInterface $JWTEncoder
     * @return JsonResponse
     * @throws \Lexik\Bundle\JWTAuthenticationBundle\Exception\JWTEncodeFailureException
     */

    public function index(UserRepository $repo ,Request $request, UserPasswordEncoderInterface $passwordEncoder, JWTEncoderInterface $JWTEncoder)
    {
       
        $values = json_decode($request->getContent()); 
       $username=$values->username;
       $password=$values->password;
        $partenaire= $this->getDoctrine()->getRepository(User::class)->findOneBy(['username'=>$username]);
        if (!$partenaire) {
            throw $this->createNotFoundException('User Not Found');
        }
        $isValid =  $passwordEncoder->isPasswordValid($partenaire, $password);
     
            if (!$isValid) {
                return new Response('Le mot de passe saisi est incorrecte');
            }
           if($partenaire->getStatus()==$this->inactif){
            return new Response('Accés refusé vous étes bloqués');
           }elseif($partenaire->getStatus()==$this->actif){
           $token = $JWTEncoder->encode([
            'username' => $username,
            'roles'=> $partenaire->getRoles(),
            'exp' => time() + 3600 // 1 hour expiration
        ]);
    }

    return new  JsonResponse(['token' => $token]);

    }
  
    /**
    * @Route("/logout", name="app_logout", methods={"GET"})
    */
    public function logout()
    {
    }
    /**
    * @Route("/user/bloquer_user/{id}", name="status",methods={"PUT"})
    *
    */
    public function status(User $user)
    {
        if($user->getStatus()==$this->inactif){
            $user->setStatus($this->actif);
           
        }else{
            $user->setStatus($this->inactif);
          
        }
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();
        return $this->handleView($this->view([$this->status=>'ok'],Response::HTTP_CREATED));
    }
     /**
    * @Route("/contrat", name="contrat",methods={"GET"})
    *@Security("has_role('ROLE_AdminWari') ")
    */
    public function stat()
    {

        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        
        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('default/mypdf.html.twig', [
            'title' => "Welcome to our PDF Test"
        ]);
        
        // Load HTML to Dompdf
        $dompdf->loadHtml('');
        
        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => true
        ]);
        
    }
    
}
