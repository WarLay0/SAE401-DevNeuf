<?php

namespace App\Controller;

use App\Entity\MotPartie;
use App\Entity\Partie;
use App\Repository\MotPartieRepository;
use App\Repository\MotRepository;
use App\Repository\PartieRepository;
use App\Repository\UtilisateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewPartieController extends AbstractController
{
    #[Route('/new/partie', name: 'app_new_partie')]
    public function NewPartie(
        Request $request,
        MotPartieRepository $motPartieRepository,
        PartieRepository $partieRepository,
        MotRepository $motRepository,
        UtilisateurRepository $utilisateurRepository,
    ): Response
    {

        $joueur1 = $joueur2 = $utilisateurRepository->find(1);
        $partie = new Partie();
        $partie->$this->getUser();

        $joueur2 = $utilisateurRepository->find(2);
        $partie->$this->getUser($joueur2);
        $partie->setTourJoueur($joueur1);//mettre $this->getUser()
        $partie->setEtatPartie('en cours');
        $partie->setVistoire(false);

        return $this->render('new_partie/index.html.twig', [
            'controller_name' => 'NewPartieController',
        ]);
    }
}
