<?php

namespace App\Controller;

use App\Entity\Gallerie;
use App\Form\GallerieType;
use App\Repository\GallerieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/gallerie')]
class GallerieController extends AbstractController
{
    #[Route('/', name: 'gallerie_index', methods: ['GET'])]
    public function index(GallerieRepository $gallerieRepository): Response
    {
        return $this->render('gallerie/index.html.twig', [
            'galleries' => $gallerieRepository->findAll(),
        ]);
    }

    /**
    * @IsGranted("ROLE_ADMIN")
    */
    #[Route('/admin/new', name: 'gallerie_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $gallerie = new Gallerie();
        $form = $this->createForm(GallerieType::class, $gallerie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($gallerie);
            $entityManager->flush();

            return $this->redirectToRoute('gallerie_index');
        }

        return $this->render('gallerie/new.html.twig', [
            'gallerie' => $gallerie,
            'form' => $form->createView(),
        ]);
    }
    /**
    * @IsGranted("ROLE_ADMIN")
    */
    #[Route('/admin/{id}', name: 'gallerie_show', methods: ['GET'])]
    public function show(Gallerie $gallerie): Response
    {
        return $this->render('gallerie/show.html.twig', [
            'gallerie' => $gallerie,
        ]);
    }
    /**
    * @IsGranted("ROLE_ADMIN")
    */
    #[Route('/admin/{id}/edit', name: 'gallerie_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Gallerie $gallerie): Response
    {
        $form = $this->createForm(GallerieType::class, $gallerie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('gallerie_index');
        }

        return $this->render('gallerie/edit.html.twig', [
            'gallerie' => $gallerie,
            'form' => $form->createView(),
        ]);
    }
    /**
    * @IsGranted("ROLE_ADMIN")
    */
    #[Route('/admin/{id}', name: 'gallerie_delete', methods: ['POST'])]
    public function delete(Request $request, Gallerie $gallerie): Response
    {
        if ($this->isCsrfTokenValid('delete'.$gallerie->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($gallerie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('gallerie_index');
    }
}
