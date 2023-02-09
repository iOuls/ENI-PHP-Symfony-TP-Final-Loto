<?php

namespace App\Controller;

use App\Repository\GrilleRepository;
use App\Repository\TirageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home_index')]
    public function index(
        GrilleRepository $gR,
        TirageRepository $tR
    ): Response
    {
        $nbGrilles = count($gR->findBy([
            'user' => $this->getUser()
        ]));

        $nbGrillesEnCoursUser = count($gR->findBy([
            'user' => $this->getUser(),
            'tiree' => false
        ]));

        $nbGrillesEnCours = count($gR->findBy([
            'tiree' => false
        ]));

        $argentEnJeu = $nbGrillesEnCours * 2.2;

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'nbGrilles' => $nbGrilles,
            'nbGrillesEnCoursUser' => $nbGrillesEnCoursUser,
            'argentEnJeu' => $argentEnJeu,
        ]);
    }
}
