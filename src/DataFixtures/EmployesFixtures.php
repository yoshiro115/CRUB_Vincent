<?php

namespace App\DataFixtures;

use App\Entity\Employes;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class EmployesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        for($i = 1; $i < 10; $i++)
        {
            $employe = new Employes;
            $employe->setPrenom("prenon n°$i")
                    ->setNom("nom n°$i")
                    ->setTelephone(rand($min = 33600000000, $max=33799999970) + $i)
                    ->setEmail("email$i@gmail.com")
                    ->setAdresse("$i rue du truc")
                    ->setPoste("poste n°$i")
                    ->setSalaire(rand($min=1200, $max=3000) + (rand($min=0, $max=100)*$i))
                    ->setDatedenaissance(new \DateTime("0$i/04/2000"));
            $manager->persist($employe);
        }


        $manager->flush();
    }
}
