<?php

namespace App\Controller;

use App\Entity\Competence;
use App\Form\CompetenceType;
use App\Repository\CompetenceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/admin/competence", name="admin_competence_")
 */

class AdminCompetenceController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @param CompetenceRepository $competenceRepository
     * @return Response
     */
    public function index(CompetenceRepository $competenceRepository): Response
    {
        return $this->render('admin_competence/index.html.twig', [
            'competences' => $competenceRepository->findAll(),
        ]);
    }


    /**
     * @Route("/nouveau", name="new")
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function new(Request $request): Response
    {
        $competence = new Competence();
        $form = $this->createForm(CompetenceType::class, $competence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($competence);
            $entityManager->flush();
            $this->addFlash('success', 'La compétence a bien ajoutée');
            return $this->redirectToRoute('admin_competence_index');
        }

        return $this->render('admin_competence/new.html.twig', [
            'competence' => $competence,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="show", methods={"GET"})
     */
    public function show(Competence $competence): Response
    {
        return $this->render('admin_competence/show.html.twig', [
            'competence' => $competence,
        ]);
    }

    /**
     * @Route("/modifier/{id}", name="edit")
     * @ParamConverter("competence", class="App\Entity\Competence", options={"mapping": {"id": "id"}})
     * @param Request $request
     * @param Competence $competence
     * @return Response
     */


    public function edit(Request $request, Competence $competence): Response
    {
        $form = $this->createForm(CompetenceType::class, $competence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'La compétence a bien modifiée');
            return $this->redirectToRoute('admin_competence_index');
        }

        return $this->render('admin_competence/edit.html.twig', [
            'competence' => $competence,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/delete/{id}", name="delete", methods={"DELETE"})
     * @return Response
     */

    public function delete(Request $request, Competence $competence): Response
    {
        if ($this->isCsrfTokenValid('delete'.$competence->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($competence);
            $entityManager->flush();
            $this->addFlash('success', 'La compétence a bien été supprimée');
        }

        return $this->redirectToRoute('admin_competence_index');
    }
}
