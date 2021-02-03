<?php

namespace App\Controller;

use App\Entity\Competence;
use App\Form\CompetenceType;
use App\Repository\CompetenceRepository;
use App\Repository\ExperienceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
/*    /**
     * @Route("/", name="home")
     * @param CompetenceRepository $competenceRepository
     * @return Response
     */
  /*  public function index(CompetenceRepository $competenceRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'competences' => $competenceRepository->findAll(),
        ]);
    }
**/

    /**
     * @Route("/", name="home")
     * @return Response
     */

    public function indexexperience(ExperienceRepository $experienceRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'experiences' => $experienceRepository->findAll(),
        ]);
    }


}

