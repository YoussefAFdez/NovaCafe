<?php

namespace App\Form;

use App\Entity\Empleado;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmpleadoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('codigo', TextType::class, [
                'label' => 'Código'
            ])
            ->add('nombre', TextType::class, [
                'label' => 'Nombre: '
            ])
            ->add('apellidos', TextType::class, [
                'label' => 'Apellidos: '
            ])
            ->add('dni', TextType::class, [
                'label' => 'DNI: '
            ])
            ->add('gerente', CheckboxType::class, [
                'label' => 'Es Gerente:'
            ])
            ->add('administrador', CheckboxType::class, [
                'label' => 'Es Administrador:'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Empleado::class,
        ]);
    }
}
