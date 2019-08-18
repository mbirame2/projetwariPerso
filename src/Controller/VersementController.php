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
use App\Form\VersementType;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use App\Entity\Compte;

/**
* @Route("/api")
*
*/
class VersementController extends AbstractFOSRestController
{
  /**
     * @Route("/versement", name="list_des_versements", methods={"GET"})
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
     *@Route("/ajout_versement", name="ajout_versement", methods={"POST"})
     *@Security("has_role('ROLE_Caissier') ")
     */
    public function ajout(Request $request)
    {
       
        $values = json_decode($request->getContent());      
        $connecte = $this->getUser()->getNomComplet();

            if($values->montant > 75000){
        $versement = new Versement();
       
            $versement->setMontant($values->montant);
          
            $versement->setCaissier($connecte);

         
            $compte= $this->getDoctrine()->getRepository(Compte::class)->findOneBy(['numeroCompte' => $values->numeroCompte ]);
   
                $versement->setCompte($compte);
                $versement->setDateVersement(new \Datetime());
                $em=$this->getDoctrine()->getManager();
                $em->persist($versement);
              
                $partenaire=$versement->getCompte();
                $solde=$partenaire->getMontant()+$values->montant;
                $partenaire->setMontant($solde);
                
                $em->persist($versement);
                $em->flush();
        
                return new Response(
                    'Versement bien enregistré '
                   
                );   
             }elseif($values->montant < 75000){

                return new Response(
                    'Veillez saisir un montant superieur à 75 000'
                   
                ); 
             }
    }
}
