<?php

namespace App\Controller;

use App\Form\OrderFormType;
use App\Service\OrderService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    #[Route('/order', name: 'app_order')]
    public function order(Request $request, OrderService $orderService): Response
    {
        $form = $this->createForm(OrderFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $order = $orderService->createOrderFromFormData($form->getData());
            return $this->render('order/confirmation.html.twig', [
                'order' => $order,
            ]);
        }

        return $this->render('order/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
