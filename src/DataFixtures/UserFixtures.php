<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UserFixtures extends Fixture
{
    public function __construct(UserPasswordEncoderInterface $passwordEncoder ){
    $this->passwordEncoder = $passwordEncoder;  
    }
   
    public function load(ObjectManager $manager)
    {
       
        $supad = new User();
        $supad->setUsername("BirameAdminWari")
            ->setNomComplet("Birame MBOUP");
            $passwordEncoder= $this->passwordEncoder->encodePassword($supad, 'adminWari');
            $supad->setPassword($passwordEncoder)
            ->setProprietaire("WARI")
            ->setStatus("Null")
            ->setRoles(['ROLE_AdminWari']);
        $manager->persist($supad);
        $manager->flush();
    }
}
