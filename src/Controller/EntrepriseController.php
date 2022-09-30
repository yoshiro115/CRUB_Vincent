<?php

namespace App\Controller;

use App\Entity\Employes;
use App\Form\EmployesType;
use App\Repository\EmployesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EntrepriseController extends AbstractController
{
    #[Route('/', name: 'app_entreprise')]
    #[Route("/{id}", name:"employe_edit")]
    public function fourreTout(Request $globals, EntityManagerInterface $manager, Employes $employe= null, EmployesRepository $repo): Response
    {
        $employes= $repo->findAll();
        if($employe == null):
            $employe = new Employes;
        endif;


        $form= $this->createForm(EmployesType::class, $employe );

        $form->handleRequest($globals);


        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($employe);
            $manager->flush();
            return $this->redirectToRoute('app_entreprise');
        }

        return $this->renderForm('entreprise/index.html.twig', [
            "formEmploye" => $form,
            "editMode" => $employe->getId() !== null,
            'employes' => $employes
        ]);



    }
    #[Route("/entreprise/delete/{id}", name:"employe_delete")]
    public function delete($id, EntityManagerInterface $manager, EmployesRepository $repo)
    {
        $employe= $repo->find($id);

        $manager->remove($employe);
        $manager->flush();
        return $this->redirectToRoute('app_entreprise');
    }
}
