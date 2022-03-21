<?php

namespace App\Form;

use App\Entity\Empleado;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use Symfony\Component\Validator\Constraints\NotBlank;

class EmpleadoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        if ($options['mode'] != "edit") {
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
                    'label' => 'Es Gerente:',
                    'required' => false
                ])
                ->add('administrador', CheckboxType::class, [
                    'label' => 'Es Administrador:',
                    'required' => false
                ])
                ->add('nombreUsuario', TextType::class, [
                    'label' => 'Nombre de Usuario: '
                ])
                ->add('clave', RepeatedType::class, [
                    'label' => 'Contraseña',
                    'type' => PasswordType::class,
                    'mapped' => false,
                    'invalid_message' => 'Las contraseñas no coinciden',
                    'first_options' => [
                        'label' => 'Contraseña: ',
                        'constraints' => [
                            new NotBlank([
                                'groups' => ['password']
                            ])
                        ]
                    ],
                    'second_options' => [
                        'label' => 'Repite contraseña: '
                    ]
                ])
            ;
        } else {
            $builder
                ->add('claveAntigua', PasswordType::class, [
                    'label' => 'Contraseña actual',
                    'required' => false,
                    'mapped' => false,
                    'constraints' => [
                        new UserPassword(),
                        new NotBlank()
                    ]
                ])->add('clave', RepeatedType::class, [
                    'label' => 'Contraseña',
                    'type' => PasswordType::class,
                    'mapped' => false,
                    'invalid_message' => 'Las contraseñas no coinciden',
                    'first_options' => [
                        'label' => 'Contraseña: ',
                        'constraints' => [
                            new NotBlank([
                                'groups' => ['password']
                            ])
                        ]
                    ],
                    'second_options' => [
                        'label' => 'Repite contraseña: '
                    ]
                ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Empleado::class,
            'mode' => ""
        ]);
    }
}
