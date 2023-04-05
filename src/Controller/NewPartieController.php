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
        $partie->setPartieJoueur1($this->getUser());

        $joueur2 = $utilisateurRepository->find(2);
        $partie->setPartieJoueur1($joueur2);
        $partie->setPartieJoueurTour($joueur1);//mettre $this->getUser()
        $partie->setPartieEtat('en cours');
        $partie->setPartieVictoire(false);

        $partieRepository->save($partie,true);

        $mots = $motRepository->findAll();
        $tMots = [];
        foreach ($mots as $mot) {
            $tMots[] = $mot->getMot();
        }

        $tCartes = [];
        $tCartes[0][1] = 'Noir';
        $tCartes[0][2] = 'Vert';

        $tCartes[1][1] = 'Noir';
        $tCartes[1][2] = 'Noir';

        $tCartes[2][1] = 'Noir';
        $tCartes[2][2] = 'Neutre';

        $tCartes[3][1] = 'Vert';
        $tCartes[3][2] = 'Noir';

        $tCartes[4][1] = 'Neutre';
        $tCartes[4][2] = 'Noir';

        $tCartes[5][1] = 'Vert';
        $tCartes[5][2] = 'Vert';

        $tCartes[6][1] = 'Vert';
        $tCartes[6][2] = 'Vert';

        $tCartes[7][1] = 'Vert';
        $tCartes[7][2] = 'Vert';

        for($i=8; $i<15; $i++) {
            $tCartes[$i][1] = 'Neutre';
            $tCartes[$i][2] = 'Neutre';
        }

        for($i=15; $i<20; $i++) {
            $tCartes[$i][1] = 'Vert';
            $tCartes[$i][2] = 'Neutre';
        }

        for($i=20; $i<25; $i++) {
            $tCartes[$i][1] = 'Neutre';
            $tCartes[$i][2] = 'Vert';
        }
        shuffle($tCartes);
        shuffle($tMots); //mélange du tableau

        for($i=0;$i<25;$i++) {
            $mp = new MotPartie();
            $mp->setPartie($partie);
            $mp->setMot(array_pop($tMots));
            $mp->setMpCouleurJ1($tCartes[$i][1]);
            $mp->setMPCouleurJ2($tCartes[$i][2]);
            $mp->setMpEmplacement($i);
            $mp->setMpTrouve(false);
            $motPartieRepository->save($mp,true);
        }

        return $this->render('new_partie/index.html.twig', [
            'controller_name' => 'NewPartieController',
        ]);
    }
}
