<?php

namespace App\Controller;

use App\Service\OrderAdminService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminOrderController extends AbstractController
{
    #[Route('/admin/orders', name: 'admin_orders')]
    public function listOrders(OrderAdminService $orderAdminService): Response
    {
        $orders = $orderAdminService->getAllOrders();

        return $this->render('admin/orders.html.twig', [
            'orders' => $orders,
        ]);
    }
}
