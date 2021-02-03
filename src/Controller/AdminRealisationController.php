<?php

namespace App\Controller;

use App\Entity\Realisation;
use App\Form\RealisationType;
use App\Repository\RealisationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/admin/realisation", name="admin_realisation_")
 */
class AdminRealisationController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET"})
     * @param RealisationRepository $realisationRepository
     * @return Response
     */
    public function index(RealisationRepository $realisationRepository): Response
    {
        return $this->render('admin_realisation/index.html.twig', [
            'realisations' => $realisationRepository->findAll(),
        ]);
    }


    /**
     * @Route("/nouveau", name="new")
     */
    public function new(Request $request): Response
    {
        $realisation = new Realisation();
        $form = $this->createForm(RealisationType::class, $realisation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($realisation);
            $entityManager->flush();
            $this->addFlash('success', 'La réalisation a bien ajoutée');
            return $this->redirectToRoute('admin_realisation_index');
        }

        return $this->render('admin_realisation/new.html.twig', [
            'realisation' => $realisation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="show")
     */
    public function show(Realisation $realisation): Response
    {
        return $this->render('admin_realisation/show.html.twig', [
            'realisation' => $realisation,
        ]);
    }
    /**
     * @Route("/modifier/{id}", name="edit")
     * @ParamConverter("realisation", class="App\Entity\Realisation", options={"mapping": {"id": "id"}})
     * @param Request $request
     * @param Realisation $realisation
     * @return Response
     */

    public function edit(Request $request, Realisation $realisation): Response
    {
        $form = $this->createForm(RealisationType::class, $realisation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'La réalisation a bien modifiée');
            return $this->redirectToRoute('admin_realisation_index');
        }

        return $this->render('admin_realisation/edit.html.twig', [
            'realisation' => $realisation,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/delete/{id}", name="delete", methods={"DELETE"})
     * @return Response
     */
    public function delete(Request $request, Realisation $realisation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$realisation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($realisation);
            $entityManager->flush();
            $this->addFlash('success', 'La réalisation a bien été supprimée');
        }

        return $this->redirectToRoute('admin_realisation_index');
    }
}
