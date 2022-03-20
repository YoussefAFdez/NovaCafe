<?php

namespace App\Form;

use App\Entity\Categoria;
use App\Entity\Producto;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('codigo', TextType::class, [
                'label' => 'Código: '
            ])
            ->add('nombre', TextType::class, [
                'label' => 'Nombre del producto: '
            ])
            ->add('descripcion', TextareaType::class, [
                'label' => 'Descripción del producto: '
            ])
            ->add('precio', TextType::class, [
                'label' => 'Precio: '
            ])
            ->add('stock', IntegerType::class, [
                'label' => 'Unidades: '
            ])
            ->add('categoria', EntityType::class, [
                'label' => 'Categoría: ',
                'class' => Categoria::class
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Producto::class,
        ]);
    }
}
