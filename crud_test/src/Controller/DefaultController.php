<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Util\Food;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function loginPage(): Response
    {
        return $this->redirectToRoute('app_login');
    }

    #[Route('/home', name: 'home')]
    public function home(): Response
    {
        $template = 'default/home.html.twig';
        $args = ['userRoles' => $this->getUser()->getRoles()];
        return $this->render($template, $args);
    }

}
