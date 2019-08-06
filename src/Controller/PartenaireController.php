<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Compte;
use App\Entity\Partenaire;
use App\Repository\PartenaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

     /**
     * @Route("/api", name="liste_partenaire")
     * @Security("has_role('ROLE_AdminWari')")
     */
 
class PartenaireController extends AbstractController
{
    private $content='Content-Type';
    private $application='application/json';
    /**
     * @Route("/partenaire", name="liste_partenaire", methods={"GET"})
     */
    public function index(PartenaireRepository $partenaireRepository, SerializerInterface $serializer)
    {
       $part=$partenaireRepository->findAll();
       $data=$serializer->serialize($part, 'json');

       return new Response($data, 200, [
           $this->content => $this->application
       ]);
    }
    /**
     * @Route("/ajout_partenaire", name="ajout_partenaire", methods={"POST"})
     */
    public function new(Request $request, SerializerInterface $serializer, EntityManagerInterface $entityManager,  UserPasswordEncoderInterface $passwordEncoder){

        $values = json_decode($request->getContent());      
        $partenaire = new Partenaire();
            $partenaire->setRaisonSocial($values->raisonSocial);
            $partenaire->setNinea($values->ninea);
            $partenaire->setAdresse($values->adresse);
            $entrp=$values->raisonSocial;

        $user = new User();
            $user->setUsername($values->username);
            $user->setRoles(["ROLE_Partenaire"]);
            $password = $passwordEncoder->encodePassword($user,$values->password);
            $user->setPassword($password);
            $user->setNomComplet($values->nomComplet);
            $user->setStatus('Actif');
           
            $user->setProprietaire($values->raisonSocial);
        $cpt = new Compte();
        $recup = substr($entrp,0,2);  
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
           // relates this user to the partenaire   
        $user->setPartenaire($partenaire);
        
        if ($partenaire) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($partenaire);
            $entityManager->persist($user);
            $entityManager->persist($cpt);
             // relates this partenaire to the compte    
            $entityManager->flush(); 
    }
    return new Response(
        'Saved new user with name: '.$user->getNomComplet()
        .' and new partenaire with raisonSocial: '.$partenaire->getRaisonSocial() .'and new compte with compte number'.
        $cpt->getNumeroCompte()
    );   
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
