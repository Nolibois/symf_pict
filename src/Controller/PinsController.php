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

    #[Route('/', name: 'app_home')]
    public function index(PinRepository $repo): Response //ou index(EntityManagerInterface $em)
    {
        /* $repo = $em->getRepository(Pin::class);
        $pins = $repo->findAll(); */

        return $this->render('pins/index.html.twig', ['pins' => $repo->findAll()]); // compact('pins') ou = ["pins" => $pins]
    }

    #[Route('/pins/create', name: 'app_pin_create', methods: ["GET", "POST"])]
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        if ($request->isMethod("POST")) {
            $data = $request->request->all();

            if ($this->isCsrfTokenValid('pins_create', $data['_token'])) {
                $pin = new Pin;
                $pin->setTitle($data['title']);
                $pin->setDescription($data['description']);

                $em->persist($pin);
                $em->flush();
            }

            return $this->redirectToRoute('app_home');
        }

        return $this->render('pins/create.html.twig');
    }
}
