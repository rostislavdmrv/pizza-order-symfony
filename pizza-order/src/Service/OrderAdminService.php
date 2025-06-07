<?php

namespace App\Service;

use App\Repository\OrderRepository;

class OrderAdminService
{
    public function __construct(private OrderRepository $orderRepository) {}

    public function getAllOrders(): array
    {
        return $this->orderRepository->findBy([], ['id' => 'DESC']);
    }
}
