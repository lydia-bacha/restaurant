<?php

namespace App\Controller;

use App\Entity\Menu;
use App\Repository\MenuRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
* @Route("/panier", name="panier_")
*/
class PanierController extends AbstractController
{
    #[Route('/panier', name: 'index')]
    public function index(SessionInterface $session, MenuRepository $menuRepo): Response
    {
        //je récupere le panier
        $panier = $session ->get("panier", []); 

        // je "fabrique" les données => récuperer le produit  qui correspond à chaque ligne de mon panier

        $dataPanier = [];
        $total = 0;
        foreach($panier as $id => $quantite){
            $menu = $menuRepo->find($id);
            $dataPanier[] = [
                "menu" => $menu,
                "quantite" => $quantite
            ];
            $total +=  $menu->getPrix() * $quantite;
        }

        return $this->render('panier/index.html.twig', 
         compact("dataPanier", "total"));
    }


    // route pour ajouter un produit dans le panier
    /**
     * @Route("/add/{id}", name="add")
     */
    public function add(Menu $menu, SessionInterface $session){

        // 1-on récupére le panier actuelle
        $panier = $session ->get("panier", []); 
        // ici on peut dire que $panier vaudra soit ce qui a dans le panier, soit un tableau vide

        $id = $menu->getId();
        if(!empty($panier[$id])){
            $panier[$id]++;
        }else{
            $panier[$id] = 1;
        }


        //2-on  sauvegarde dans la session
        $session->set("panier", $panier);

        //dd($session);  //=> (dump) = récuperer les infos de la sessions


        return $this->redirectToRoute("panier_index");
    } 


    
    // route pour supprimer un produit du le panier
    /**
     * @Route("/remove/{id}", name="remove")
     */
    public function remove(Menu $menu, SessionInterface $session){

        // 1-on récupére le panier actuelle
        $panier = $session ->get("panier", []); 
        $id = $menu->getId();

        if(!empty($panier[$id])){
            if($panier[$id] > 1 ){
                $panier[$id]--;
            }else{
               unset($panier[$id]);
            }
        }else{
            $panier[$id] = 1;
        }
         


        //2-on  sauvegarde dans la session
        $session->set("panier", $panier);

        return $this->redirectToRoute("panier_index");
    } 


    // route pour supprimer une ligne de produit du le panier
    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function delete(Menu $menu, SessionInterface $session){

        // 1-on récupére le panier actuelle
        $panier = $session ->get("panier", []); 
        $id = $menu->getId();

        if(!empty($panier[$id])){
            unset($panier[$id]);
        }

        //2-on  sauvegarde dans la session
        $session->set("panier", $panier);

        return $this->redirectToRoute("panier_index");
    } 



    // route qui permet de supprimer le panier complétement 
    /**
     * @Route("/deleteAll", name="deleteAll")
     */
    public function deleteAll( SessionInterface $session){

        $session->remove("panier");

        return $this->redirectToRoute("panier_index");
    } 
    
}
