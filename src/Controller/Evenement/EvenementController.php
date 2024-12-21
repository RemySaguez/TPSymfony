<?php

namespace App\Controller\Evenement;

use App\Entity\Evenement;
use App\Entity\Lieu;
use App\Entity\Activite;
use App\Entity\Commentaire;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EvenementController extends AbstractController
{
    #[Route('/evenements', name: 'evenement_index')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $evenements = $doctrine->getRepository(Evenement::class)->findAll();

        return $this->render('evenement/index.html.twig', [
            'evenements' => $evenements,
        ]);
    }

    #[Route('/lieus', name: 'lieu_index')]
    public function lieus(ManagerRegistry $doctrine): Response
    {
        $lieux = $doctrine->getRepository(Lieu::class)->findAll();

        return $this->render('lieu/index.html.twig', [
            'lieux' => $lieux,
        ]);
    }

    #[Route('/activites', name: 'activite_index')]
    public function activites(ManagerRegistry $doctrine): Response
    {
        $activites = $doctrine->getRepository(Activite::class)->findAll();

        return $this->render('activite/index.html.twig', [
            'activites' => $activites,
        ]);
    }

    #[Route('/commentaires', name: 'commentaire_index')]
    public function commentaires(ManagerRegistry $doctrine): Response
    {
        $commentaires = $doctrine->getRepository(Commentaire::class)->findAll();

        return $this->render('commentaire/index.html.twig', [
            'commentaires' => $commentaires,
        ]);
    }
}