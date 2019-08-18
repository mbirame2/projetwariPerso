<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Compte;
use App\Form\UserType;
use App\Form\CompteType;
use App\Entity\Partenaire;
use App\Form\PartenaireType;
use App\Repository\PartenaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\FOSRestController;
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
 
class PartenaireController extends FOSRestController
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

        $prest= new Partenaire();
        $form = $this->createForm(PartenaireType::class, $prest);
        $data=$request->request->all();
        $file= $request->files->all()['imageFile'];
        $form->submit($data);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($prest);

        $utilisateur = new User();
        $form=$this->createForm(UserType::class , $utilisateur);
        $form->handleRequest($request);
        $form->submit($data);
        $utilisateur->setRoles(["ROLE_Partenaire"]);
        $utilisateur->setStatus('Actif');
        $utilisateur->setProprietaire($form->get('nomComplet')->getData());
        $utilisateur->setImageFile($file);
        $utilisateur->setPassword($passwordEncoder->encodePassword($utilisateur,
        $form->get('password')->getData() ) 
            );
        $entityManager = $this->getDoctrine()->getManager();
        $utilisateur->setPartenaire($prest);
        $entityManager->persist($utilisateur);
        $entityManager->flush();
        
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

        $compt = new Compte();
        $form = $this->createForm(CompteType::class, $compt);
        $data=$request->request->all();
        $form->submit($data);
        $compt->setNumeroCompte($concat);
        $compt->setMontant(0);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($compt);
        $entityManager->flush();



    return new Response(
        'Saved new user with name: '.$utilisateur->getNomComplet()
        .' and new partenaire with raisonSocial: '.$prest->getRaisonSocial() .'and new compte with compte number'.
        $compt->getNumeroCompte()
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
