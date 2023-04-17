<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RulesController extends AbstractController
{
    #[Route('/{_locale}/rules', name: 'app_rules', requirements:
        ['_locale' => 'en|fr',
        ],
    )]
    public function index(Request $request): Response
    {
        $locale = $request->getLocale();
        return $this->render('rules/index.html.twig', [
            'controller_name' => 'RulesController',
            'locale' => $locale,
        ]);
    }
}
