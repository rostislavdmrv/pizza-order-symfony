<?php

namespace App\Form;

use App\Entity\Pizza;
use App\Enum\PizzaSize;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Ingredient;

class OrderFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class, ['label' => 'Име'])
            ->add('lastName', TextType::class, ['label' => 'Фамилия'])
            ->add('email', EmailType::class, ['label' => 'Имейл'])
            ->add('pizza', EntityType::class, [
                'class' => Pizza::class,
                'choice_label' => function (Pizza $pizza) {
                    $ingredients = $pizza->getIngredients()->map(fn($i) => $i->getName())->toArray();
                    return sprintf('%s (%s)', $pizza->getName(), implode(', ', $ingredients));
                },
                'placeholder' => 'Избери пица',
                'label' => 'Пица',
            ])
            ->add('ingredients', EntityType::class, [
                'class' => Ingredient::class,
                'multiple' => true,
                'expanded' => true,
                'required' => false,
                'label' => 'Допълнителни съставки',
                'choice_label' => 'name',
            ])
            ->add('size', ChoiceType::class, [
                'label' => 'Размер',
                'choices' => [
                    'S' => PizzaSize::Small,
                    'M' => PizzaSize::Medium,
                    'L' => PizzaSize::Large,
                ],
                'choice_value' => fn($choice) => $choice?->value,
            ])
            ->add('comment', TextareaType::class, [
                'required' => false,
                'label' => 'Коментар (по избор)',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }
}
