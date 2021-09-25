<?php

namespace App\Controller;

use App\Entity\Pin;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PinsController extends AbstractController
{

    #[Route('/')]
    public function index(EntityManagerInterface $em): Response
    {
        $repo = $em->getRepository(Pin::class);
        $pins = $repo->findAll();

        return $this->render('pins/index.html.twig', ["pins" => $pins]);
    }

    public function coucou(): Response
    {
        return $this->render('pins/welcome.html.twig');
    }
}
