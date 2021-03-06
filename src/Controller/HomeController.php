<?php

namespace App\Controller;

use App\Entity\Competence;
use App\Form\CompetenceType;
use App\Repository\CompetenceRepository;
use App\Repository\ExperienceRepository;
use App\Repository\RealisationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param CompetenceRepository $competenceRepository
     * @return Response
     */
    public function index(CompetenceRepository $competenceRepository,
                          ExperienceRepository $experienceRepository,
                          RealisationRepository $realisationRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'competences' => $competenceRepository->findBy([], ['priority' => 'ASC']),
            'experiences' => $experienceRepository->findBy(['type'=>'experience'], []),
            'formations' => $experienceRepository->findBy(['type'=>'formation'], []),
            'realisations'=> $realisationRepository->findBy([], ['priority' => 'ASC']),
        ]);
    }


   }




