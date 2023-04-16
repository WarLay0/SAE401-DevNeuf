<?php

namespace App\Controller;

use App\Repository\PartieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JoinPartieController extends AbstractController
{
    #[Route('/join/partie', name: 'app_join_partie')]
    public function index(Request $request, PartieRepository $partieRepository): Response
    {
        $utilisateur = $this->getUser();
        $idPartie = $request->query->get('id');

        // mettre à jour l'entité Partie avec le joueur 2
        $partie = $partieRepository->findOneBy(['id' => $idPartie]);
        $partie->addJoueur($utilisateur);
        $partieRepository->save($partie, true); //sauvegarde les changements

        return $this->redirect('http://localhost:8088/codeNamesDuo/jeu/' . $idPartie);

    }
}
