<?php

namespace App\Controller;

use App\Entity\Pin;
use App\Repository\PinRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PinsController extends AbstractController
{

    #[Route('/')]
    public function index(PinRepository $repo): Response //ou index(EntityManagerInterface $em)
    {
        /* $repo = $em->getRepository(Pin::class);
        $pins = $repo->findAll(); */

        return $this->render('pins/index.html.twig', ['pins' => $repo->findAll()]); // compact('pins') ou = ["pins" => $pins]
    }

    #[Route('/pins/create', methods: ["GET", "POST"])]
    public function create(Request $request): Response
    {
        if ($request->isMethod("POST")) {
            dd($request->request->all());
        }

        return $this->render('pins/create.html.twig');
    }
}
