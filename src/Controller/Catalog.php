<?php
namespace App\Controller;

use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bridge\Twig\Attribute\Template;

class Catalog extends AbstractController
{
    private array $jsonData = array();

    #[Route('')]
    #[Template('catalog.html.twig')]
    public function index(): array
    {
        if (empty($this->jsonData)) {
            $data = $this->getDefaultJsonData();
        } else {
            $data = $this->jsonData;
        }

        return [
            'sale_products' => $data['sale_products'],
            'top_products' => $data['top_products'],
            'new_products' => $data['new_products'],
            'another_products' => $data['another_products'],
        ];
    }

    public function getDefaultJsonData() : array
    {
        $json = '{
                  "sale_products": [
                    {
                      "id": "1",
                      "model": "Ромашка",
                      "type": "Стул",
                      "color": "Красный",
                      "material": "Дерево",
                      "price": "1000"
                    },
                    {
                      "id": "1",
                      "model": "Ромашка",
                      "type": "Стул",
                      "color": "Красный",
                      "material": "Дерево",
                      "price": "1000"
                    }
                  ],
                  "top_products": [
                    {
                      "id": "2",
                      "model": "Далло",
                      "type": "Шкаф",
                      "color": "Коричневый",
                      "material": "Дерево",
                      "price": "9000"
                    }
                  ],
                  "new_products": [
                    {
                      "id": "3",
                      "model": "Ассил",
                      "type": "Диван",
                      "color": "Синий",
                      "material": "Пластик, Ткань",
                      "price": "5000"
                    }
                  ],
                  "another_products": [
                    {
                      "id": "2",
                      "model": "Далло",
                      "type": "Шкаф",
                      "color": "Коричневый",
                      "material": "Дерево",
                      "price": "9000"
                    }
                  ]
                }';
        return json_decode($json, true);;
    }

    #[Route('/api/put_data')]
    public function receiveJsonFromSpecificIp(Request $request): Response
    {
        $content = $request->getContent();
        $this->jsonData = json_decode($content, true);
        return new Response('Данные получены успешно', 200);
    }

}
