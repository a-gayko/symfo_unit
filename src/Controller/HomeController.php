<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();
        return $this->render('home/index.html.twig', [
            'users' => $users,
        ]);
    }
}
