<?php

namespace App\Controller;

use App\Entity\MotPartie;
use App\Entity\Partie;
use App\Form\CreationPartieType;
use App\Repository\MotPartieRepository;
use App\Repository\MotRepository;
use App\Repository\PartieRepository;
use App\Repository\UtilisateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreationPartieController extends AbstractController
{
    #[Route('/creation/partie', name: 'app_creation_partie')]
    public function CreationPartie(Request $request,
                                   UtilisateurRepository $utilisateurRepository,
                                   PartieRepository $partieRepository,
                                   MotRepository $motRepository,
                                   MotPartieRepository $motPartieRepository): Response
    {

        $partie = new Partie();
        $form = $this->createForm(CreationPartieType::class, $partie);


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $joueur1 = $this->getUser();
            $joueur2 = $form->get('partieJoueur2')->getData();
            $partie->setPartieEtat('en cours');
            $partie->setPartieVictoire(false);
            $partie->setPartieNBTour(12);
            $partie->setPartieJoueurTour($joueur1->getUtilisateurPseudo());
            $partie->addJoueur($joueur1);

            $utilisateur2 = $utilisateurRepository->findOneBy(['utilisateur_email' => $joueur2]);



            if (empty($joueur2)){
                $joueur2 = null;
            }
            elseif (!isset($utilisateur2)) {
                $this->addFlash('danger', 'L\'utilisateur avec cet e-mail n\'existe pas.');
                return $this->redirectToRoute('app_creation_partie');
            }
            else{

                $partie->addJoueur($joueur1);
                $partie->addJoueur($utilisateur2);
            }


            $partieRepository->save($partie,true);

            $mots = $motRepository->findAll();
            $tMots = [];
            foreach ($mots as $mot) {
                $tMots[] = $mot;
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
                $mp->setMpCouleurJ2($tCartes[$i][2]);
                $mp->setMpJeton1(false);
                $mp->setMpJeton2(false);
                $mp->setMpEmplacement($i);
                $mp->setMpTrouve(false);
                $motPartieRepository->save($mp,true);
            }




        }

        return $this->render('creation_partie/index.html.twig', [
            'formCreationPartie' => $form->createView(),
        ]);
    }
}
