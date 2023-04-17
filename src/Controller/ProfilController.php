<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{
    #[Route('/{_locale}/profil', name: 'app_profil', requirements:
        ['_locale' => 'en|fr',
        ],
    )]
    public function RecupererUtilisateur(): Response
    {
        $utilisateur = $this->getUser();

        return $this->render('profil/index.html.twig', [
            'Utilisateur' => $utilisateur,
        ]);
    }
}
