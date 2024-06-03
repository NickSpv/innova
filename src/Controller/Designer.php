<?php
namespace App\Controller;

use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class Designer extends AbstractController
{

    #[Route('/designer')]
    public function designer(Request $request): Response
    {
        $allowedIp = '127.0.0.1';

        $requestIp = $request->getClientIp();
        $isIpv4 = filter_var($requestIp, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
        print_r($requestIp);

        if (!$isIpv4 || $requestIp !== $allowedIp) {
            return new Response('Доступ запрещен. IP адрес не авторизован.', 403);
        }

        $filePath = __DIR__ . '/../../templates/designer.html';

        if (!file_exists($filePath)) {
            throw $this->createNotFoundException('HTML файл не найден');
        }

        $htmlContent = file_get_contents($filePath);

        return new Response(
            $htmlContent, 200, [
            'Content-Type' => 'text/html',
            ]
        );
    }
}
