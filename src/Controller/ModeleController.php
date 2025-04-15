<?php

namespace App\Controller;

use App\Entity\Car; // Assurez-vous que l'entité Car existe
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ModeleController extends AbstractController
{
    #[Route('/modeles', name: 'modeles')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        // Récupérer les voitures depuis la base de données
        $cars = $entityManager->getRepository(Car::class)->findAll();
        return $this->render('home/modele.html.twig', [
            'cars' => $cars,
        ]);
    }
}