<?php

namespace App\Controller;

use App\Entity\Voiture;
use App\Form\VoitureType;
use App\Repository\VoitureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VoitureController extends AbstractController
{
    #[Route('/voitures', name: 'app_voiture')]
    public function listeVoiture(Request $request, VoitureRepository $vr): Response
    {
        $modeleId = $request->query->getInt('modele', 0) ?: null;

        $voitures = $modeleId
            ? $vr->findByModele($modeleId)
            : $vr->findAll();

        return $this->render('voiture/listeVoiture.html.twig', [
            'listeVoiture' => $voitures,
        ]);
    }

    #[Route('/voiture/add', name: 'app_voiture_add')]
    public function addVoiture(Request $request, EntityManagerInterface $em): Response
    {
        $voiture = new Voiture();
        $form = $this->createForm(VoitureType::class, $voiture);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($voiture);
            $em->flush();

            // redirect to the list route name you actually have
            return $this->redirectToRoute('app_voiture');
        }

        // make sure this matches your real Twig filename
        return $this->render('voiture/addVoiture.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    #[Route('/voiture/delete/{id}', name: 'deleteVoiture')]
    public function deleteVoiture(int $id, EntityManagerInterface $em): Response
    {
        $voiture = $em->getRepository(Voiture::class)->find($id);

        if ($voiture) {
            $em->remove($voiture);
            $em->flush();
        }

        return $this->redirectToRoute('app_voiture');
    }
    #[Route('/voiture/update/{id}', name: 'updateVoiture')]
    public function updateVoiture(int $id, Request $request, EntityManagerInterface $em): Response
    {
        $voiture = $em->getRepository(Voiture::class)->find($id);

        if (!$voiture) {
            throw $this->createNotFoundException('Voiture non trouvée');
        }

        $form = $this->createForm(VoitureType::class, $voiture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('app_voiture');
        }

        return $this->render('voiture/update_voiture.html.twig', [
            'editFormVoiture' => $form->createView(),  // ← Nom cohérent avec la vue
            'voiture' => $voiture,
        ]);
    }



}
