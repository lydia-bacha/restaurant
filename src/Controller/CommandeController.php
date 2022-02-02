<?php

namespace App\Controller;

use App\Repository\MenuRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommandeController extends AbstractController
{
    // #[Route('/commande', name: 'commande')]
    // public function index(): Response
    // {
    //     return $this->render('commande/index.html.twig', [
    //         'controller_name' => 'CommandeController',
    //     ]);
    // }
    #[Route('/commande', name: 'commander', methods: ['GET'])]
    public function index(MenuRepository $menuRepository): Response
    {
        return $this->render('commande/index.html.twig', [
            'menus' => $menuRepository->findAll(),
        ]);
    }
}
