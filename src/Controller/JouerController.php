<?php

namespace App\Controller;

use App\Entity\Grille;
use App\Entity\Tirage;
use App\Form\GrilleType;
use App\Repository\GrilleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class JouerController extends AbstractController
{
    #[IsGranted('ROLE_ADMIN')]
    #[Route(path: '/tirage', name: 'jouer_tirage')]
    public function tirage(
        EntityManagerInterface $em,
        GrilleRepository       $gR
    ): Response
    {
        $tirage = [];
        $newInt = 0;
        do {
            do {
                $newInt = random_int(1, 49);
            } while (in_array($newInt, $tirage));
            array_push($tirage, $newInt);
        } while (sizeof($tirage) < 5);

        $newInt = random_int(1, 10);
        array_push($tirage, $newInt);

        $jackpot = count($gR->findBy(['tiree' => false])) * 2.2;

        $newTirage = new Tirage();
        $newTirage
            ->setDate(new \DateTime())
            ->setJackpot($jackpot)
            ->setNumero1($tirage['0'])
            ->setNumero2($tirage['1'])
            ->setNumero3($tirage['2'])
            ->setNumero4($tirage['3'])
            ->setNumero5($tirage['4'])
            ->setNumeroChance($tirage['5']);

        $em->persist($newTirage);
        $em->flush();

        return $this->render('jouer/tirage.html.twig', [
            'tirage' => $newTirage
        ]);
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/jouer', name: 'jouer_grille')]
    public function grille(
        Request                $request,
        EntityManagerInterface $em
    ): Response
    {
        // création grille et formulaire
        $grille = new Grille();
        $grilleForm = $this->createForm(GrilleType::class, $grille);
        $grilleForm->handleRequest($request);

        // initialisation des variables d'analyse
        $valeurs = [];
        $doublon = 0;

        if ($grilleForm->isSubmitted() && $grilleForm->isValid()) {

            // récupération des valeurs
            $valeurs = [
                $grille->getNumero1(),
                $grille->getNumero2(),
                $grille->getNumero3(),
                $grille->getNumero4(),
                $grille->getNumero5()
            ];

            // cherche les doublons
            foreach ($valeurs as $valeur) {
                if (count(array_keys($valeurs, $valeur)) > 1)
                    $doublon .= 1;
            }

            if ($doublon > 0) {
                // retour si doublon
                $this->addFlash('Grille invalide', 'Votre grille n\'a pas été validée, un chiffre est en double !');
                return $this->render('jouer/grille.html.twig', [
                    'grilleForm' => $grilleForm->createView(),
                ]);
            } else {
                // ajout des infos non présentes dans le formulaire
                $grille->setDate(new \DateTime());
                $grille->setUser($this->getUser());
                $grille->setTiree(false);

                // ajout des informations dans la base
                $em->persist($grille);
                $em->flush();
                $this->addFlash('Grille validée', 'Votre grille a été validée avec succès !');
                return $this->render('jouer/grille.html.twig', [
                    'grilleForm' => $grilleForm->createView(),
                ]);
            }
        }

        return $this->render('jouer/grille.html.twig', [
            'grilleForm' => $grilleForm->createView(),
        ]);
    }
}
