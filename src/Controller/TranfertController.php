<?php

namespace App\Controller;

use App\Entity\Tarif;
use App\Entity\Compte;
use App\Entity\EnvoiArgent;
use App\Form\EnvoiArgentType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\Serializer\SerializerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
* @Route("/api",name="_api")
*/
class TranfertController extends FOSRestController
{
    /**
     * @Route("/envoieargent", name="tranfert" ,methods={"POST"})
     * @Security("has_role('ROLE_User')")
     */
    public function index(Request $request, EntityManagerInterface $entityManager )
    {
        $utilisateur = new EnvoiArgent();
        $form=$this->createForm(EnvoiArgentType::class , $utilisateur);
        $form->handleRequest($request);
        $data=$request->request->all();
         $form->submit($data);
        $utilisateur->setDatedelivrance(new \Datetime());
        while (true) {
            if (time() % 1 == 0) {
                $alea = rand(100,1000000);
                break;
            }else {
                slep(1);
            }
        }
  
     


        $vo= $form->get('montantaverser')->getData();
    $compte= $this->getDoctrine()->getRepository(Tarif::class)->findAll();
    foreach($compte as $values){
        $values->getBorneInferieur();
        $values->getBorneSuperieur();
        $values->getValeur();
        if($vo>=$values->getBorneInferieur() && $vo<=$values->getBorneSuperieur() ){
$vop=$values->getValeur();
        }
     }

 
        $utilisateur->setEnvoitarif(($vop*10)/100);
        $utilisateur->setReceveurtarif(($vop*20)/100);
        $utilisateur->setCodeTransfert($alea);
        $is=$this->getUser();
        $utilisateur->setUser($is);
        $entityManager->persist($utilisateur);
        $entityManager->flush();
        $comp= $this->getDoctrine()->getRepository(Compte::class)->findOneBy(['partenaire' => $is->getPartenaire()]);
     

        if($comp->getMontant() > $utilisateur->getMontantaverser() ){
       $mo= $comp->getMontant()-$utilisateur->getMontantaverser()+$utilisateur->getEnvoitarif();
    

       $comp->setMontant($mo);
       $entityManager->persist($comp);
       $entityManager->flush();
       return new Response('Le transfert a été effectué avec succés.        Voici le code : '.$utilisateur->getCodeTransfert());
        }else{
            return new Response('Le solde de votre compte ne vous permet d effectuer une transaction');
        }
     
}

 /**
     * @Route("/retraitargent", name="tranfertok" ,methods={"POST"})
     * @Security("has_role('ROLE_User')")
     */
    public function retrait(Request $request, EntityManagerInterface $entityManager )
    {
        $values = json_decode($request->getContent());   
        $comp= $this->getDoctrine()->getRepository(EnvoiArgent::class)->findOneBy(['codeTransfert' => $values->coderetrait]);   
if(!$comp){
   
   return new Response('Le code saisi est incorecte .Veillez ressayer un autre  '); 

}else{

    $is=$this->getUser();
    $com= $this->getDoctrine()->getRepository(Compte::class)->findOneBy(['partenaire' => $is->getPartenaire()]);
     
   $mo= $com->getMontant()+$comp->getMontantaverser()+$comp->getEnvoitarif();


   $com->setMontant($mo);
   $entityManager->persist($comp);
   $entityManager->flush();
}
    }
    /**
     *  @Route("/retrait_test", name="tranfe" ,methods={"POST"})
     * @Security("has_role('ROLE_User')")
     */
    public function tes(Request $request, EntityManagerInterface $entityManager,SerializerInterface $serializer )
    {
        $values = json_decode($request->getContent());  
        $comp= $this->getDoctrine()->getRepository(EnvoiArgent::class)->findOneBy(['codeTransfert' => $values->coderetrait]);   
        if(!$comp){
   
            return ('Le code saisi est incorecte .Veillez ressayer un autre  '); 
         
        }else{
            return ($comp);
        }
    }
}
