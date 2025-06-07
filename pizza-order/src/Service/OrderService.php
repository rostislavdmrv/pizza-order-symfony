<?php

namespace App\Service;

use App\Entity\Customer;
use App\Entity\Order;
use App\Entity\Pizza;
use Doctrine\ORM\EntityManagerInterface;

class OrderService
{
    public function __construct(private EntityManagerInterface $em) {}

    public function createOrderFromFormData(array $data): Order
    {
        $customer = new Customer();
        $customer->setFirstName($data['firstName']);
        $customer->setLastName($data['lastName']);
        $customer->setEmail($data['email']);

        $basePizza = $data['pizza'];
        $customIngredients = $data['ingredients'] ?? [];

        $customPizza = new Pizza();
        $customPizza->setName($basePizza->getName() . ' (Custom)');

        foreach ($basePizza->getIngredients() as $ingredient) {
            $customPizza->addIngredient($ingredient);
        }

        foreach ($customIngredients as $ingredient) {
            if (!$customPizza->getIngredients()->contains($ingredient)) {
                $customPizza->addIngredient($ingredient);
            }
        }

        $order = new Order();
        $order->setCustomer($customer);
        $order->addPizza($customPizza);
        $order->setSize($data['size']);
        $order->setComment($data['comment'] ?? null);

        $this->em->persist($customer);
        $this->em->persist($customPizza);
        $this->em->persist($order);
        $this->em->flush();

        return $order;
    }
}
