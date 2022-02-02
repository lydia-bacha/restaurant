<?php

namespace App\Controller;

use App\Repository\ReservationRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    //la liste des réservations éffetués par les clients peut être vu que par l'admin
    #[Route('/calenderier_reservation', name: 'calenderier_reservation', methods: ['GET'])]
    /**
     * @IsGranted("ROLE_ADMIN")
     */
    public function index(ReservationRepository $reservationRepository): Response
    {
       
        $reservation = $reservationRepository->findAll();
        $rdvs = [];
        foreach($reservation as $event){
            $rdvs []=[
                'id'=> $event->getId(),
                'title'=> $event->getNom(), 
                // 'title'=> $event->getPrenom(),
                'start'=> $event->getDate()->format('Y-m-d H:i:s'),
               
            ];
        }
        $data = json_encode($rdvs);
        return $this->render('admin/index.html.twig', 
        compact('data') 
    );
    }
    
}
