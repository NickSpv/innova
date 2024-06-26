<?php
namespace App\Controller;

use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bridge\Twig\Attribute\Template;

class Catalog extends AbstractController
{
    #[Route('')]
    #[Template('catalog.html.twig')]
    public function index(): array
    {

        $filePath = $this->getParameter('kernel.project_dir') . '/public/json/data.json' ;

        if (!file_exists($filePath)) {
            $data = $this->getDefaultJsonData();
        } else {
            $jsonData = file_get_contents($filePath);
            $data = json_decode($jsonData, true);
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

    #[Route('/put_data')]
    public function receiveJsonFromSpecificIp(Request $request): Response
    {

        $data = json_decode($request->getContent(), true);

        if ($data === null) {
            // Если JSON не валиден
            return $this->json(['error' => 'Invalid JSON'], 400);
        }

        // Здесь можно обрабатывать полученные данные
        // Например, вывести полученный JSON или сохранить его в базу данных
        // var_dump($data);
        $jsonData = $request->getContent();
        $fileName = 'data.json';
        $filePath = $this->getParameter('kernel.project_dir') . '/public/json/' . $fileName;

        file_put_contents($filePath, $jsonData);

        return $this->json(['message' => 'Received JSON data'], 200);
    }

}
