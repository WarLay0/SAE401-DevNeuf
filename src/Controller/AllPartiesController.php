<?php

namespace App\Controller;

use App\Repository\PartieRepository;
use App\Repository\UtilisateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AllPartiesController extends AbstractController
{
    #[Route('/allparties', name: 'app_all_parties')]
    public function AllParties(PartieRepository $partieRepository, UtilisateurRepository $utilisateurRepository): Response
    {

        $utilisateur = $this->getUser();
        $parties = $partieRepository->findPartiesEnCoursPourUtilisateurConnecte($utilisateur->getUtilisateurId());
        $allParties = $partieRepository->findAllPartiesLibre($utilisateur->getUtilisateurId());


        return $this->render('all_parties/index.html.twig', [
            'parties' => $parties,
            'utilisateurs' => $utilisateur,
            'allParties' => $allParties,
        ]);
    }
}
