<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AvisController extends AbstractController
{
    
     #[Route('/avis', name: 'avis')]
     
    public function index(): Response
    {
        return $this->render('home/avis.html.twig', [
            'controller_name' => 'AvisController',
        ]);
    }
}