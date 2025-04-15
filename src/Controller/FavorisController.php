<?php

namespace App\Controller;

use App\Entity\Car;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FavorisController extends AbstractController
{
    #[Route('/favoris', name: 'favoris_list')]
    public function list(): Response
    {
        // Vérifiez si l'utilisateur est connecté
        $user = $this->getUser();
        if (!$user) {
            $this->addFlash('error', 'Vous devez être connecté pour voir vos favoris.');
            return $this->redirectToRoute('app_login');
        }

        // Récupérer les favoris de l'utilisateur
        $favoris = $user->getFavoris();

        return $this->render('favoris/list.html.twig', [
            'favoris' => $favoris,
        ]);
    }

    #[Route('/favoris/add/{id}', name: 'add_to_favorites')]
    public function add(Car $car, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();

        if (!$user) {
            $this->addFlash('error', 'Vous devez être connecté pour ajouter un favori.');
            return $this->redirectToRoute('app_login');
        }

        // Ajouter la voiture aux favoris de l'utilisateur
        if (!$user->getFavoris()->contains($car)) {
            $user->addFavori($car);
            $entityManager->flush(); // Persist n'est pas nécessaire ici

            $this->addFlash('success', 'Le modèle a été ajouté à vos favoris.');
        } else {
            $this->addFlash('info', 'Ce modèle est déjà dans vos favoris.');
        }

        return $this->redirectToRoute('favoris_list');
    }

    #[Route('/favoris/remove/{id}', name: 'remove_from_favorites')]
    public function remove(Car $car, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();

        if (!$user) {
            $this->addFlash('error', 'Vous devez être connecté pour supprimer un favori.');
            return $this->redirectToRoute('app_login');
        }

        // Supprimer la voiture des favoris de l'utilisateur
        if ($user->getFavoris()->contains($car)) {
            $user->removeFavori($car);
            $entityManager->flush();

            $this->addFlash('success', 'Le modèle a été retiré de vos favoris.');
        } else {
            $this->addFlash('info', 'Ce modèle n\'est pas dans vos favoris.');
        }

        return $this->redirectToRoute('favoris_list');
    }
}