<?php

namespace App\Form;

use App\Entity\Cliente;
use App\Entity\Producto;
use App\Entity\Venta;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VentaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('codigo', TextType::class, [
                'label' => 'Código: '
            ])
            ->add('fechaVenta', DateType::class, [
                'label' => 'Fecha de venta: '
            ])
            ->add('cliente', EntityType::class, [
                'label' => 'Cliente: ',
                'class' => Cliente::class
            ])
            ->add('productos', EntityType::class, [
                'label' => 'Productos: ',
                'class' => Producto::class,
                'multiple' => true
            ])
            ->add('empleado')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Venta::class,
        ]);
    }
}
