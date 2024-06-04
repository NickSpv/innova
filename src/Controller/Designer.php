<?php
namespace App\Controller;

use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bridge\Twig\Attribute\Template;


class Designer extends AbstractController
{

    #[Route('/designer')]
    #[Template('designer.html.twig')]
    public function designer(): array
    {
        return [];
    }
}
