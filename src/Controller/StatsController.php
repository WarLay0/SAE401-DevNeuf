<?php

namespace App\Controller;

use App\Repository\VshistoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\StatsRepository;

class StatsController extends AbstractController
{
    #[Route('/{_locale}/stats', name: 'app_stats', requirements:
        ['_locale' => 'en|fr',
        ],
    )]
    public function index(StatsRepository $statsRepository, VshistoryRepository $vshistoryRepository): Response
    {
//        Si les stats sont vides renvoyer pas de stats sinon renvoyer les stats
        $stats = $statsRepository->findOneBy(['id' => '1']);
        if ($stats === null) {
            $returnStats = 'No stats';
        }else{
            $returnStats = $stats;
        }
        return $this->render('stats/index.html.twig', [
            'controller_name' => 'StatsController',
            'stats' => $returnStats,
            'vs' => $vshistoryRepository->findAll(),
        ]);
    }
}