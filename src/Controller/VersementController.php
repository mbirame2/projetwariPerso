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
     */
    public function ajout(Request $request)
    {
        $versement = new Versement();
        $form=$this->createForm(VersementType::class,$versement);
        $data=json_decode($request->getContent(),true);
        $form->submit($data);
        
        if($form->isSubmitted() && $form->isValid()){
            var_dump($versement);
            $versement->setDateVersement(new \Datetime());
            $connecte = $this->getUser();
            $versement->setCaissier($connecte->getId());
            $em=$this->getDoctrine()->getManager();
            $em->persist($versement);
            $em->flush();
            $partenaire=$versement->getCompte();
            $solde=$partenaire->getMontant()+$versement->getMontant();
            $partenaire->setMontant($solde);
            
            $em->persist($partenaire);
            $em->flush();
            return $this->handleView($this->view(['status'=>'ok'],Response::HTTP_CREATED));
        }
        return $this->handleView($this->view($form->getErrors()));
        
    }
}
