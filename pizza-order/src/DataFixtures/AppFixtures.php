<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use App\Entity\Pizza;
use App\Entity\Ingredient;
use App\Entity\Order;
use App\Enum\PizzaSize;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $ingredients = [
            'Cheese',
            'Pepperoni',
            'Mushrooms',
            'Olives',
            'Onions',
            'Bacon',
            'Tomatoes',
            'Green Peppers',
            'Spinach',
            'Pineapple',
        ];

        $ingredientEntities = [];

        foreach ($ingredients as $name) {
            $ingredient = new Ingredient();
            $ingredient->setName($name);
            $manager->persist($ingredient);
            $ingredientEntities[$name] = $ingredient;
        }

        $pizza = new Pizza();
        $pizza->setName('Pepperoni Deluxe');
        $pizza->addIngredient($ingredientEntities['Cheese']);
        $pizza->addIngredient($ingredientEntities['Pepperoni']);
        $pizza->addIngredient($ingredientEntities['Onions']);
        $pizza->addIngredient($ingredientEntities['Green Peppers']);
        $manager->persist($pizza);

        $customer = new Customer();
        $customer->setFirstName('John');
        $customer->setLastName('Doe');
        $customer->setEmail('john@example.com');
        $manager->persist($customer);

        $order = new Order();
        $order->setCustomer($customer);
        $order->addPizza($pizza);
        $order->setSize(PizzaSize::Large);
        $order->setComment('No olives, please.');
        $manager->persist($order);

        $manager->flush();
    }
}
