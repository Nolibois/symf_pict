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
        $pin = new Pin;
        $pin->setTitle('Mon 3ème titre');
        $pin->setDescription('Ceci est une longue 3ème description...');

        $em->persist($pin);
        $em->flush();

        dump($pin);

        return $this->render('pins/index.html.twig');
    }

    public function coucou(): Response
    {
        return $this->render('pins/welcome.html.twig');
    }
}
