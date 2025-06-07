<?php

namespace App\Controller\Api;

use App\Repository\OrderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class OrderApiController extends AbstractController
{
    #[Route('/api/orders', name: 'api_orders', methods: ['GET'])]
    public function getOrders(OrderRepository $orderRepository): JsonResponse
    {
        $orders = $orderRepository->findAll();

        $data = [];

        foreach ($orders as $order) {
            $data[] = [
                'customer' => [
                    'firstName' => $order->getCustomer()->getFirstName(),
                    'lastName' => $order->getCustomer()->getLastName(),
                    'email' => $order->getCustomer()->getEmail(),
                ],
                'size' => $order->getSize()->value,
                'pizzas' => array_map(function ($pizza) {
                    return [
                        'name' => $pizza->getName(),
                        'ingredients' => array_map(fn($i) => $i->getName(), $pizza->getIngredients()->toArray()),
                    ];
                }, $order->getPizzas()->toArray()),
                'comment' => $order->getComment()
            ];
        }

        return $this->json($data);
    }
}
