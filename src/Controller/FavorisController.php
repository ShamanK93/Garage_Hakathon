<?php

namespace App\Controller;

use App\Entity\Car;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FavorisController extends AbstractController
{
    #[Route('/favoris', name: 'favoris_list')]
    public function list(): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        $favoris = $user->getFavoris();

        return $this->render('home/favoris.html.twig', [
            'favoris' => $favoris,
        ]);
    }

    #[Route('/favoris/add/{id}', name: 'add_to_favorites')]
    public function add(Car $car, EntityManagerInterface $entityManager): RedirectResponse
    {
        /** @var User $user */
        $user = $this->getUser();

        if (!$user->getFavoris()->contains($car)) {
            $user->addFavori($car);
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', 'Le modèle a été ajouté à vos favoris.');
        } else {
            $this->addFlash('info', 'Ce modèle est déjà dans vos favoris.');
        }

        return $this->redirectToRoute('favoris_list');
    }

    #[Route('/favoris/remove/{id}', name: 'remove_from_favorites')]
    public function remove(Car $car, EntityManagerInterface $entityManager): RedirectResponse
    {
        /** @var User $user */
        $user = $this->getUser();

        if ($user->getFavoris()->contains($car)) {
            $user->removeFavori($car);
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', 'Le modèle a été retiré de vos favoris.');
        } else {
            $this->addFlash('info', 'Ce modèle n\'est pas dans vos favoris.');
        }

        return $this->redirectToRoute('favoris_list');
    }
}