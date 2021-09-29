<?php

namespace App\Controller;

use App\Entity\Pin;
use App\Repository\PinRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Flex\Path;

class PinsController extends AbstractController
{

    #[Route('/', name: 'app_home', methods: "GET")]
    public function index(PinRepository $repo): Response
    {
        return $this->render('pins/index.html.twig', ['pins' => $repo->findAll()]);
    }


    #[Route('/pins/{id<[0-9]+>}', name: "app_pins_show")]
    public function showPin(Pin $pin): Response
    {
        return $this->render('pins/showPin.html.twig', compact('pin'));
    }

    #[Route('/pins/create', name: 'app_pin_create', methods: ["GET", "POST"])]
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $pin = new Pin;

        $form = $this->createFormBuilder($pin)
            ->add('title', null, ['attr' => ['autofocus' => true],])
            ->add('description', null, ['attr' => ['rows' => 10, 'cols' => 60, 'placeholder' => 'Ecrivez votre description ici']])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($pin);
            $em->flush();

            return $this->redirectToRoute('app_pins_show', ["id" => $pin->getId()]);
        }

        return $this->render('pins/create.html.twig', ['createForm' => $form->createView()]);
    }
}
