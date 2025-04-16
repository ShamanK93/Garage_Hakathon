<?php

namespace App\Controller;

use App\Entity\Car;
use App\Form\CarType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'admin_dashboard')]
    public function index(): Response
    {
        // Vérifie que l'utilisateur a le rôle ROLE_ADMIN
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    #[Route('/admin/car/add', name: 'admin_car_add')]
public function addCar(Request $request, EntityManagerInterface $entityManager): Response
{
    $this->denyAccessUnlessGranted('ROLE_ADMIN');

    $car = new Car();
    $form = $this->createForm(CarType::class, $car);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        // Gestion de l'upload de l'image
        $imageFile = $form->get('image')->getData();
        if ($imageFile) {
            $newFilename = uniqid() . '.' . $imageFile->guessExtension();

            // Déplace le fichier dans le répertoire public/uploads
            $imageFile->move(
                $this->getParameter('uploads_directory'),
                $newFilename
            );

            // Définit le chemin de l'image dans l'entité Car
            $car->setImage('uploads/' . $newFilename);
        }

        $entityManager->persist($car);
        $entityManager->flush();

        $this->addFlash('success', 'La voiture a été ajoutée avec succès.');

        return $this->redirectToRoute('admin_dashboard');
    }

    return $this->render('admin/car_add.html.twig', [
        'carForm' => $form->createView(),
    ]);
}}